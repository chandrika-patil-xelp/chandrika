<?php

if(stristr($_SERVER['HTTP_HOST'],'beta.xelpmoc.in'))
{
// HTTP
define('HTTP_SERVER', 'http://beta.xelpmoc.in/jzeva/backend/');

// HTTPS
define('HTTPS_SERVER', 'http://beta.xelpmoc.in/jzeva/backend/');

// DIR
define('DIR_APPLICATION', '/usr/share/nginx/html/jzeva/backend/catalog/');
define('DIR_SYSTEM', '/usr/share/nginx/html/jzeva/backend/system/');
define('DIR_LANGUAGE', '/usr/share/nginx/html/jzeva/backend/catalog/language/');
define('DIR_TEMPLATE', '/usr/share/nginx/html/jzeva/backend/catalog/view/theme/');
define('DIR_CONFIG', '/usr/share/nginx/html/jzeva/backend/system/config/');
define('DIR_IMAGE', '/usr/share/nginx/html/jzeva/backend/image/');
define('DIR_CACHE', '/usr/share/nginx/html/jzeva/backend/system/storage/cache/');
define('DIR_DOWNLOAD', '/usr/share/nginx/html/jzeva/backend/system/storage/download/');
define('DIR_LOGS', '/usr/share/nginx/html/jzeva/backend/system/storage/logs/');
define('DIR_MODIFICATION', '/usr/share/nginx/html/jzeva/backend/system/storage/modification/');
define('DIR_UPLOAD', '/usr/share/nginx/html/jzeva/backend/system/storage/upload/');

}
else
{
	// HTTP
define('HTTP_SERVER', 'http://localhost/jzeva/backend/');

// HTTPS
define('HTTPS_SERVER', 'http://localhost/jzeva/backend/');

// DIR
define('DIR_APPLICATION', 'C:/xampp/htdocs/jzeva/backend/catalog/');
define('DIR_SYSTEM', 'C:/xampp/htdocs/jzeva/backend/system/');
define('DIR_LANGUAGE', 'C:/xampp/htdocs/jzeva/backend/catalog/language/');
define('DIR_TEMPLATE', 'C:/xampp/htdocs/jzeva/backend/catalog/view/theme/');
define('DIR_CONFIG', 'C:/xampp/htdocs/jzeva/backend/system/config/');
define('DIR_IMAGE', 'C:/xampp/htdocs/jzeva/backend/image/');
define('DIR_CACHE', 'C:/xampp/htdocs/jzeva/backend/system/storage/cache/');
define('DIR_DOWNLOAD', 'C:/xampp/htdocs/jzeva/backend/system/storage/download/');
define('DIR_LOGS', 'C:/xampp/htdocs/jzeva/backend/system/storage/logs/');
define('DIR_MODIFICATION', 'C:/xampp/htdocs/jzeva/backend/system/storage/modification/');
define('DIR_UPLOAD', 'C:/xampp/htdocs/jzeva/backend/system/storage/upload/');
}

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'db_jzeva_backend');
define('DB_PORT', '3306');
define('DB_PREFIX', '');
