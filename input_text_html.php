<?php
require_once('session.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>入力フォーム</title>
  </head>
<body>
  問の投稿ページです！
    <form action="input_text.php" method="post">
    <input type = "text" name = "question" placeholder="問を投稿してください"   />
    <br>
    <label for="t1">理由投稿</label>
    <textarea name="reason" rows="15" cols="100"　id = "t1"　>理由を投稿してください</textarea>
      [評価リスト]
      <select name = "value" size = "1" >
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
        <button id = "eval" type="submit"  name="button" value ='send'>自己評価</button>
      </select>
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
