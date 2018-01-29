<?php

require_once("session.php");
require_once('connect_db.php');
//javascriptからphpへ配列データを送る
$json = file_get_contents("php://input");
$data = json_decode($json,TRUE);
//print_r($data);
$eval_user_id = $_SESSION['id'];
//データベースへ入力内容を登録
$i = $data[3]["num"];
try {
    $evaled_user_id = $data[$i]["user_id"];
    $q_id = $data[$i]["q_id"];
    $reason = $data[$i]["reason"];
    $value = $data[$i]["eval"];
    $timestamp = time();


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo -> prepare("INSERT INTO post_eval_tbl (q_id ,value, reason, evaled_user_id, eval_user_id , time) VALUES (:q_id,:value,:reason, :evaled_user_id, :eval_user_id ,:time)");
    $stmt->bindParam(':q_id', $q_id, PDO::PARAM_INT);
    $stmt->bindParam(':value', $value, PDO::PARAM_INT);
    $stmt->bindParam(':reason', $reason, PDO::PARAM_STR);
    $stmt->bindParam(':evaled_user_id', $evaled_user_id, PDO::PARAM_INT);
    $stmt->bindParam(':eval_user_id', $eval_user_id, PDO::PARAM_INT);
    $stmt->bindParam(':time', $timestamp, PDO::PARAM_INT);
    $stmt->execute();

    //データベース切断
    $pdo = null;
    } catch (Exception $e) {
      echo $e->getMessage();
    }

?>
