<?php
require_once('redirect.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>良い問い/悪い問いの定義</title>
  </head>
  <body>
    <h1>あなたの考える「一般的に良い問いとは何か，悪い問いとは何か」</h1>
    <form action="save_about_question.php" method="post">
      <br />
      <textarea id="t1" name="reason" rows="15" cols="100" placeholder="一般的に「良い問い/悪い問い」とは？" required="required"></textarea>
      <br />
      <button id="eval" type="submit" name="button" value="send">回答</button>
    </form>
    <br /><br />
    <a href="index.php">ホーム画面へ</a>
   
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
