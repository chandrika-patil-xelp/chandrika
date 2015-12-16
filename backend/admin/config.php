<?php
// HTTP
define('HTTP_SERVER', 'http://localhost/jzeva/backend/admin/');
define('HTTP_CATALOG', 'http://localhost/jzeva/backend/');

// HTTPS
define('HTTPS_SERVER', 'http://localhost/jzeva/backend/admin/');
define('HTTPS_CATALOG', 'http://localhost/jzeva/backend/');

define('DOCROOT',$_SERVER['DOCUMENT_ROOT'].'/');

// DIR
define('DIR_APPLICATION', DOCROOT.'jzeva/backend/admin/');
define('DIR_SYSTEM', DOCROOT.'jzeva/backend/system/');
define('DIR_LANGUAGE', DOCROOT.'jzeva/backend/admin/language/');
define('DIR_TEMPLATE', DOCROOT.'jzeva/backend/admin/view/template/');
define('DIR_CONFIG', DOCROOT.'jzeva/backend/system/config/');
define('DIR_IMAGE', DOCROOT.'jzeva/backend/image/');
define('DIR_CACHE', DOCROOT.'jzeva/backend/system/storage/cache/');
define('DIR_DOWNLOAD', DOCROOT.'jzeva/backend/system/storage/download/');
define('DIR_LOGS', DOCROOT.'jzeva/backend/system/storage/logs/');
define('DIR_MODIFICATION', DOCROOT.'jzeva/backend/system/storage/modification/');
define('DIR_UPLOAD', DOCROOT.'jzeva/backend/system/storage/upload/');
define('DIR_CATALOG', DOCROOT.'jzeva/backend/catalog/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'db_jzeva_backend');
define('DB_PORT', '3306');
define('DB_PREFIX', '');
