<?php

/**
 * 良い問いとは何か，の回答を保存
 */
require_once('redirect.php');
require_once('./Database/DataOperator.php');

$reason = $_POST["reason"];
$user_id = $_SESSION["id"];
$timestamp = time();

try {
  //sample_tblへ問いを登録
  $operator_for_about_question_tbl = new DataOperator;
  $prepared_statement_1 = "INSERT INTO about_question_tbl (user_id, reason, time) VALUES (:user_id,:reason,:time)";
  $operator_for_about_question_tbl->setStatement($prepared_statement_1);
  $operator_for_about_question_tbl->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $operator_for_about_question_tbl->bindParam(':reason', $reason, PDO::PARAM_STR);
  $operator_for_about_question_tbl->bindParam(':time', $timestamp, PDO::PARAM_INT);
  $operator_for_about_question_tbl->execute();
  header('Location: view_question.php');
  exit;
} catch (Exception $e) {
  echo $e->getMessage();
}

?>
