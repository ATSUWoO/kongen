<?php

require_once('session.php');
require_once('./Database/DataSelector.php');
session_start();

// ログインボタンが押されたら
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (empty($_POST['email'])){
    $error = 'ユーザーIDが未入力です。';
  } else if (empty($_POST['password'])){
    $error = 'パスワードが未入力です。';
  } else {
    $email = $_POST['email'];
    $password = $_POST['password'];
     
    $selector = new DataSelector;
    $sql = "SELECT * FROM users WHERE email = '".$email."'";
    $stmt = $selector->getStatement($sql);

    if ($result = $stmt->fetchObject()){
      if (password_verify($password, $result->password) == TRUE){
	$_SESSION['id'] = $result->user_id;
	$_SESSION['login_flag'] = TRUE;
	header('Location: index.php');
	exit;
      } else {
	echo "ユーザーIDあるいはパスワードに誤りがあります。";
	$email = $_POST['email'];
      }
    }
  }
} else {
  $email = "";
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>ログイン画面</title>
  </head>
  <body>
    <h1>ログイン</h1>
    <form action="login.php" method="POST">
      <p>メールアドレス：<input type="text" required autofocus pattern="([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$"   name="email" value="<?php echo $email; ?>"></p>
      <p>パスワード：<input type="password" minlength="4" required="required" autofocus  name="password" value=""></p>
      <p><input type="submit" id="login" name="login" value="ログイン">
      <a href="signup.php">新規登録はこちら！</a></p>
    </form>
  </body>
</html>
