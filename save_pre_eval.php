<?php

/**
 * 議論前の問いの評価についての入力を保存する
 */

require_once("redirect.php");
require_once('./Database/DataOperator.php');
require_once('./Database/DataSelector.php');

//javascriptからphpへ配列データを送る
$json = file_get_contents("php://input");
$data = json_decode($json, TRUE);
$eval_user_id = $_SESSION['id'];
$timestamp = time();
$selector = new DataSelector;

//データベースへ入力内容を登録
for ($i=0; $i<count($data); $i++) {
    $q_id = $data[$i]["q_id"];
    $reason = $data[$i]["reason"];
    $value = $data[$i]["eval"];
    $contributer_id = $selector->getQuestionContributer($q_id);

    if ( !$selector->checkAlreadyEval($eval_user_id, $q_id) ){
      // まだ評価していない      
      // pre_eval_tblへ問いを登録
      $operator_for_pre_eval_tbl = new DataOperator;
      $prepared_statement_1 = "INSERT INTO pre_eval_tbl (q_id ,value, reason, evaled_user_id, eval_user_id, time) VALUES (:q_id, :value, :reason, :evaled_user_id, :eval_user_id, :time)";
      $operator_for_pre_eval_tbl->setStatement($prepared_statement_1);
      $operator_for_pre_eval_tbl->bindParam(':q_id', $q_id, PDO::PARAM_INT);
      $operator_for_pre_eval_tbl->bindParam(':value', $value, PDO::PARAM_INT);
      $operator_for_pre_eval_tbl->bindParam(':reason', $reason, PDO::PARAM_STR);
      $operator_for_pre_eval_tbl->bindParam(':evaled_user_id', $contributer_id, PDO::PARAM_INT);
      $operator_for_pre_eval_tbl->bindParam(':eval_user_id', $eval_user_id, PDO::PARAM_INT);
      $operator_for_pre_eval_tbl->bindParam(':time', $timestamp, PDO::PARAM_INT);
      $operator_for_pre_eval_tbl->execute();
    } else {
      // 既に評価している
      $operator_for_pre_eval_tbl = new DataOperator;
      $prepared_statement_1 = "UPDATE pre_eval_tbl SET value=:value, reason=:reason, time=:time WHERE q_id=:q_id and eval_user_id=:user_id";
      $operator_for_pre_eval_tbl->setStatement($prepared_statement_1);
      $operator_for_pre_eval_tbl->bindParam(':q_id', $q_id, PDO::PARAM_INT);
      $operator_for_pre_eval_tbl->bindParam(':value', $value, PDO::PARAM_INT);
      $operator_for_pre_eval_tbl->bindParam(':reason', $reason, PDO::PARAM_STR);
      $operator_for_pre_eval_tbl->bindParam(':user_id', $contributer_id, PDO::PARAM_INT);
      $operator_for_pre_eval_tbl->bindParam(':time', $timestamp, PDO::PARAM_INT);
      $operator_for_pre_eval_tbl->execute();
    } 
}

print_r($data);
?>