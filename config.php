<?php
// HTTP
define('HTTP_SERVER', 'http://localhost/jzeva/');

// HTTPS
define('HTTPS_SERVER', 'http://localhost/jzeva/');

define('DOCROOT',$_SERVER['DOCUMENT_ROOT'].'/');

// DIR
define('DIR_APPLICATION', DOCROOT.'jzeva/catalog/');
define('DIR_SYSTEM', DOCROOT.'jzeva/system/');
define('DIR_LANGUAGE', DOCROOT.'jzeva/catalog/language/');
define('DIR_TEMPLATE', DOCROOT.'jzeva/catalog/view/theme/');
define('DIR_CONFIG', DOCROOT.'jzeva/system/config/');
define('DIR_IMAGE', DOCROOT.'jzeva/image/');
define('DIR_CACHE', DOCROOT.'jzeva/system/storage/cache/');
define('DIR_DOWNLOAD', DOCROOT.'jzeva/system/storage/download/');
define('DIR_LOGS', DOCROOT.'jzeva/system/storage/logs/');
define('DIR_MODIFICATION', DOCROOT.'jzeva/system/storage/modification/');
define('DIR_UPLOAD', DOCROOT.'jzeva/system/storage/upload/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'db_jzeva_backend');
define('DB_PORT', '3306');
define('DB_PREFIX', '');
