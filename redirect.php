<?php

session_start();
// ログインしていない場合はログインページへ移動
if (!isset($_SESSION["login_flag"])) {
  header('Location: login.php');
  exit;
}