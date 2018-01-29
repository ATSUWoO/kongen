<?php

require_once('session.php');
if ($_SERVER["REQUEST_METHOD"] != POST){
$sample = "mojiretsu";
include 'input.php';
}else{

//データベースに接続
require_once('connect_db.php');

$reason = $_POST["reason"];
$user_id = $_SESSION["id"];
$timestamp = time();
//データベースへ入力内容を登録

try {
//最後にinsertした行を取得
//self_eval.phpへ評価を登録
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo -> prepare("INSERT INTO about_question_tbl (user_id, reason, time) VALUES (:user_id,:reason,:time)");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindParam(':reason', $reason, PDO::PARAM_STR);
$stmt->bindParam(':time', $timestamp, PDO::PARAM_INT);
$stmt->execute();
//データベース切断
$pdo = null;
header('Location: home_html.php');

} catch (Exception $e) {
echo $e->getMessage();
echo "string";
}

}
 ?>
