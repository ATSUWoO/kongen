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
    <h2>理由投稿↓</h2>
    <textarea name="reason" rows="15" cols="100"　id = "t1"　>理由を投稿してください</textarea>
    <br>
      [評価リスト]
      <select name = "value" size = "1" >
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
        <button type="submit" name="button" value ='send'>送信</button>
      </select>
    </form>
    <div >
      <?php
        echo $sample;
       ?>
    </div>
  </body>
</html>