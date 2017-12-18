<?php
require_once('session.php');
 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <title></title>

  <script src="https://code.jquery.com/jquery-1.9.0.min.js"></script>
  <script>
  $(document).ready(function() {
    $.ajax({
      type: "POST",
      url: "select_descsort.php",
      dataType: "json",
    }).done(function(data, dataType) {

      if(data == null) alert('データが0件でした');

      // 返ってきたデータの表示
      console.log(data);
      var $content = $('#content');
      var target = document.getElementById("q_data");
      console.log(typeof(target));
      for (var i =0; i<data.length; i++) {
        target.innerHTML += "<tr><td>"+data[i].q_id+"</td><td>"+data[i].question+"</td><td>"+data[i].reason+"</td><td>"+data[i].value+"</td><td>"+data[i].user_id+"</td></tr>"
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
  <h1></h1>
  <ul id="content"></ul>

  <table border = "2" id = "q_data">
    <tr>
      <th>q_id</th><th>question</th><th>reason</th><th>value</th><th>user_id</th>
    </tr>
  </table>

  <input type="button" onclick="location.href ='select_ascsort_html.php'" value="評価順に昇順ソート">
  <input type="button" onclick="location.href ='select_descsort_html.php'" value="評価順に降順ソート">
  <input type="button" onclick="location.href ='select_idsort_html.php'" value="id　順にソート">

</body>
</html>
