<?php

require_once(__DIR__."/../Config/DBConfig.php");

/**
 * Database accessor for 根源くん
 * You should access to Mysql database via this class
 * Usage: 
 *   $pdo = new DBAccessor()->getPDO();
 */
class DBAccessor{
  private $pdo;
  
  function __construct(){
    //データベースに接続
    try {
      $this->pdo = new PDO(DBConfig::DB_DSN, DBConfig::DB_USER, DBConfig::DB_PASSWORD);
    } catch ( PDOException $e ) {
      print "接続エラー:{$e->getMessage()}";
      die();
    }
  }

  function __destruct(){
    $this->pdo = null;
  }
  
  public function getPDO(){
    return $this->pdo;
  }

}