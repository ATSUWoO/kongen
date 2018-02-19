<?php

require_once('./Database/DataSelector.php');
require_once('./Database/DataOperator.php');

class Analizer{

  public function getDataList(){
    /**
     * 分析用のデータ
     */
  
    $timestamp = time();
    $last_week_time = $timestamp - (8 * 24 * 60 * 60);
    $user_id = $_SESSION['id'];
  
    // メインデータ取得
    $selector = new DataSelector;

    $sql = "SELECT sample_tbl.q_id, sample_tbl.question, sample_tbl.time, Avg(self_eval_tbl.value) as self_eval_value, Avg(pre_eval_tbl.value) as pre_eval_value, Avg(post_eval_tbl.value) as post_eval_value FROM sample_tbl left join self_eval_tbl on sample_tbl.q_id=self_eval_tbl.q_id left join pre_eval_tbl on sample_tbl.q_id=pre_eval_tbl.q_id left join post_eval_tbl on sample_tbl.q_id= post_eval_tbl.q_id group by q_id"; // WHERE sample_tbl.time >= {$last_week_time}

    $stmt = $selector->getStatement($sql);

    $return_array = null;
    while ($row =  $stmt->fetchObject()){
      $return_array[] = $row;
    }
    return $return_array;
  }

  
  public function preEvalAverage($q_id){
    
    return 0;
  }

  public function postEvalAverage($q_id){

    return 0;
  }
}
?>