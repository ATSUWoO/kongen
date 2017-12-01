<?php

require_once('config.php');
require_once('connect_db.php');

session_start();

if (!empty($_SESSION['me'])) {
    header('Location: '.SITE_URL);
    exit;
}

function getUser($email, $password, $dbh) {
    $sql = "select * from users where email = :email and password = :password limit 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(":email"=>$email, ":password"=>getSha1Password($password)));
    $user = $stmt->fetch();
    return $user ? $user : false;
}

$email = $_POST['email'];
$password = $_POST['password'];

$err = array();

if (empty($err)) {
      $_SESSION['me'] = $me;
      header("Location:./index.php");
      exit;
   }




?>
