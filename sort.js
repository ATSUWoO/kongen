
  $('#sort').on('click',sort);
  function sort(){
      console.log("ここ");
      $.ajax({
        type: "POST",
        url: "select_sort.php",
        dataType: "json",
      }).done(function(data, dataType) {

        if(data == null) alert('データが0件でした');

        var target = document.getElementById("q_data");
        console.log(typeof(target));
        for (var i =0; i<data.length; i++) {
          target.innerHTML += "<tr><td>"+data[i].question+"</td><td>"+data[i].reason+"</td><td>"+data[i].value+"</td></tr>"
            }
      }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
        alert('Error : ' + errorThrown);
      });

  };
