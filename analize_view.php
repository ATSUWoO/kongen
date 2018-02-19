<?php

require_once('redirect.php');
require_once('analize.php');
require_once('./Database/DataSelector.php');
require_once('./Database/DataOperator.php');

$user_id = $_SESSION["id"];
$operator = new DataOperator;
$selector = new DataSelector;
$username = $selector->getUserName($_SESSION['id']);

$analizer = new Analizer;

?>


<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>問いの分析</title>
    <meta charset="utf-8" />
    <script src="https://code.jquery.com/jquery-1.9.0.min.js"></script>
  </head>
  <body>
    <h1>問いの分析</h1>
    
    <table border="2" id = "q_data">
      <tr>
	<th>q_id</th>
	<th>question</th>
	<th>self_eval</th>
	<th>pre_eval_ave</th>
	<th>post_eval_ave</th>
      </tr>
      <?php
	foreach($analizer->getDataList() as $key => $value){
               echo "<tr><td>{$value->q_id}</td><td>{$value->question}</td><td>{$value->self_eval_value}</td><td>{$value->pre_eval_value}</td><td>{$value->post_eval_value}</td></tr>\n";
         }
      ?>
    </table>
    
    <br /><br />
    <a href="index.php">ホーム画面へ</a>
  </body>
</html>
