<?php

require_once('./Database/DataSelector.php');
require_once('./Database/DataOperator.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $selector = new DataSelector;
  $operator = new DataOperator;
  
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // メールアドレス(ユーザ)の重複チェック
  if(!$selector->checkUserMailDuplicate($email)){
    $error_message = "<h3><span style='color:red;'>そのアドレスは既に登録されています</span></h3>";
  } else {
    $sql = "insert into users(name, email, password) values (:name, :email, :password)";
    $operator->setStatement($sql);
    $operator->bindParam('name', $name, PDO::PARAM_STR);
    $operator->bindParam('email', $email, PDO::PARAM_STR);
    $operator->bindParam('password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
    $operator->execute();

    session_start();
    $_SESSION['id'] = $selector->getUserId($email);
    $_SESSION['login_flag'] = TRUE;
    header('Location: index.php');
    exit;
    
  }
} else {
  $name = "";
  $email = "";
  $error_message = "";
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>新規ユーザー登録</title>
  </head>
  <body>
    <h1>新規ユーザー登録</h1>
   <?php echo $error_message; ?>
    <form action="signup.php" method="POST">
      <p>お名前：<input type="text" required="required" autofocus name="name" value="<?php echo $name; ?>"></p>
      <p>メールアドレス：<input type="text" required="required" autofocus pattern="[a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$" name="email" value="<?php echo $email; ?>"></p>
      <p>パスワード：<input type="password" required="required" autofocus  name="password" value=""></p>
      <p><input type="submit" value="新規登録！">
      <a href="login.php">戻る</a></p>
    </form>
  </body>
</html>
