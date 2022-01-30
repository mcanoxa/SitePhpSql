jQuery(document).ready(function($){
  loadcard();
  $("#button-auth").click (function (e) {

    e.preventDefault();
    var auth_login = $("#auth_login").val();
    var auth_pass = $("#auth_pass").val();

    if (auth_login == "" || auth_login.length > 30) {
      send_login = 'no';
    }else {
      send_login = 'yes';
    }

    if (auth_pass == "" || auth_pass.length > 15) {
      send_pass = 'no';
    }
    else {
      send_pass = 'yes';
    }

    if ($("#rememberme").prop('checked')) {
      auth_rememberme = 'yes';
    }
    else {
      auth_rememberme = 'no';
    }

    if (send_login == 'yes' && send_pass == 'yes' ) {
      $("#button-auth").hide();

      $.ajax({
        type: "POST",
        url:"../include/auth.php",
        data:"login="+auth_login+"&pass="+auth_pass+"&rememberme="+auth_rememberme,
        dataType:"html",
        cashe:false,
        success:function (data) {
          if (data === 'yes_auth') {
            location.reload();
          }else {
            $("#message-auth").slideDown(400);
            $("#button-auth").show();
          }
        }
      });
    }
  });



  $("#auth-user-info").toggle(
    function () {
      $("#block-user").fadeIn(100);
    },
    function () {
      $("#block-user").fadeOut(100);
    }
  );



  $("#logout").click(function () {
    $.ajax({
      type:"POST",
      url:"../include/logout.php",
      dataType:"html",
      cashe:false,
      success:function(data) {
        if (data == 'logout') {
          location.reload();
        }
      }
    });
  });


   function isValidEmailAddress(emailAddress) {
   var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
   return pattern.test(emailAddress);
   }

 $('#confirm-button-next').click(function(e){

  var order_fio = $("#order_fio").val();
  var order_email = $("#order_email").val();
  var order_phone = $("#order_phone").val();
  var order_address = $("#order_address").val();

if (!$(".order_delivery").is(":checked"))
{
   $(".label_delivery").css("color","#E07B7B");
   send_order_delivery = '0';

}else { $(".label_delivery").css("color","black"); send_order_delivery = '1';



if (order_fio == "" || order_fio.length > 50 )
{
   $("#order_fio").css("borderColor","#FDB6B6");
  send_order_fio = '0';

}else { $("#order_fio").css("borderColor","#DBDBDB");  send_order_fio = '1';}



if (isValidEmailAddress(order_email) == false)
{
   $("#order_email").css("borderColor","#FDB6B6");
 send_order_email = '0';
}else { $("#order_email").css("borderColor","#DBDBDB"); send_order_email = '1';}



 if (order_phone == "" || order_phone.length > 50)
{
   $("#order_phone").css("borderColor","#FDB6B6");
   send_order_phone = '0';
}else { $("#order_phone").css("borderColor","#DBDBDB"); send_order_phone = '1';}



 if (order_address == "" || order_address.length > 150)
{
   $("#order_address").css("borderColor","#FDB6B6");
   send_order_address = '0';
}else { $("#order_address").css("borderColor","#DBDBDB"); send_order_address = '1';}

}

if (send_order_delivery == "1" && send_order_fio == "1" && send_order_email == "1" && send_order_phone == "1" && send_order_address == "1")
{

  return true;
}
e.preventDefault();

});

$('.add-cart-style-grid, .add-card').click(function (e) {
  e.preventDefault();
  var tid = $(this).attr("tid");

  $.ajax({
    type: "POST",
    url: "../include/addtocard.php",
    data:"id="+tid,
    dataType:"html",
    cashe:false,
    success:function(data) {
      loadcard();
    }
  });
});

function loadcard() {
  $.ajax({
    type: "POST",
    url: "../include/loadcard.php",
    dataType:"html",
    cashe:false,
    success:function (data) {
        if (data === '0') {
          $("#block-basket > a").html("Корзина пуста");
        }
        else {
          $("#block-basket > a").html(data);

        }
    }
  });
}




$(".count-minus").click(function (e) {
  e.preventDefault();
  var score = $(this).attr("score");

  $.ajax({
    type: "POST",
    url: "../include/count-minus.php",
    data:"id="+score,
    dataType:"html",
    cashe:false,
    success:function (data) {
      $("#input-id"+score).val(data);
      loadcard();

      var priceproduct = $("#tovar"+score+" > p").attr("price");

      result_total = Number(priceproduct) * Number(data);

      $("#tovar"+score+" > p").html(result_total);
      $("#tovar"+score+" > h5 > .span-count").html(data);

      itog_price();
    }
  });
});

$('.count-plus').click(function (e) {
  e.preventDefault();
  var score = $(this).attr("score");

  $.ajax({
    type:"POST",
    url:"../include/count-plus.php",
    data:"id="+score,
    dataType:"html",
    cashe:false,
    success:function (data) {
      $("#input-id"+score).val(data);
      loadcard();
      var priceproduct = $("#tovar"+score+" > p").attr("price");

      result_total = Number(priceproduct) * Number(data);

      $("#tovar"+score+" > p").html(result_total);
      $("#tovar"+score+" > h5 > .span-count").html(data);

      itog_price();
    }
  });
});


$('.count-input').keypress(function (e) {
  if (e.KeyCode==13) {
    var score = $(this).attr("score");
    var incount = $("#input-id"+score).val();

    $.ajax({
      type:"POST",
      url:"../include/count-input.php",
      data:"id="+score+"&count="+incount,
      dataType:"html",
      cashe:false,
      success:function (data) {
        $("#input-id"+score).val(data);
        loadcard();
        var priceproduct = $("#tovar"+score+" > p").attr("price");

        result_total = Number(priceproduct) * Number(data);

        $("#tovar"+score+" > p").html(result_total);
        $("#tovar"+score+" > h5 > .span-count").html(data);

        itog_price();
      }
    });
  }

})



function itog_price() {
  $.ajax({
    type:"POST",
    url:"../include/itog_price.php",
    dataType:"html",
    cashe:false,
    success:function (data) {
      $(".itog-price > strong").html(data);
    }
  });
}
});
