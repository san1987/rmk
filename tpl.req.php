<script>
function show_req(_id){	$('#req_good_id').val(_id);
	$('#send_req_id').show();}
</script>



<div id='send_req_id'
	   > <!--display: none;-->


	<div id='send_req_id1'
		  > <!--display: none;-->
	 <center>
	<form class='login-form' id='send_req' action="javascript:void(null);" onsubmit="call()"    method=POST>
	<table width=100% cellspacing=0 cellpadding=0><tr><td align=right>
	<a href='#!' onclick='close_send_req_id(); return false;'>
	<img height=32 src='imgs/close.png'></a></td></tr></table>
	<div id=form_req>
		<b>Запросить цену<br></b>
		<table>
		<tr><td align=left><b>Имя*:</b> </td><td> <input   type=text name=name   size=40>  </td></tr>
		<tr><td align=left><b>Организация*:</b></td><td>  <input  type=text name=juridical_name   size=40>  </td></tr>
		<tr><td align=left><b>Телефон*:</b> </td><td> <input   type=text name=phone   size=40>  </td></tr>
		<tr><td align=left><b>Email*:</b></td><td>  <input   type=text name=email   size=40>  </td></tr>
		<tr><td align=left><b>Комментарий:</b></td><td>  <textarea   type=text name=text   cols=40> </textarea> </td></tr>
		<!--tr><td align=center colspan=2><img id=cap_img src="kcaptcha/?<?php echo session_name()?>=<?php echo session_id()?>">
		<br>

		</td></tr>
		<tr><td align=left><b>Текст с картинки*:</b></td><td>  <input  type=text name=captcha   size=10>  </td></tr-->
		</table><br>
		<input type=hidden value='0' name=good_id id=req_good_id>
		<input type=submit value='Запросить цену' >
		<br>
		<span style='display:none' id='send_req_sending'>Отправка...</span>
		<span style='color:red' id=error_area></span>
	</div>
	<div id=result_area>
	</div>
	<br><br>
	</form>
	</center>
	</div>
</div>

<script type="text/javascript" language="javascript">
	function close_send_req_id(){
		 $('#send_req_id').hide();
		 $('#send_req_sending').hide();
		 $('#form_req').show();
		 $('#result_area').hide();
		 $('#error_area').hide();
		 reload_cap_img();
	}

</script>
<script type="text/javascript" language="javascript">
	function reload_cap_img(){					d = new Date();
					$("#cap_img").attr("src", $("#cap_img").attr("src")+"&"+d.getTime());	}
 	function call() {

 	  $('#send_req_sending').show();
 	  var msg   = $('#send_req').serialize();
 	  //alert(msg);
      $.ajax({
          type: 'POST',
          url: '.?p=ajax&a=request',
          data: msg,
          success: function(data) {

            	$('#send_req_sending').hide();

            	if (data.result==1){
            		$('#result_area').html("Спасибо за Ваше обращение, в ближайшее время с Вами свяжется наш менеджер");
            		$('#result_area').show();
            		$('#form_req').hide();
            	}else{

            		$('#error_area').html(data.error);
            		$('#error_area').show();
            		reload_cap_img();

            	}
          },
          error:  function(xhr, str){
	    		//alert('Возникла ошибка: ' + xhr.responseCode);
	    		$('#form_req').hide();
	    		$('#result_area').show();
	    		$('#result_area').html("Возникла техническая ошибка в работе сайта. Позвоните нам!");
          }
        });

    }
</script>

<?

?>