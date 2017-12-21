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
$user_id = $_SESSION["id"];
//データベースへ入力内容を登録

try {
//input_html.phpへ問いを登録
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo -> prepare("INSERT INTO sample_tbl (question , user_id) VALUES (:question, :user_id)");
$stmt->bindParam(':question', $question, PDO::PARAM_STR);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

//最後にinsertした行を取得
$q_id = $pdo->lastInsertId('q_id');

//self_eval.phpへ評価を登録
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo -> prepare("INSERT INTO self_eval_tbl (q_id ,value, reason, eval_id) VALUES (:q_id,:value,:reason,:eval_id)");
$stmt->bindParam(':q_id', $q_id, PDO::PARAM_INT);
$stmt->bindParam(':value', $value, PDO::PARAM_INT);
$stmt->bindParam(':reason', $reason, PDO::PARAM_STR);
$stmt->bindParam(':eval_id', $eval_id, PDO::PARAM_INT);
$stmt->execute();
//データベース切断
$pdo = null;
header('Location: select_html.php');

} catch (Exception $e) {
echo $e->getMessage();
echo "string";
}

}
 ?>
