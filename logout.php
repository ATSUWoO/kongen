<?php

require_once('config.php');
require_once('connect_db.php');

session_start();
$_SESSION = array();

if (isset($_COOKIE[session_name()]))
{
    setcookie(session_name(), '', time()-86400, '/sns_php/');
}
session_destroy();
header('Location: login.html');
?>
