<?php

require_once('session.php');
if ($_SERVER["REQUEST_METHOD"] != POST){
$sample = "mojiretsu";
include 'input.php';
}else{

//データベースに接続
require_once('connect_db.php');

$question = $_POST["question"];
$reason = $_POST["reason"];
$value = $_POST["value"];
//データベースへ入力内容を登録

try {
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo -> prepare("INSERT INTO sample_tbl (question, reason, value,q_id) VALUES (:question, :reason, :value,:q_id)");
$stmt->bindParam(':question', $question, PDO::PARAM_STR);
$stmt->bindParam(':reason', $reason, PDO::PARAM_STR);
$stmt->bindParam(':value', $value, PDO::PARAM_INT);

$stmt->execute();
//データベース切断
$pdo = null;

} catch (Exception $e) {
echo $e->getMessage();
echo "string";
}

}
 ?>
