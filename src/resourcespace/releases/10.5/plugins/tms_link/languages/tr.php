<?php


$lang["tms_link_configuration"]='TMS Bağlantı Yapılandırması';
$lang["tms_link_dsn_name"]='Yerel DSN\'nin TMS veritabanına bağlanmak için adı. Windows\'ta bu, Yönetim araçları->Veri Kaynakları (ODBC) tarafından yapılandırılır. Doğru bağlantının yapılandırıldığından emin olun (32/64 bit)';
$lang["tms_link_table_name"]='TMS verilerini almak için kullanılan TMS tablo veya görünüm adı';
$lang["tms_link_user"]='TMS veritabanı bağlantısı için kullanıcı adı';
$lang["tms_link_password"]='TMS veritabanı kullanıcısı için parola';
$lang["tms_link_resource_types"]='TMS ile bağlantılı kaynak türlerini seçin';
$lang["tms_link_object_id_field"]='TMS nesne kimliğini depolamak için kullanılan alan';
$lang["tms_link_checksum_field"]='Özelliklerin saklanması için kullanılacak metadata alanı. Bu, veriler değişmediğinde gereksiz güncellemeleri önlemek içindir';
$lang["tms_link_checksum_column_name"]='TMS veritabanından döndürülen sağlama toplamı için TMS tablosundan döndürülen sütun.';
$lang["tms_link_tms_data"]='Canlı TMS Verisi';
$lang["tms_link_database_setup"]='TMS veritabanı bağlantısı';
$lang["tms_link_metadata_setup"]='TMS meta verisi yapılandırması';
$lang["tms_link_tms_link_success"]='Bağlantı başarılı';
$lang["tms_link_tms_link_failure"]='Bağlantı başarısız. Lütfen bilgilerinizi kontrol edin.';
$lang["tms_link_test_link"]='TMS\'ye bağlantıyı test et';
$lang["tms_link_tms_resources"]='TMS Kaynakları';
$lang["tms_link_no_tms_resources"]='TMS Kaynağı bulunamadı. Lütfen eklentiyi doğru yapılandırdığınızdan ve doğru ObjectID meta verisi ve sağlama toplamı alanlarını eşleştirdiğinizden emin olun';
$lang["tms_link_no_resource"]='Kaynak belirtilmedi';
$lang["tms_link_resource_id"]='Kaynak Kimliği';
$lang["tms_link_object_id"]='Nesne Kimliği';
$lang["tms_link_checksum"]='Sağlama Toplamı';
$lang["tms_link_no_tms_data"]='TMS\'den veri dönmedi';
$lang["tms_link_field_mappings"]='TMS alanı ile ResourceSpace alanı eşlemeleri';
$lang["tms_link_resourcespace_field"]='ResourceSpace alanı';
$lang["tms_link_column_name"]='TMS Sütunu';
$lang["tms_link_add_mapping"]='Eşleme ekle';
$lang["tms_link_performance_options"]='TMS Komut Dosyası ayarları - bu ayarlar, TMS\'den kaynak verilerini güncelleyen zamanlanmış görevi etkileyecektir';
$lang["tms_link_query_chunk_size"]='Her bir parçada TMS\'den alınacak kayıt sayısı. En uygun ayarı bulmak için bu ayar değiştirilebilir.';
$lang["tms_link_test_mode"]='Test modu - Doğru olarak ayarlayın ve betik çalışacak ancak kaynakları güncellemeyecek';
$lang["tms_link_email_notify"]='Betik bildirimleri göndereceği e-posta adresi. Boş bırakılırsa sistem bildirim adresi varsayılan olarak kullanılacaktır;';
$lang["tms_link_test_count"]='Test edilecek kayıt sayısı - betiği ve performansı test etmek için daha düşük bir sayıya ayarlanabilir';
$lang["tms_link_last_run_date"]='<strong>Son çalıştırılan betik: </strong>';
$lang["tms_link_script_failure_notify_days"]='Betik tamamlanmadıysa uyarı görüntülemek ve e-posta göndermek için gün sayısı';
$lang["tms_link_script_problem"]='UYARI - TMS betiği son %days% gün içinde başarıyla tamamlanmadı. Son çalışma zamanı: ';
$lang["tms_link_upload_tms_field"]='TMS NesneID\'si';
$lang["tms_link_upload_nodata"]='Bu ObjectID için TMS verisi bulunamadı:';
$lang["tms_link_confirm_upload_nodata"]='Lütfen yüklemeye devam etmek istediğinizi onaylamak için kutuyu işaretleyin';
$lang["tms_link_enable_update_script"]='TMS güncelleme betiğini etkinleştir';
$lang["tms_link_enable_update_script_info"]='ResourceSpace zamanlanmış görevi (cron_copy_hitcount.php) çalıştırıldığında TMS verilerini otomatik olarak güncelleyecek betiği etkinleştir.';
$lang["tms_link_log_directory"]='Betik günlüklerini depolamak için dizin. Bu boş bırakılırsa veya geçersizse günlük kaydı yapılmaz.';
$lang["tms_link_log_expiry"]='Komut dosyası günlüklerinin saklanacağı gün sayısı. Bu dizindeki daha eski TMS günlükleri silinecektir';
$lang["tms_link_column_type_required"]='<strong>NOT:</strong> Yeni bir sütun ekliyorsanız, lütfen yeni sütunun sayısal mı yoksa metin verisi mi içerdiğini belirtmek için aşağıdaki uygun listeye sütun adını ekleyin.';
$lang["tms_link_numeric_columns"]='UTF-8 olarak alınması gereken sütunların listesi';
$lang["tms_link_text_columns"]='UTF-16 olarak alınması gereken sütunların listesi';
$lang["tms_link_bidirectional_options"]='Çift yönlü senkronizasyon (RS görüntülerini TMS\'ye ekleme)';
$lang["tms_link_push_condition"]='TMS\'ye eklenmesi için karşılanması gereken metadata kriterleri';
$lang["tms_link_tms_loginid"]='ResourceSpace\'in kayıt eklemek için kullanacağı TMS giriş kimliği. Bu kimlikle bir TMS hesabı oluşturulmalı veya mevcut olmalıdır';
$lang["tms_link_push_image"]='Önizleme oluşturulduktan sonra resmi TMS\'ye gönder? (Bu, TMS\'de yeni bir Medya kaydı oluşturacaktır)';
$lang["tms_link_push_image_sizes"]='TMS\'ye gönderilecek tercih edilen önizleme boyutu. Tercih sırasına göre virgülle ayrılmış, bu nedenle mevcut olan ilk boyut kullanılacaktır';
$lang["tms_link_mediatypeid"]='Eklenecek medya kayıtları için kullanılacak MediaTypeID';
$lang["tms_link_formatid"]='Eklenen medya kayıtları için kullanılacak FormatID';
$lang["tms_link_colordepthid"]='Eklenecek medya kayıtları için kullanılacak ColorDepthID';
$lang["tms_link_media_path"]='TMS\'de saklanacak dosya deposunun kök yolu örn. \\RS_SERVERilestore\\. Sonundaki eğik çizginin dahil olduğundan emin olun. TMS\'de saklanan dosya adı, dosya deposu kökünden itibaren göreceli yolu içerecektir.';
$lang["tms_link_mediapaths_resource_reference_column"]='MedyaMaster tablosunda Kaynak Kimliğini depolamak için kullanılacak sütun. Bu isteğe bağlıdır ve aynı Medya Master Kimliğini kullanan birden fazla kaynağı önlemek için kullanılır.';
$lang["tms_link_modules_mappings"]='Ekstra modüllerden (tablolar/görünümler) senkronizasyon';
$lang["tms_link_module"]='Modül';
$lang["tms_link_tms_uid_field"]='TMS UID alanı';
$lang["tms_link_rs_uid_field"]='ResourceSpace UID alanı';
$lang["tms_link_applicable_rt"]='Uygulanabilir kaynak tür(leri)';
$lang["tms_link_modules_mappings_tools"]='Araçlar';
$lang["tms_link_add_new_tms_module"]='Yeni ekstra TMS modülü ekle';
$lang["tms_link_tms_module_configuration"]='TMS modül yapılandırması';
$lang["tms_link_tms_module_name"]='TMS modül adı';
$lang["tms_link_encoding"]='kodlama';
$lang["tms_link_not_found_error_title"]='Bulunamadı';
$lang["tms_link_not_deleted_error_detail"]='İstenen modül yapılandırması silinemiyor.';
$lang["tms_link_uid_field"]='TMS %module_name %tms_uid_field';
$lang["tms_link_confirm_delete_module_config"]='Bu modül yapılandırmasını silmek istediğinizden emin misiniz? Bu işlem geri alınamaz!';
$lang["tms_link_write_to_debug_log"]='Sistem hata ayıklama günlüğüne betik ilerlemesini dahil et (hata ayıklama günlüğü ayrı olarak yapılandırılmalıdır). Dikkat: Hata ayıklama günlüğü dosyasının hızla büyümesine neden olacaktır.';
$lang["plugin-tms_link-title"]='TMS Bağlantısı';
$lang["plugin-tms_link-desc"]='[Gelişmiş] Kaynak meta verilerinin TMS veritabanından çıkarılmasına izin verir.';