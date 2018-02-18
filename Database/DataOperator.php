<?php

require_once(__DIR__."/DBAccessor.php");

class DataOperator{

  private $db_accessor;
  private $pdo;
  private $statement;
  
  function __construct(){
    $this->db_accessor = new DBAccessor;
    $this->pdo = $this->db_accessor->getPDO();
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function getPDO(){
    return $this->pdo;
  }
  
  public function getStatement($query){
    return $this->statement;
  }

  public function setStatement($prepare_statement){
    $this->statement = $this->pdo->prepare($prepare_statement);
  }

  public function bindParam($param, $param_value, $param_type){
    $this->statement->bindParam($param, $param_value, $param_type);
  }

  public function execute(){
    $this->statement->execute();
  }
  
}


?>