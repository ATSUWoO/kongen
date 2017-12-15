<?php
require_once('session.php');
 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <title>jQuery & Ajax通信を使ってPHPからJSON形式のデータを取得して表示する</title>

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
        target.innerHTML += "<tr><td>"+data[i].question+"</td><td>"+data[i].reason+"</td><td>"+data[i].value+"</td></tr>"
          }

    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
      alert('Error : ' + errorThrown);
      console.log(data);
    });
  });

  // var sort = getElementById("sort");
  // sort.addEventListener("click",sort);


  </script>
</head>
<body>
  <h1>jQuery & Ajax通信を使ってPHPからJSON形式のデータを取得して表示する</h1>
  <ul id="content"></ul>

  <table border = "2" id = "q_data">
    <tr>
      <th>question</th><th>reason</th><th>value</th>
    </tr>
  </table>

  <input type="button" name="sort" id = "sort" value="評価順でソート">
  <script type="text/javascript" src="sort.js">

  </script>
</body>
</html>