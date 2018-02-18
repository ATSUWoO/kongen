<?php

/**
 * 1週間分の問い一覧のJSONを返す
 */
require_once('redirect.php');
require_once('./Database/DataSelector.php');

$data_type = $_GET['type'];

if ($data_type == "all"){
  /**
   * データをすべて表示する場合
   */
  
  // Timestamp ?
  $timestamp = time();
  $last_week_time = $timestamp - (8 * 24 * 60 * 60);

  // データ取得
  $selector = new DataSelector;

  // note：いつかプリペアードステートメントに置き換えるべき
  // 1週間分の問い一覧を取得するクエリの発行(投稿された問いとその自己評価テーブルを結合して検索)
  $sql = "SELECT sample_tbl.q_id, sample_tbl.question, sample_tbl.user_id, sample_tbl.time, self_eval_tbl.reason, self_eval_tbl.value FROM sample_tbl left join self_eval_tbl on sample_tbl.q_id = self_eval_tbl.q_id WHERE sample_tbl.time >= ".$last_week_time;

  $stmt = $selector->getStatement($sql);
  $user_json = $selector->getJson($stmt, 'q_id', 'question', 'user_id', 'reason', 'value', 'time');

  print_r($user_json);
} else if ($data_type == "pre_eval"){
  /**
   * 事前評価のデータ
   */
  
  $timestamp = time();
  $last_week_time = $timestamp - (8 * 24 * 60 * 60);
  $user_id = $_SESSION['id'];
  
  // メインデータ取得
  $selector_for_main = new DataSelector;

  // note：いつかプリペアードステートメントに置き換えるべき
  // 1週間分の問い一覧の中から，既に登録済みの評価も加えて取得
  $sql = "SELECT sample_tbl.q_id, sample_tbl.question, sample_tbl.time, self_eval_tbl.reason AS self_eval_reason , self_eval_tbl.value AS self_eval_value, pre_eval_tbl.reason AS pre_eval_reason, pre_eval_tbl.value AS pre_eval_value FROM sample_tbl left join self_eval_tbl on sample_tbl.q_id = self_eval_tbl.q_id left join pre_eval_tbl on sample_tbl.q_id = pre_eval_tbl.q_id WHERE sample_tbl.time >= {$last_week_time}";

  $stmt = $selector_for_main->getStatement($sql);
  $user_json = $selector_for_main->getJson($stmt, 'q_id', 'question', 'self_eval_reason', 'self_eval_value', 'pre_eval_reason', 'pre_eval_value', 'time');

  print_r($user_json);

} else if ($data_type == "post_eval"){
  /**
   * 事後評価のデータ
   */
  
  $timestamp = time();
  $last_week_time = $timestamp - (8 * 24 * 60 * 60);
  $user_id = $_SESSION['id'];
  
  // メインデータ取得
  $selector_for_main = new DataSelector;

  // note：いつかプリペアードステートメントに置き換えるべき
  // 1週間分の問い一覧の中から，既に登録済みの評価も加えて取得
  $sql = "SELECT sample_tbl.q_id, sample_tbl.question, sample_tbl.time, self_eval_tbl.reason AS self_eval_reason , self_eval_tbl.value AS self_eval_value, post_eval_tbl.reason AS post_eval_reason, post_eval_tbl.value AS post_eval_value FROM sample_tbl left join self_eval_tbl on sample_tbl.q_id = self_eval_tbl.q_id left join post_eval_tbl on sample_tbl.q_id = post_eval_tbl.q_id WHERE sample_tbl.time >= {$last_week_time}";

  $stmt = $selector_for_main->getStatement($sql);
  $user_json = $selector_for_main->getJson($stmt, 'q_id', 'question', 'self_eval_reason', 'self_eval_value', 'post_eval_reason', 'post_eval_value', 'time');

  print_r($user_json);

}
?>