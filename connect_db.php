<?php
//データベースに接続
try {
    $pdo = new PDO ( 'mysql:dbname=sample_db; host=localhost;port=8889; charset=utf8', 'root', 'root' ,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    ;
} catch ( PDOException $e ) {
    print "接続エラー:{$e->getMessage()}";
}

?>
