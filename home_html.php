<?php
require_once('session.php');
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./style.css">

    <title>根源くんのホーム</title>
  </head>
  <body>
    <div class="wrapper">
      <div class="header">
        <h2>根源くんへようこそ</h2><br>
      </div>
      <div class="content" >
        <div class="leftArea">
          <table border = "2" id = "q_data">
            <tr>
              <th>Link</th>
            </tr>
            <tr>
              <td><a href="input_text_html.php">今週の問いを投稿</a></td>
            </tr>
            <tr>
              <td><a href="value_html.php">議論前に問いを評価</a></td>
            </tr>
            <tr>
              <td><a href="post_value_html.php">議論後に問いを評価</a></td>
            </tr>
            <tr>
              <td><a href="input_about_question_html.php">良い問いとは悪い問いとは</a></td>
            </tr>
            <tr>
              <td><a href="logout.php">ログアウト</a></td>
            </tr>
          </table>

        </div>

        <div class="rightArea">
          <img src="kongen2.png">
        </div>
      </div>

    </div>
  </body>
</html>
