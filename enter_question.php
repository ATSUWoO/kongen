<?php
require_once('redirect.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>問いの投稿ページ</title>
  </head>
  <body>
    <h1>問いの投稿ページです！</h1>
    <form action="save_new_question.php" method="post">
      <label for="quest"><h2>理由投稿</h2></label>
      <textarea id="quest" name="question" rows="2" cols="100" placeholder="問いを投稿してください" required="required"></textarea>
      <br>
      <div style="clear:both;"></div>
      <label for="t1"><h2>理由投稿</h2></label>
      <textarea id="t1" name="reason" rows="15" cols="100" placeholder="その問いを選んだ理由を投稿してください" required="required"></textarea>
      <br />
      <label for="eval_list">[評価リスト]
      <select id="eval_list" name="value" size="1">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <br />
      <button id="eval" type="submit" name="button" value="send">問いを投稿する</button>
    </form>

    <br /><br />
    <a href="index.php">ホーム画面へ</a><br>
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.0.min.js"></script>
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
