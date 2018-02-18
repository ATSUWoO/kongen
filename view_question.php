<?php
/**
 * 今週の問い一覧
 */  
require_once('redirect.php');

if(isset($_GET['order'])){
  $order_by = $_GET['order'];
} else {
  $order_by = "desc";
}

if(isset($_GET['param'])){
  $param = $_GET['param'];
} else {
  $param = "user_id";
}

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>問いの一覧</title>
    <meta charset="utf-8" />
    <script src="https://code.jquery.com/jquery-1.9.0.min.js"></script>
    <script>
      // 投稿された問いデータの取得
      $(document).ready(function() {
	  $.ajax({
	      type: "POST",
	      url: "select.php?type=all",
	      dataType: "json",
	  }).done(function(data, dataType) {
	      if(data == null){
		  alert('データが0件でした');
	      } else {
                  data.sort(function(d1, d2){
                      <?php
			/**
			* ここでデータをソート
			*/
			if($order_by == "desc"){
			   echo "return ( d1.{$param} ". "<". " d2.{$param} ? 1 : -1 );";
			} else {
			   echo "return ( d1.{$param} ". ">". " d2.{$param} ? 1 : -1 );";
			}
			?>
		  });
	      }

	      // データの表示
	      var $content = $('#content');
	      var target = document.getElementById("q_data");
	      for (var i =0; i<data.length; i++) {
					    console.log(data);
		  target.innerHTML += "<tr><td>" +
		                             data[i].q_id +
		                          "</td><td>" +
		                             data[i].question +
		                          "</td><td>" +
		                             data[i].user_id +
		                          "</td><td>" +
		                             data[i].reason +
		                      "</td></tr>";
              }
	  }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
	      alert('Error : ' + errorThrown);
	  });
      });
     </script>
  </head>
  <body>
    <h1>今週の投稿</h1>
    <ul id="content"></ul>
    
    <table border = "2" id = "q_data">
      <tr>
	<th>q_id</th><th>question</th><th>user_id</th><th>post_reason</th>
      </tr>
    </table>
    
    <input type="button" onclick="location.href ='view_question.php?param=q_id&order=asc'" value="id　順にソート">
    <input type="button" onclick="location.href ='view_question.php?param=time&order=asc'" value="古い　順にソート">
    <input type="button" onclick="location.href ='view_question.php?param=time&order=desc'" value="更新　順にソート">

    <br /><br />
    <a href="index.php">ホーム画面へ</a>
  </body>
</html>
