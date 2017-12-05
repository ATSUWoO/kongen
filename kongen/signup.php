<?php

require_once('config.php');
require_once('connect_db.php');

session_start();

function getSha1Password($s) {
    return (sha1(PASSWORD_KEY.$s));
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$err = array();

if (empty($err)) {
  $sql = "insert into users
          (name, email, password)
          values
          (:name, :email, :password)";
  $stmt = $pdo -> prepare($sql);
  $params = array(
    ":name" => $name,
    ":email" => $email,
    ":password" => getSha1password($password),
  );
  $stmt -> execute($params);
  header('Location: '.SITE_URL.'login.php');
  exit;

}


?>
