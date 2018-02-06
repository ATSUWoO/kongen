<?php
require_once('session.php');
?>

  <!DOCTYPE html>
  <html lang="ja">
  <head>
    <br>
        <a href="home_html.php">ホーム画面へ</a><br>
    <meta charset="utf-8" />
    <title></title>
    <script src="https://code.jquery.com/jquery-1.9.0.min.js"></script>
  </head>
  <body>

    <h1></h1>
    <table border = "2" id = "q_data">
      <tr>
        <th>id</th><th>question</th><th>reason</th><th>1　2　3　4　5</th><th>post_reason</th>
      </tr>
    </table>
    <button type="button" id = "send" name="button">送信</button>

    <script type="text/javascript">
    var q_list = [];
    var get_detail = [];
    var date = new Date() ;
    var a = date.getTime() ;
    var b = Math.floor( a / 1000 ) ;

    $.ajax({
        type: "POST",
        url: "get_detail.php",
        dataType: "json",
        async:false,

      }).done(function(data, dataType)
      {
        if(data == null) alert('データが0件でした');
        var target = document.getElementById("q_data");
        j = 0;
        for (var i =0; i<data.length; i++)
        {
          //直近の１週間に投稿されたものを表示
          if (data[i].time > b - (7 * 24 * 60 * 60) && data[i].time <= b)
          {
            get_detail[j] = data[i];
            j++;
          }
        }
      }).fail(function(XMLHttpRequest, textStatus, errorThrown)
      {
      alert('Error : ' + errorThrown);
      });

    $.ajax({
        type: "POST",
        url: "value.php",
        dataType: "json",
        async:false,
      }).done(function(data, dataType)
      {
        if(data == null) alert('データが0件でした');
        var target = document.getElementById("q_data");

  　　　//reasonをq_listに入れる作業
        for (var i = 0; i < get_detail.length; i++)
        {
          for (var j = 0; j < data.length; j++)
          {
            if (get_detail[i].q_id == data[j].q_id)
            {
              data[j].detail = get_detail[i].reason;
            }
          }
        }
        for (var i =0; i<data.length; i++)
        {
          console.log(data[i]);
          //直近の１週間に投稿されたものを表示
          if (data[i].time > b - (7 * 24 * 60 * 60) && data[i].time <= b)
          {
              target.innerHTML += "<tr><td >"+data[i].q_id+"</td><td>"+data[i].question+"</td><td>"+data[i].detail+"</td><td><input type = 'range' id='eval"+data[i].q_id+ "' min='1' max='5'></input></td><td><textarea id='reason"+data[i].q_id+ "' rows='10' cols='100'　id = 't1'　>⇦の評価にした理由を投稿してください</textarea></td></tr>";
              q_list[i] = data[i];
          }
        }
      }).fail(function(XMLHttpRequest, textStatus, errorThrown)
      {
      alert('Error : ' + errorThrown);
      });

      $('#send').on('click',function()
      {
        for (var i in q_list) {
        eval = document.getElementById("eval"+q_list[i].q_id).value;
        reason = document.getElementById("reason"+q_list[i].q_id).value;
        q_list[i].eval = eval;
        q_list[i].reason = reason;
      }
        send_data = JSON.stringify(q_list);

      $.ajax({
          type: "POST",
          url: "input_post_value.php",
          contentType: "Content-Type: application/json; charset=UTF-8",
          data:send_data,
      }).done(function(data, dataType)
       {
         console.log(data);
       }).fail(function(XMLHttpRequest, textStatus, errorThrown)
       {
        alert('Error : ' + errorThrown);
       });

      });

      $('#send').on('click', notification);
      function notification()
    　{
        Notification.requestPermission();
        var options = {
            body : "Mr KONGEN",
            icon : './kongen2.png'
    　}
      var n = new Notification("自己評価を登録しました",options);
      setTimeout(n.close.bind(n), 5000);
      }

    </script>
  </body>
  </html>
