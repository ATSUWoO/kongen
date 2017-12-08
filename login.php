<?php

 // セッション開始
session_start();
 // 既にログインしている場合にはメインページに遷移
 if (isset($_SESSION["email"])) {
header('Location: index.html');
 exit();
 }

 // ログインボタンが押されたら

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {

 if (empty($_POST['email'])) {
$error = 'ユーザーIDが未入力です。';
 } else if (empty($_POST['password'])) {
$error = 'パスワードが未入力です。';
 }
 if (!empty($_POST['email']) && !empty($_POST['password'])) {
$email = $_POST['email'];

$dsn = sprintf('mysql:dbname = sample_db; host= 127.0.0.1 ;port = 8889; charset=utf8');

 try {
$pdo = new PDO ( 'mysql:dbname=sample_db; host=localhost;port=8889; charset=utf8', 'root', 'root',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION) );
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
$stmt->execute(array($email));
$password = $_POST['password'];
$result = $stmt->fetch(PDO::FETCH_ASSOC);

 if (password_verify($password, $result[password]))  {
$_SESSION['email'] = $email;
header('Location: index.html');
 exit();

 } else {
echo "ユーザーIDあるいはパスワードに誤りがあります。";
 }
} catch (PDOException $e) {
echo $e->getMessage();
 }
 }
 }
?>
