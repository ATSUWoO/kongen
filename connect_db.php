<?php
//データベースに接続
try {
    $sql = new PDO ( 'mysql:dbname = sample_db; host=localhost;port=8889; charset=utf8', 'root', 'root' );
    print '接続に成功しました。';
} catch ( PDOException $e ) {
    print "接続エラー:{$e->getMessage()}";
}

?>
