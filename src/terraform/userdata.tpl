#! /bin/bash


# Save all output to a log file
exec > /var/log/userdata.log 2>&1
set -x


# INSTALL SSM AGENT
# This allows SSH access into the VM from the Session Manager web interface.
# This take a while to start up, so be patient. You can use the EC2 serial console
# to monitor progress before the Session Manager is ready.
#
echo '### Installing the SSM Agent ###'
mkdir /tmp/ssm
cd /tmp/ssm
wget -q https://s3.amazonaws.com/ec2-downloads-windows/SSMAgent/latest/debian_amd64/amazon-ssm-agent.deb
sudo dpkg -i amazon-ssm-agent.deb


# Function to wait for dpkg lock
wait_for_dpkg_lock() {
  while sudo fuser /var/lib/dpkg/lock-frontend >/dev/null 2>&1 || sudo fuser /var/lib/apt/lists/lock >/dev/null 2>&1; do
    echo "Waiting for dpkg lock to be released..."
    sleep 5
  done
}

# INSTALL AMAZON-EFS-UTILS
# We need to build this from source for Debian Linux; it isn't available, otherwise.
#
# Update package lists and install dependencies
echo '### Installing amazon-efs-utils dependencies ###'
wait_for_dpkg_lock
sudo apt-get -y update
wait_for_dpkg_lock
sudo apt-get install -y git binutils pkg-config libssl-dev

# Switch to the bitnami user and install Rust and Cargo
sudo -u bitnami bash <<'EOF'
curl --proto '=https' --tlsv1.2 -sSf https://sh.rustup.rs | sh -s -- -y
echo '. "$HOME/.cargo/env"' >> ~/.bashrc
source $HOME/.cargo/env
EOF

# Clone and build amazon-efs-utils as the bitnami user
echo '### Building amazon-efs-utils ###'
sudo -u bitnami bash <<'EOF'
mkdir -p /home/bitnami/repos
cd /home/bitnami/repos
git clone https://github.com/aws/efs-utils efs-utils
cd efs-utils
source $HOME/.cargo/env
./build-deb.sh
EOF

