<?php

require_once(__DIR__."/DBAccessor.php");

class DataSelector {

  private $db_accessor;
  private $pdo;

  function __construct(){
    $this->db_accessor = new DBAccessor;
    $this->pdo = $this->db_accessor->getPDO();
  }
  
  /**
   * Get encoded json string converted from array
   * 
   * @param PDOStatement $statment: PDOStatement in which you want to convert into JSON form
   * @param Array $json_array: Array as json source
   * @return String (Json string)
   */
  public function getJson($statement, ...$column_names){
    $json_array = array();

    while ($row = $statement->fetchObject()){
      $tmp_data = null;
      foreach ($column_names as $key){
	$tmp_array[$key] = $row->$key;
      }
      $json_array[] = $tmp_array;
    }
    return json_encode($json_array, JSON_UNESCAPED_UNICODE);
  }      

  /**
   * Get statement of entered query
   *
   * @param String $query: The SQL query without symbol ';'
   * @return PDOStatement(PHP Data Object Statement)
   */  
  public function getStatement($query){
    return $this->pdo->query($query);
  }
  
  /**
   * Get all data from the target table
   *
   * @param String $table_name: Target table name
   * @return PDOStatement(PHP Data Object Statement)
   */
  public function getAllData($table_name){
    return $this->getStatement("select * from ".$table_name);
  }

  /**
   * Get all data from the target table
   *
   * @param String $param: Target parameter
   * @param String $table_name: Target table name
   * @param String $cond: Condition (same as Where ~)
   * @return PDOStatement(PHP Data Object Statement)
   */
  public function getSingleData($param, $table_name, $cond){
    return $this->getStatement("select {$param} from {$table_name} {$cond}");
  }  

  /**
   * これまでに入力された問いをすべて表示するメソッド
   */
  public function displayAllQuestion(){
    $stmt = $this->getAllData("sample_tbl");

    $user_json = $this->getJson($stmt, "q_id", "question");

    print_r($user_json);
  }

  public function getUserName($user_id){
    $stmt = $this->getSingleData("name", "users", "where user_id={$user_id}");
    return $stmt->fetchObject()->name;
  }

  public function getUserId($email){
    $stmt = $this->getSingleData("user_id", "users", "where email='{$email}'");
    return $stmt->fetchObject()->user_id;
  }
  
  public function checkUserMailDuplicate($email){
    $stmt = $this->getSingleData("*", "users", "where email='{$email}'");
    if ($stmt->fetchObject()){
      // かぶっている
      return 0;
    } else {
      // かぶりがない
      return 1;
    }
  }

  public function checkAlreadyEval($user_id, $question_id){
    $stmt = $this->getSingleData("*", "pre_eval_tbl", "where eval_user_id='{$user_id}' and q_id={$question_id}");
    if ($stmt->fetchObject()){
      // 既に評価している
      return 1;
    } else {
      // まだ評価していない
      return 0;
    }
  }

  public function getQuestionContributer($user_id, $question_id){
    $stmt = $this->getSingleData("user_id", "pre_eval_tbl", "where eval_user_id='{$user_id}' and q_id={$question_id}");
    return $stmt->fetchObject()->user_id;
  }

  // note: プリペアードステートメントに対応するメソッドも5日定義するべき  
}

?>