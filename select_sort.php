
<?php

// Ajax通信ではなく、直接URLを叩かれた場合はエラーメッセージを表示
// if (
//     !(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
//     && (!empty($_SERVER['SCRIPT_FILENAME']) && 'select.php' === basename($_SERVER['SCRIPT_FILENAME']))
//     )
// {
//     die ('このページは直接ロードしないでください。');
// }

// 接続文字列 (PHP5.3.6から文字コードが指定できるようになりました)
$dsn = 'mysql:dbname=sample_db;host = 127.0.0.1;charset=utf8';

// ユーザ名
$user = 'root';

// パスワード
$password = 'root';

try
{
    // nullで初期化
    $users = null;

    // DBに接続
    $dbh = new PDO($dsn, $user, $password);
echo "string";
    // 'users' テーブルのデータを取得する
    $sql = 'select * from sample_tbl orderby value';
    $stmt = $dbh->query($sql);

echo "stringaf";

    // 取得したデータを配列に格納
    while ($row = $stmt->fetchObject())
    {
        $users[] = array(
            'question' => $row->question
            ,'reason'=> $row->reason
            ,'value'=> $row->value
            );
    }
echo "aa";
    $data = json_encode($users, JSON_UNESCAPED_UNICODE);
    print_r($data);
    //file_put_contents("sample.txt", $res);
    return $data;
}
catch (PDOException $e)
{
    // 例外処理
    die('Error:' . $e->getMessage());
}

?>
