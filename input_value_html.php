<?php

$value2 = array();
$q_id = array();
for ($i=0; $i <data.length ; $i++) {
   $value2[$i] = $_POST["eval.$i." ];
   $q_id[$i] = $_SESSION['"q_id".$i. '];

}
var_dump($value2);
//データベースへ入力内容を登録

try {
  for ($i=0; $i < $value2.length; $i++) {
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $pdo -> prepare(" UPDATE sample_tbl SET value2 = :value2 WHERE :q_id = q_id");
$stmt->bindParam(':value2', $value2[$i], PDO::PARAM_INT);
$stmt->bindParam(':q_id', $q_id[$i], PDO::PARAM_INT);

$stmt->execute();
//データベース切断
}
$pdo = null;
header('Location: select_html.php');

} catch (Exception $e) {
echo $e->getMessage();
echo "string";
}
?>
