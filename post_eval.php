<?php
require_once('redirect.php');
require_once('./Database/DataSelector.php');

/**
 * 議論後に問いを評価するためのHTMLページ
 */

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <title>議論後に問いを評価</title>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  </head>
  <body>
    <h1>議論後に問いを評価</h1>
    <table border="2" id="q_data">
      <tr>
	<th>number</th><th>question</th><th>reason</th><th>1 2 3 4 5</th><th>post_reason</th>
      </tr>
    </table>
    <button type="button" id="send" name="button">送信</button>

    <br /><br />
    <div id="error_message"></div>
    <a href="index.php">ホーム画面へ</a><br>
    
    <script type="text/javascript">
      var q_list = new Array();
      $(document).ready(function() {
	  $.ajax({
	      type: "POST",
	      url: "select.php?type=post_eval",
	      dataType: "json",
	  }).done(function(data, dataType) {
	      if(data == null){
		  alert('データが0件でした');
	      }
	      // 返ってきたデータの表示
	      var $content = $('#content');
	      var target = document.getElementById("q_data");
	      for (var i =0; i<data.length; i++) {
		  if(data[i].post_eval_reason == null){
		      data[i].post_eval_reason = "";
		  }
		  let eval_data = "なぜこの評価にしたのか";
		  if(data[i].post_eval_value == null){
		      data[i].post_eval_value = 3;
		  }
		  target.innerHTML += "<tr><td>" +
		                             (i+1) +
		                          "</td><td width='300'>" +
		                              data[i].question +
		                          "</td><td width='500'>" +
		                              data[i].self_eval_reason +
		                          "</td><td>" +
		                              "<input type='range' id='eval"+data[i].q_id+ "' min='1' max='5' value='"+ data[i].post_eval_value +"' />" +
		                          "</td><td>" +
		    "<textarea id='reason"+data[i].q_id+"' rows='10' cols='50' required='required' placeholder='"+ eval_data +"'>"+ data[i].post_eval_reason +"</textarea>" +
		                      "</td></tr>";
		  q_list.push(data[i]);
              }
	  }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
	      alert('Error : ' + errorThrown);
	      console.log(data);
	  });
      });
		    
      $('#send').on('click',function(){
	  for (var i in q_list) {
	      eval = document.getElementById("eval"+q_list[i].q_id).value;
	      reason = document.getElementById("reason"+q_list[i].q_id).value;
	      q_list[i].eval = eval;
	      q_list[i].reason = reason;
	  }
	  var send_data = JSON.stringify(q_list);
	  console.log(send_data);
	  $.ajax({
              type: "POST",
              url: "save_post_eval.php",
              contentType: "Content-Type: application/json; charset=UTF-8",
	      data: send_data,
	  }).done(function(data){
	      console.log("success:"+data);
	      $("div#error_message").innerHTML = "<span style='color:red;'>データを送信しました</span>";
	  }).fail(function(XMLHttpRequest, textStatus, errorThrown){
	      console.log("error");
	      alert('Error : ' + errorThrown);
	  }); 
       });
    </script>
  </body>
</html>
