<?php
require_once('session.php');
 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <br>
      <a href="home_html.php">ホーム画面へ</a><br>
  <meta charset="utf-8" />
  <title>問いの一覧</title>

  <script src="https://code.jquery.com/jquery-1.9.0.min.js"></script>
  <script>
  $(document).ready(function() {
    $.ajax({
      type: "POST",
      url: "select.php",
      dataType: "json",
    }).done(function(data, dataType) {

      if(data == null) alert('データが0件でした');

      // 返ってきたデータの表示
      console.log(data);
      var $content = $('#content');
      var target = document.getElementById("q_data");
      console.log(typeof(target));
      for (var i =0; i<data.length; i++) {
        target.innerHTML += "<tr><td>"+data[i].q_id+"</td><td>"+data[i].question+"</td><td>"+data[i].user_id+"</td></tr>"
          }

    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
      alert('Error : ' + errorThrown);
      console.log(data);
    });
  });


  </script>
</head>
<body>
  <h1>これまでの投稿</h1>
  <ul id="content"></ul>

  <table border = "2" id = "q_data">
    <tr>
      <th>q_id</th><th>question</th><th>user_id</th>
    </tr>
  </table>

<!-- <input type="button" onclick="location.href ='select_ascsort_html.php'" value="評価順に昇順ソート">
<input type="button" onclick="location.href ='select_descsort_html.php'" value="評価順に降順ソート"> -->
<input type="button" onclick="location.href ='select_idsort_html.php'" value="id　順にソート">
<input type="button" onclick="location.href ='select_timesort_asc_html.php'" value="古い　順にソート">
<input type="button" onclick="location.href ='select_timesort_desc_html.php'" value="更新　順にソート">

</body>
</html>
