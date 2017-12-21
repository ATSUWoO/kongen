<?php

//require_once('session.php');

if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')&& (!empty($_SERVER['SCRIPT_FILENAME']) && 'select.php' === basename($_SERVER['SCRIPT_FILENAME'])))
{
    die ('このページは直接ロードしないでください。');
}
$dsn = 'mysql:dbname=sample_db;host = 127.0.0.1;charset=utf8';
$user = 'root';
$password = 'root';
try
{
    // nullで初期化
    $users = null;
    // DBに接続
    $dbh = new PDO($dsn, $user, $password);
    // 'users' テーブルのデータを取得する
    $sql = 'select * from sample_tbl';
    $stmt = $dbh->query($sql);
    // 取得したデータを配列に格納
    while ($row = $stmt->fetchObject())
    {
        $users[] = array
        (
            'q_id' => $row->q_id
            ,'question' => $row->question
        );
    }
    $data = json_encode($users, JSON_UNESCAPED_UNICODE);
    print_r($data);
}
catch (PDOException $e)
{
    // 例外処理
    die('Error:' . $e->getMessage());
}


 ?>
