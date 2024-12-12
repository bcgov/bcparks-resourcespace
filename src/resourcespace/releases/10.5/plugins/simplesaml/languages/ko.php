<?php


$lang["simplesaml_configuration"]='SimpleSAML 구성';
$lang["simplesaml_main_options"]='사용 옵션';
$lang["simplesaml_site_block"]='SAML을 사용하여 사이트 접근을 완전히 차단합니다. true로 설정되면 인증 없이 누구도 사이트에 접근할 수 없습니다, 익명으로도 접근할 수 없습니다';
$lang["simplesaml_allow_public_shares"]='사이트를 차단하는 경우, 공개 공유가 SAML 인증을 우회하도록 허용하시겠습니까?';
$lang["simplesaml_allowedpaths"]='SAML 요구 사항을 우회할 수 있는 추가 허용 경로 목록';
$lang["simplesaml_allow_standard_login"]='사용자가 표준 계정과 SAML SSO를 사용하여 로그인할 수 있도록 허용하시겠습니까? 경고: 이를 비활성화하면 SAML 인증이 실패할 경우 모든 사용자가 시스템에서 잠길 위험이 있습니다';
$lang["simplesaml_use_sso"]='SSO를 사용하여 로그인하십시오';
$lang["simplesaml_idp_configuration"]='IdP 구성';
$lang["simplesaml_idp_configuration_description"]='다음 항목을 사용하여 플러그인을 IdP와 함께 작동하도록 구성하십시오';
$lang["simplesaml_username_attribute"]='사용자 이름에 사용할 속성. 두 개의 속성을 연결하는 경우 쉼표로 구분하십시오';
$lang["simplesaml_username_separator"]='사용자 이름 필드를 결합할 때 이 문자를 구분 기호로 사용하십시오';
$lang["simplesaml_fullname_attribute"]='전체 이름에 사용할 속성. 두 개의 속성을 결합하는 경우 쉼표로 구분하십시오';
$lang["simplesaml_fullname_separator"]='전체 이름을 결합하는 필드의 경우 이 문자를 구분자로 사용하십시오';
$lang["simplesaml_email_attribute"]='이메일 주소에 사용할 속성';
$lang["simplesaml_group_attribute"]='그룹 멤버십을 결정하는 데 사용할 속성';
$lang["simplesaml_username_suffix"]='표준 ResourceSpace 계정과 구별하기 위해 생성된 사용자 이름에 추가할 접미사';
$lang["simplesaml_update_group"]='각 로그인 시 사용자 그룹 업데이트. SSO 그룹 속성을 사용하여 접근을 결정하지 않는 경우, 사용자가 그룹 간에 수동으로 이동할 수 있도록 이 값을 false로 설정하십시오.';
$lang["simplesaml_groupmapping"]='SAML - ResourceSpace 그룹 매핑';
$lang["simplesaml_fallback_group"]='새로 생성된 사용자에게 사용할 기본 사용자 그룹';
$lang["simplesaml_samlgroup"]='SAML 그룹';
$lang["simplesaml_rsgroup"]='리소스스페이스 그룹';
$lang["simplesaml_priority"]='우선순위 (높은 숫자가 우선합니다)';
$lang["simplesaml_addrow"]='매핑 추가';
$lang["simplesaml_service_provider"]='로컬 서비스 제공자(SP)의 이름';
$lang["simplesaml_prefer_standard_login"]='표준 로그인 선호 (기본적으로 로그인 페이지로 리디렉션)';
$lang["simplesaml_sp_configuration"]='이 플러그인을 사용하려면 simplesaml SP 구성을 완료해야 합니다. 자세한 내용은 지식 기반 문서를 참조하십시오';
$lang["simplesaml_custom_attributes"]='사용자 기록에 대해 기록할 사용자 정의 속성';
$lang["simplesaml_custom_attribute_label"]='SSO 속성 - ';
$lang["simplesaml_usercomment"]='SimpleSAML 플러그인에 의해 생성됨';
$lang["origin_simplesaml"]='SimpleSAML 플러그인';
$lang["simplesaml_lib_path_label"]='SAML 라이브러리 경로 (전체 서버 경로를 지정해 주세요)';
$lang["simplesaml_login"]='SAML 자격 증명을 사용하여 ResourceSpace에 로그인하시겠습니까? (이 옵션이 활성화된 경우에만 해당됩니다)';
$lang["simplesaml_create_new_match_email"]='이메일 일치: 새로운 사용자를 생성하기 전에 SAML 사용자 이메일이 기존 RS 계정 이메일과 일치하는지 확인하십시오. 일치하는 경우 SAML 사용자가 해당 계정을 \'인수\'합니다';
$lang["simplesaml_allow_duplicate_email"]='기존 ResourceSpace 계정에 동일한 이메일 주소가 있는 경우 새 계정을 생성할 수 있도록 허용하시겠습니까? (이메일 일치가 위에 설정되어 있고 하나의 일치 항목이 발견된 경우 이 설정이 무시됩니다)';
$lang["simplesaml_multiple_email_match_subject"]='ResourceSpace SAML - 충돌하는 이메일 로그인 시도';
$lang["simplesaml_multiple_email_match_text"]='새로운 SAML 사용자가 시스템에 접근했지만 동일한 이메일 주소를 가진 계정이 이미 둘 이상 존재합니다.';
$lang["simplesaml_multiple_email_notify"]='이메일 충돌이 발견되면 알릴 이메일 주소';
$lang["simplesaml_duplicate_email_error"]='동일한 이메일 주소로 이미 계정이 존재합니다. 관리자에게 문의하십시오.';
$lang["simplesaml_usermatchcomment"]='SimpleSAML 플러그인에 의해 SAML 사용자로 업데이트되었습니다.';
$lang["simplesaml_usercreated"]='새로운 SAML 사용자 생성됨';
$lang["simplesaml_duplicate_email_behaviour"]='중복 계정 관리';
$lang["simplesaml_duplicate_email_behaviour_description"]='이 섹션은 새로운 SAML 사용자가 로그인할 때 기존 계정과 충돌하는 경우에 대한 조치를 제어합니다';
$lang["simplesaml_authorisation_rules_header"]='승인 규칙';
$lang["simplesaml_authorisation_rules_description"]='ResourceSpace가 IdP의 응답에서 추가 속성(즉, 주장/클레임)을 기반으로 사용자의 추가 로컬 인증을 통해 구성될 수 있도록 합니다. 이 주장은 사용자가 ResourceSpace에 로그인할 수 있는지 여부를 결정하기 위해 플러그인에 의해 사용됩니다.';
$lang["simplesaml_authorisation_claim_name_label"]='속성 (주장/클레임) 이름';
$lang["simplesaml_authorisation_claim_value_label"]='속성 (주장/클레임) 값';
$lang["simplesaml_authorisation_login_error"]='이 애플리케이션에 접근할 수 없습니다! 계정 관리자에게 문의하십시오!';
$lang["simplesaml_authorisation_version_error"]='중요: SimpleSAML 구성을 업데이트해야 합니다. 자세한 내용은 지식 베이스의 \'<a href=\'https://www.resourcespace.com/knowledge-base/plugins/simplesaml#saml_instructions_migrate\' target=\'_blank\'>ResourceSpace 구성을 사용하도록 SP 마이그레이션</a>\' 섹션을 참조하십시오';
$lang["simplesaml_healthcheck_error"]='SimpleSAML 플러그인 오류';
$lang["simplesaml_rsconfig"]='표준 ResourceSpace 구성 파일을 사용하여 SP 구성 및 메타데이터를 설정하시겠습니까? 이 값을 false로 설정하면 파일을 수동으로 편집해야 합니다';
$lang["simplesaml_sp_generate_config"]='SP 구성 생성';
$lang["simplesaml_sp_config"]='서비스 제공자 (SP) 구성';
$lang["simplesaml_sp_data"]='서비스 제공자 (SP) 정보';
$lang["simplesaml_idp_section"]='IdP';
$lang["simplesaml_idp_metadata_xml"]='IdP 메타데이터 XML 붙여넣기';
$lang["simplesaml_sp_cert_path"]='SP 인증서 파일 경로 (생성하려면 비워두고 아래 인증서 세부 정보를 입력하세요)';
$lang["simplesaml_sp_key_path"]='SP 키 파일(.pem) 경로 (생성을 원하면 비워두세요)';
$lang["simplesaml_sp_idp"]='IdP 식별자 (XML을 처리하는 경우 비워 두세요)';
$lang["simplesaml_saml_config_output"]='이것을 ResourceSpace 구성 파일에 붙여넣으세요';
$lang["simplesaml_sp_cert_info"]='인증서 정보 (필수)';
$lang["simplesaml_sp_cert_countryname"]='국가 코드 (2자만)';
$lang["simplesaml_sp_cert_stateorprovincename"]='주, 군 또는 도 이름';
$lang["simplesaml_sp_cert_localityname"]='지역 (예: 읍/도시)';
$lang["simplesaml_sp_cert_organizationname"]='조직 이름';
$lang["simplesaml_sp_cert_organizationalunitname"]='조직 단위 / 부서';
$lang["simplesaml_sp_cert_commonname"]='일반 이름 (예: sp.acme.org)';
$lang["simplesaml_sp_cert_emailaddress"]='이메일 주소';
$lang["simplesaml_sp_cert_invalid"]='잘못된 인증서 정보';
$lang["simplesaml_sp_cert_gen_error"]='인증서를 생성할 수 없습니다';
$lang["simplesaml_sp_samlphp_link"]='SimpleSAMLphp 테스트 사이트 방문';
$lang["simplesaml_sp_technicalcontact_name"]='기술 연락처 이름';
$lang["simplesaml_sp_technicalcontact_email"]='기술 연락 이메일';
$lang["simplesaml_sp_auth.adminpassword"]='SP 테스트 사이트 관리자 비밀번호';
$lang["simplesaml_acs_url"]='ACS URL / 응답 URL';
$lang["simplesaml_entity_id"]='엔터티 ID/메타데이터 URL';
$lang["simplesaml_single_logout_url"]='단일 로그아웃 URL';
$lang["simplesaml_start_url"]='시작/로그인 URL';
$lang["simplesaml_existing_config"]='지식 베이스 지침을 따라 기존 SAML 구성을 마이그레이션하세요';
$lang["simplesaml_test_site_url"]='SimpleSAML 테스트 사이트 URL';
$lang["plugin-simplesaml-title"]='간단한 SAML';
$lang["plugin-simplesaml-desc"]='[고급] ResourceSpace에 접근하려면 SAML 인증이 필요합니다';
$lang["simplesaml_idp_certs"]='SAML IdP 인증서';
$lang["simplesaml_idp_cert_expiring"]='IdP %idpname 인증서가 %expiretime에 만료됩니다';
$lang["simplesaml_idp_cert_expired"]='IdP %idpname 인증서가 %expiretime에 만료되었습니다';
$lang["simplesaml_idp_cert_expires"]='IdP %idpname 인증서가 %expiretime에 만료됩니다';