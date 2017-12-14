<?php
// セッション開始
session_start();
// 既にログインしている場合にはメインページに遷移
if (!isset($_SESSION["id"])) {
header('Location: login.html');
exit;
}
?>
