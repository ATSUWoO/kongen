<?php
//データベースに接続
require_once('connect_db.php');


$question = $_POST["question"];
$reason = $_POST["reason"];
$value = $_POST["value"];

echo $question;
//データベースへ入力内容を登録
$stmt = $pdo->query("SELECT * FROM sable_tbl ");
echo $question;
$stmt = $pdo -> prepare("INSERT INTO sample_tbl (question, reason, value) VALUES (:question, :reason, :value)");
$stmt->bindParam(':question', $question, PDO::PARAM_STR);
$stmt->bindParam(':reason', $reason, PDO::PARAM_STR);
$stmt->bindParam(':value', $value, PDO::PARAM_INT);
$stmt->execute();

//データベース切断
$pdo = null;

 ?>