# Install the built package
echo '### Installing amazon-efs-utils ###'
wait_for_dpkg_lock
# Find the built .deb package
#sudo apt-get -y install /home/bitnami/repos/efs-utils/build/amazon-efs-utils*deb
DEB_FILE=$(ls /home/bitnami/repos/efs-utils/build/*.deb | head -n 1)
if [ -n "$DEB_FILE" ]; then
    sudo apt-get -y install "$DEB_FILE"
else
    echo "No .deb file found to install."
    exit 1
fi


# MOUNT THE EFS PERISTENT FILESYSTEM
# This volume contains the resourcespace filestore. We tried using S3 but it was slow and unreliable.
# EBS wouldn't work either because the autoscaling group runs in 2 availability zones.  
#
echo '### Mounting the EFS filesystem ###'
cd /opt/bitnami/resourcespace
sudo cp -R filestore filestore.bitnami
wait_for_dpkg_lock
#sudo mount -t efs -o iam -o tls ${efs_dns_name}:/ ./filestore
if sudo mount -t efs -o iam -o tls ${efs_dns_name}:/ ./filestore; then
  echo "EFS mounted successfully."
else
  echo "Failed to mount EFS." >&2
  exit 1
fi
#sudo chown -R bitnami:daemon filestore*
#sudo chmod -R 775 filestore*
#^^temporarily disabled. This causes the rebuild to take a very long time, with assigning ownership and permissions to 130+GB, and impacts users.

# MOUNT THE S3 BUCKET
# The S3 bucket /mnt/s3-backup is used for backups and file transfers. You can use
# the AWS web console to upload and download data into this bucket from your computer.
#
echo '### Mounting the S3 bucket ###'
sudo apt-get -y install s3fs
sudo mkdir /mnt/s3-backup
sudo s3fs bcparks-dam-${target_env}-backup /mnt/s3-backup -o iam_role=BCParks-Dam-EC2-Role -o use_cache=/tmp -o allow_other -o uid=0 -o gid=1 -o mp_umask=002  -o multireq_max=5 -o use_path_request_style -o url=https://s3-${aws_region}.amazonaws.com
#sudo -u bitnami s3fs bcparks-dam-${target_env}-backup /mnt/s3-backup \
#        -o iam_role=BCParks-Dam-EC2-Role \
#        -o use_cache=/tmp \
#        -o allow_other \
#        -o uid=$(id -u bitnami) \
#        -o gid=$(id -g daemon) \
#        -o umask=002 \
#        -o multireq_max=5 \
#        -o use_path_request_style \
#        -o url=https://s3-${aws_region}.amazonaws.com


# Copy the default filestore data
sudo cp -R /opt/bitnami/resourcespace/filestore.bitnami/system /opt/bitnami/resourcespace/filestore
sudo chown -R bitnami:daemon /opt/bitnami/resourcespace/filestore/system
sudo chmod -R 775 /opt/bitnami/resourcespace/filestore/system


# CUSTOMIZE THE BITNAMI RESOURCESPACE CONFIG
# Download all the files from our git repo to get our customized copy of config.php
# Updated 2024-03-01 11:10
echo '### Customizing the Bitnami Resourcespace config ###'
sudo apt-get -y install git
cd /home/bitnami/repos
sudo -u bitnami git clone ${git_url} bcparks-dam
# Download from another branch
# BRANCH_NAME = "${branch_name}"
# sudo -u bitnami git clone -b $BRANCH_NAME ${git_url} bcparks-dam
# sudo -u bitnami git clone -b rfiddler ${git_url} bcparks-dam

# use values from AWS secrets manager secrets to append settings to the file
tee -a bcparks-dam/src/resourcespace/files/config.php << END

# MySQL database settings
\$mysql_server = '${rds_endpoint}:3306';
\$mysql_username = '${mysql_username}';
\$mysql_password = '${mysql_password}';
\$mysql_db = 'resourcespace';

# Email settings
\$email_notify = '${email_notify}';
\$email_from = '${email_from}';

# Secure keys
\$spider_password = '${spider_password}';
\$scramble_key = '${scramble_key}';
\$api_scramble_key = '${api_scramble_key}';

END
# SimpleSAML config
sudo cat bcparks-dam/src/resourcespace/files/simplesaml-config-1.php | tee -a bcparks-dam/src/resourcespace/files/config.php
tee -a bcparks-dam/src/resourcespace/files/config.php << END
    'technicalcontact_name' => '${technical_contact_name}',
    'technicalcontact_email' => '${technical_contact_email}',
    'secretsalt' => '${secret_salt}',
    'auth.adminpassword' => '${auth_admin_password}',
    'database.username' => '${saml_database_username}',
    'database.password' => '${saml_database_password}',
END
sudo cat bcparks-dam/src/resourcespace/files/simplesaml-config-2.php | tee -a bcparks-dam/src/resourcespace/files/config.php
sudo cat bcparks-dam/src/resourcespace/files/simplesaml-authsources-1.php | tee -a bcparks-dam/src/resourcespace/files/config.php
tee -a bcparks-dam/src/resourcespace/files/config.php << END
        'entityID' => '${sp_entity_id}',
        'idp' => '${idp_entity_id}',
END
sudo cat bcparks-dam/src/resourcespace/files/simplesaml-authsources-2.php | tee -a bcparks-dam/src/resourcespace/files/config.php
tee -a bcparks-dam/src/resourcespace/files/config.php << END
\$simplesamlconfig['metadata']['${idp_entity_id}'] = [
    'entityID' => '${idp_entity_id}',
END
sudo cat bcparks-dam/src/resourcespace/files/simplesaml-metadata-1.php | tee -a bcparks-dam/src/resourcespace/files/config.php
tee -a bcparks-dam/src/resourcespace/files/config.php << END
        'Location' => '${single_signon_service_url}',
END
sudo cat bcparks-dam/src/resourcespace/files/simplesaml-metadata-2.php | tee -a bcparks-dam/src/resourcespace/files/config.php
tee -a bcparks-dam/src/resourcespace/files/config.php << END
        'Location' => '${single_logout_service_url}',
END
sudo cat bcparks-dam/src/resourcespace/files/simplesaml-metadata-3.php | tee -a bcparks-dam/src/resourcespace/files/config.php
tee -a bcparks-dam/src/resourcespace/files/config.php << END
        'X509Certificate' => '${x509_certificate}',
END
sudo cat bcparks-dam/src/resourcespace/files/simplesaml-metadata-4.php | tee -a bcparks-dam/src/resourcespace/files/config.php


# copy the customized config.php file to overwrite the resourcespace config
cd /opt/bitnami/resourcespace/include
sudo cp config.php config.php.bitnami
sudo cp /home/bitnami/repos/bcparks-dam/src/resourcespace/files/config.php .
sudo chown bitnami:daemon config.php
sudo chmod 664 config.php


# copy the favicon, header image, and custom font (BC Sans)
sudo mkdir /opt/bitnami/resourcespace/filestore/system/config
sudo chown bitnami:daemon /opt/bitnami/resourcespace/filestore/system/config
sudo chmod 775 /opt/bitnami/resourcespace/filestore/system/config
cd /opt/bitnami/resourcespace/filestore/system/config
sudo cp /home/bitnami/repos/bcparks-dam/src/resourcespace/files/header_favicon.png .
sudo cp /home/bitnami/repos/bcparks-dam/src/resourcespace/files/linkedheaderimgsrc.png .
sudo cp /home/bitnami/repos/bcparks-dam/src/resourcespace/files/custom_font.woff2 .
sudo chown bitnami:daemon *.*
sudo chmod 664 *.*


# extract the Montala Support plugin
cd /opt/bitnami/resourcespace/filestore/system
sudo unzip /home/bitnami/repos/bcparks-dam/src/resourcespace/files/montala_support.zip
sudo chown -R bitnami:daemon plugins
sudo chmod -R 775 plugins


# Delete cache files
sudo rm /opt/bitnami/resourcespace/filestore/tmp/querycache/*


# Clear the tmp folder
echo '### Clear the tmp folder ###'
sudo rm -rf /opt/bitnami/resourcespace/filestore/tmp/*


# Set the php memory_limit (999M recommended by Montala)
sudo sed -i 's|memory_limit = .*|memory_limit = 2048M|' /opt/bitnami/php/etc/php.ini
sudo sed -i 's|post_max_size = .*|post_max_size = 2048M|' /opt/bitnami/php/etc/php.ini
sudo sed -i 's|upload_max_filesize = .*|upload_max_filesize = 2048M|' /opt/bitnami/php/etc/php.ini
sudo sed -i 's|max_file_uploads = .*|max_file_uploads = 40|' /opt/bitnami/php/etc/php.ini
sudo sed -i 's|upload_tmp_dir = .*|upload_tmp_dir = /opt/bitnami/resourcespace/filestore/tmp|' /opt/bitnami/php/etc/php.ini
sudo sed -i 's|date.timezone = .*|date.timezone = "America/Vancouver"|' /opt/bitnami/php/etc/php.ini
sudo sed -i 's|max_execution_time = .*|max_execution_time = 150|' /opt/bitnami/php/etc/php.ini
sudo sed -i 's|max_input_time = .*|max_input_time = 180|' /opt/bitnami/php/etc/php.ini
# ImageMagick config to handle images larger than 128MP
sudo sed -i 's|<policy domain="resource" name="memory" value="[^"]*"/>|<policy domain="resource" name="memory" value="2GiB"/>|' /etc/ImageMagick-6/policy.xml
sudo sed -i 's|<policy domain="resource" name="map" value="[^"]*"/>|<policy domain="resource" name="map" value="4GiB"/>|' /etc/ImageMagick-6/policy.xml
sudo sed -i 's|<policy domain="resource" name="area" value="[^"]*"/>|<policy domain="resource" name="area" value="200MP"/>|' /etc/ImageMagick-6/policy.xml
sudo sed -i 's|<policy domain="resource" name="disk" value="[^"]*"/>|<policy domain="resource" name="disk" value="5GiB"/>|' /etc/ImageMagick-6/policy.xml
sudo sed -i 's|<!-- <policy domain="resource" name="thread" value="[^"]*"/> -->|<policy domain="resource" name="thread" value="2"/>|' /etc/ImageMagick-6/policy.xml


# Add PHP to path
export PATH=$PATH:/opt/bitnami
export PATH=$PATH:/opt/bitnami/php
export PATH=$PATH:/opt/bitnami/php/sbin

# Set the cronjob for the offline job script, to generate previews in the background for improved performance
(crontab -l -u bitnami 2>/dev/null; echo "*/2 * * * * cd /opt/bitnami/resourcespace/pages/tools && /opt/bitnami/php/bin/php offline_jobs.php --max-jobs 2") | sudo crontab -u bitnami -


# Install APC User Cache (APCu)
# https://pecl.php.net/package/APCu
sudo apt-get -y install build-essential autoconf
cd /tmp
sudo mkdir apcu
cd apcu
# Set to the latest version compatible with your php version
sudo wget https://pecl.php.net/get/apcu-5.1.23.tgz
sudo tar -xf apcu-5.1.23.tgz
cd apcu-5.1.23
sudo /opt/bitnami/php/bin/phpize
sudo ./configure --with-php-config=/opt/bitnami/php/bin/php-config
sudo make
sudo make install
echo "extension=apcu.so" | sudo tee /opt/bitnami/php/etc/conf.d/apcu.ini
cd /tmp
sudo rm -R apcu


# Install performance monitor utility
sudo apt-get install -y htop


# Update the slideshow directory in config.php
sudo cp /home/bitnami/repos/bcparks-dam/src/resourcespace/files/update_slideshow.sh /tmp/
sudo chmod +x /tmp/update_slideshow.sh
sudo /tmp/update_slideshow.sh
sudo rm /tmp/update_slideshow.sh


sudo /opt/bitnami/ctlscript.sh restart
sudo rm /opt/bitnami/resourcespace/filestore/tmp/process_locks/*