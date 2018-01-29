<?php
require_once('session.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <br>
        <a href="home_html.php">ホーム画面へ</a><br>
    <meta charset="utf-8">
    <title>入力フォーム</title>
  </head>
<body>
  一般的にあなたの考える良い問いとは何か，悪い問いとは何か
    <form action="input_about_question.php" method="post">
    <br>
    <textarea name="reason" rows="15" cols="100"　id = "t1"　></textarea>
    <button id = "eval" type="submit"  name="button" value ='send'>投稿</button>
    </form>
  <script src="https://code.jquery.com/jquery-1.9.0.min.js"></script>
  <script type="text/javascript">
//notification発動！
$('#eval').on('click', notification);
function notification()
 {

    Notification.requestPermission();
    var options = {
        body : "Mr KONGEN",
        icon : './kongen2.JPG'
    }
    var n = new Notification("投稿ありがとう！！！！！",options);
    // タイムアウト設定
    setTimeout(n.close.bind(n), 5000);
}
  </script>
  </body>
</html>
