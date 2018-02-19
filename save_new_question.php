<?php

/**
 * 入力された新しい問いをデータベースに追加する
 */

require_once('redirect.php');
require_once("./Database/DataOperator.php");

 
$question = $_POST["question"];
$reason = $_POST["reason"];
$value = $_POST["value"];
$user_id = $_SESSION["id"];
$timestamp = time();

//データベースへ入力内容を登録
try {
  //sample_tblへ問いを登録
  $operator_for_sample_tbl = new DataOperator;
  $prepared_statement_1 = "INSERT INTO sample_tbl (question , user_id , time) VALUES (:question, :user_id , :time)";
  $operator_for_sample_tbl->setStatement($prepared_statement_1);
  $operator_for_sample_tbl->bindParam(':question', $question, PDO::PARAM_STR);
  $operator_for_sample_tbl->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $operator_for_sample_tbl->bindParam(':time', $timestamp, PDO::PARAM_INT);
  $operator_for_sample_tbl->execute();
    
  //最後にinsertした行を取得
  $q_id = $operator_for_sample_tbl->getPDO()->lastInsertId('q_id');
  
  //self_eval_tblへ評価を登録
  $operator_for_self_eval = new DataOperator;
  $prepared_statement_2 = "INSERT INTO self_eval_tbl (user_id,q_id ,value, reason, eval_id , time) VALUES (:user_id,:q_id,:value,:reason,:eval_id,:time)";
  $operator_for_self_eval->setStatement($prepared_statement_2);
  $operator_for_self_eval->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $operator_for_self_eval->bindParam(':q_id', $q_id, PDO::PARAM_INT);
  $operator_for_self_eval->bindParam(':value', $value, PDO::PARAM_INT);
  $operator_for_self_eval->bindParam(':reason', $reason, PDO::PARAM_STR);
  $operator_for_self_eval->bindParam(':eval_id', $eval_id, PDO::PARAM_INT);
  $operator_for_self_eval->bindParam(':time', $timestamp, PDO::PARAM_INT);
  $operator_for_self_eval->execute();

  header('Location: view_question.php');
  
} catch (Exception $e) {
  echo $e->getMessage();
  echo "string";
  }

?>
