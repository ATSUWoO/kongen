<?php
require_once('redirect.php');
require_once('./Database/DataSelector.php');

$selector = new DataSelector;
$user_name = $selector->getUserName($_SESSION['id']);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./static/css/style.css">
    <title>根源くんのホーム</title>
  </head>
  <body>
    <div class="wrapper">
      <div class="header">
      <h2>根源くんへようこそ：<span style="color:blue;"><?php echo $user_name; ?></span>さん</h2><br>
      </div>
      <div class="content" >
        <div class="leftArea">
          <table border = "2" id = "q_data">
            <tr>
              <th>Link</th>
            </tr>
            <tr>
              <td><a href="enter_question.php">今週の問いを投稿</a></td>
            </tr>
            <tr>
              <td><a href="pre_eval.php">議論前に問いを評価</a></td>
            </tr>
            <tr>
              <td><a href="post_eval.php">議論後に問いを評価</a></td>
            </tr>
            <tr>
              <td><a href="eval_good_question.php">良い問いとは悪い問いとは</a></td>
            </tr>
            <tr>
              <td><a href="view_question.php">これまでに投稿された問い</a></td>
            </tr>
            <tr>
              <td><a href="logout.php">ログアウト</a></td>
            </tr>
            <?php if ($user_name == "admin") echo '<tr>
              <td><a href="analize_view.php">分析</a></td>
            </tr>'; ?>
          </table>

        </div>

        <div class="rightArea">
          <img src="./static/img/kongen2.png">
        </div>
      </div>

    </div>
  </body>
</html>
