<?php
require_once("session.php");

$value = array();
$q_id = array();


for ($i=0; $i <20 ; $i++) {
   $value[$i] = $_POST["eval".$i ];
   $q_id[$i] = $_POST["q_id".$i];
}

echo "string";

//データベースへ入力内容を登録

try {
  for ($i=0; $i < $value.length; $i++) {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo -> prepare("INSERT INTO pre_eval_tbl (q_id ,value, reason, eval_id, evaled_user_id,eval_user_id) VALUES (:q_id,:value,:reason,:eval_id, :evaled_user_id, :eval_user_id)");
    $stmt->bindParam(':q_id', $q_id, PDO::PARAM_INT);
    $stmt->bindParam(':value', $value, PDO::PARAM_INT);
    $stmt->bindParam(':reason', $reason, PDO::PARAM_STR);
    $stmt->bindParam(':eval_id', $eval_id, PDO::PARAM_INT);
    $stmt->bindParam(':evaled_user_id', $evaled_user_id, PDO::PARAM_INT);
    $stmt->bindParam(':eval_user_id', $eval_user_id, PDO::PARAM_INT);
    $stmt->execute();
$stmt->execute();
//データベース切断
}
$pdo = null;
// header('Location: select_html.php');

} catch (Exception $e) {
echo $e->getMessage();
echo "string";
}
?>
