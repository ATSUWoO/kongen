<?php
require_once('session.php');

 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <title></title>
<form  action="input_value_html.php" method="post">
  <script src="https://code.jquery.com/jquery-1.9.0.min.js"></script>
  <script>

  $(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "value.php",
        dataType: "json",
    }).done(function(data, dataType) {
        //受け取れた時の処理
        if(data == null) alert('データが0件でした');
        var target = document.getElementById("q_data");
        console.log(data);

        for (var i =0; i<data.length; i++) {
          target.innerHTML += "<tr><td>"+data[i].q_id+"</td><td>"+data[i].question+"</td><td>"+data[i].reason+"</td><td>"+data[i].value+"</td><td><input type = 'range' name='eval"+data[i].q_id+ " ' min='1' max='5'></input></tr>"
          }
          
        for (var i = 0; i < data.length; i++) {
            $_SESSION['"id"+$i+'] = data[i].q_id;
          }

      //エラー処理
    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
      alert('Error : ' + errorThrown);
      console.log(data);
    });
  });
  </script>

</head>
<body>
  <h1></h1>
  <table border = "2" id = "q_data">
    <tr>
      <th>id</th><th>question</th><th>reason</th><th>value</th><th>1　2　3　4　5</th>
    </tr>
  </table>
  <input type="submit" name="button" value="送信"></input>
</body>
</form>
</html>
