<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <title>jQuery & Ajax通信を使ってPHPからJSON形式のデータを取得して表示するサンプル</title>

  <script src="https://code.jquery.com/jquery-1.9.0.min.js"></script>
  <script>
  $(document).ready(function() {
    /**
     * Ajax通信メソッド
     * @param type  : HTTP通信の種類
     * @param url   : リクエスト送信先のURL
     * @param data  : サーバに送信する値
     */
    $.ajax({
      type: "POST",
      url: "json.php",
      dataType: "json",
    }).done(function(data, dataType) {
      // successのブロック内は、Ajax通信が成功した場合に呼び出される

      // 結果が0件の場合
      if(data == null) alert('データが0件でした');

      // 返ってきたデータの表示
      var $content = $('#content');
      for (var i =0; i<data.length; i++) {
        $content.append("<li>" + data[i].name + "</li>");
      }
    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
      // 通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述します。

      // this;
      // thisは他のコールバック関数同様にAJAX通信時のオプションを示します。

      // エラーメッセージの表示
      alert('Error : ' + errorThrown);
    });
  });
  </script>
</head>
<body>
  <h1>jQuery & Ajax通信を使ってPHPからJSON形式のデータを取得して表示するサンプル</h1>
  <ul id="content"></ul>
</body>
</html>
