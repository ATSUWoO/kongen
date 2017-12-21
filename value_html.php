<?php
require_once('session.php');

 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <title></title>
<!-- <form  action="input_value_html.php" method="post"> -->
  <script src="https://code.jquery.com/jquery-1.9.0.min.js"></script>

</head>
<body>
  <h1></h1>
  <table border = "2" id = "q_data">
    <tr>
      <th>id</th><th>question</th><th>1　2　3　4　5</th><th>reason</th>
    </tr>
  </table>
  <button  id = "submit" name="button" value="送信">中身</button>

<script type="text/javascript">
  var q_list = [];
  $.ajax({
      type: "POST",
      url: "value.php",
      dataType: "json",
  }).done(function(data, dataType) {
      //受け取れた時の処理
      if(data == null) alert('データが0件でした');
      var target = document.getElementById("q_data");

      for (var i =0; i<data.length; i++) {
        target.innerHTML += "<tr><td>"+data[i].q_id+"</td><td>"+data[i].question+"</td><td><input type = 'range' name='eval"+data[i].q_id+ " ' min='1' max='5'></input></td><td><textarea name='reason' rows='10' cols='100'　id = 't1'　>⇦の評価にした理由を投稿してください</textarea></td></tr>";
        q_list[i] =data[i].q_id;
        }
        $('#submit').on('click',save_qlist(q_list));
    //エラー処理
  }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
    alert('Error : ' + errorThrown);
  });

  function save_qlist(q_list){
    console.log(q_list);
    $.ajax({
      type:"POST",
      url:"input_value_html.php",
      data:q_list,
    }).done(function(data,dataType){
    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
      alert('Error : ' + errorThrown);
    });
  };

  </script>
</body>

<script src="https://code.jquery.com/jquery-1.9.0.min.js"></script>
<script type="text/javascript">

</script>
</form>
</html>
