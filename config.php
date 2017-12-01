<?php

define('DSN', 'mysql:host=localhost;dbname=sns_php');
define('DB_USER', 'dbuser');
define('DB_PASSWORD', '********');

define('SITE_URL', 'http://xxxxxx/sns_php/');
define('PASSWORD_KEY', '**********');

error_reporting(E_ALL & ~E_NOTICE);

session_set_cookie_params(0, '/sns_php/');
