<!-- Pen Title-->
<img class="imglogin" src="<?=url_tmpl();?>img/macbook.jpg" />
<div class="formshopfloor">
	<div class="pen-title" style="margin-top:10px;">
	  <a href="<?=base_url();?>"><img src="<?=url_tmpl();?>img/logo.png" /></a>
	 <h1 ><!--Phần mềm nhân sự - tiền lương--></h1>
	</div>
	<!-- Form Module-->
	<div class="module form-module " >
	  <div class="toggle"></div>
	  <div class="form">
		<h2>Đăng nhập<h2>
		<form>
		  <table style="width:100%;">
			  <tr>
				  <td colspan="3">
						<input class="input" id="email" name="email" type="text" placeholder="Nhập tài khoản"/>
				  </td>
			  </tr>
			  <tr>
				  <td colspan="3">
						<input class="input" id="password" name="password" type="password" placeholder="Nhập mật khẩu"/>
				  </td>
			  </tr>
			  <tr>
				  <td width="50%">
					  <input  class="input" type="text" autocomplete="off" placeholder="Mã xác nhận" id="verification" name="verification" />	
				  </td>
				  <td style="padding-left:10px;">
						<img style="margin-top:-19px;"  title="Tạo mã khác"  src="<?=base_url()?>authorize/captcha/543534.html" id="icaptcha">
				  </td>
				  <td>
					 <img id="reload" title="Create another code" style="cursor:pointer; margin-left:5px; margin-top:-15px;" align="absmiddle" src="<?=url_tmpl();?>images/reload.png" />
				  </td>
			  </tr>
			  <tr>
				  <td colspan="3">
						<button type="button" id="logins">Đăng nhập</button>
				  <td>
			  </tr>
		  </table>
		</form>
		
	  </div>
	  <div class="cta"></div>
	</div>
</div>
<div class="loading" style="display: none;">
	<div class="blockUI blockOverlay" style="width: 100%;height: 100%;top:0px;left:0px;position: absolute;background-color: rgb(0,0,0);opacity: 0.1;z-index: 1000;">
	</div>
	<div class="blockUI blockMsg blockElement" style="width: 30%;position: absolute;top: 15%;left:35%;text-align: center;">
		<!--<img src="<?=url_tmpl()?>img/loading2.gif" style="z-index: 2;position: absolute;"/>-->
	</div>
</div> 
<link href="<?=url_tmpl();?>toast/toastr.css" rel="stylesheet" type="text/css"/>	
<link href="<?=url_tmpl();?>multipleselect/multiple-select.css" rel="stylesheet" type="text/css"/>
<script src="<?=url_tmpl();?>toast/toastr.js"></script>	
<script src="<?=url_tmpl();?>toast/notifications.js" type="text/javascript"></script>

<script src="<?=url_tmpl();?>multipleselect/jquery.multiple.select.js" type="text/javascript"></script>

<script src="<?=url_tmpl();?>js/jquery.json.js" type="text/javascript"></script>
<div id="fb-root"></div>
<style>
	.fwb{
		font-weight:300 !important;
		font-size:13px;
	}
</style>
<script>
	$(function(){
		$("#reload").click(function(){
			var id = randomNumberFromRange(100,1000);
			$("#icaptcha").attr("src","<?=base_url()?>authorize/captcha/"+id+".html");
		});
		$("#login").click(function(){
			login();
		});	
	});
	function randomNumberFromRange(min,max){
		return Math.floor(Math.random()*(max-min+1)+min);
	}
	$(window).keyup(function(e){ 
		var code = e.which; 
		if(code == 13){
			login();
		} 
	});
	$(function(){
		$('#logins').click(function(){
			login();
		});
	});
	function login(){
		var email = $('#email').val();
		var password = $('#password').val();
		var verification = $("#verification").val();
		if(email == ''){
			warning('Tài khoản không được trống');
			$('#email').focus();
			return false;
		}
		if(password == ''){
			warning('Mật khẩu không được trống');
			$('#password').focus();
			return false;
		}
		if(verification == ''){
			warning("Mã xác nhận không được trống."); 
			$('#verification').focus();
			return false;	
		}
		$('.loading').show();
		$.ajax({
			  url:'<?=base_url()?>'+'authorize/login',
			  async: false,
			  type: 'POST',
			  data:{email:email, password:password,captcha:verification},
			  success:function(datas){
				 var obj = $.evalJSON(datas); 
				 $('.loading').hide();
				 if(obj.status == 1){
					success('Đăng nhập thành công');
					window.location = '<?=base_url();?>authorize';
				 }
				 else if(obj.status == 0){
					warning("Mã xác nhận không đúng."); 
					$('#verification').focus();
				 }
				 else{
					 error('Đăng nhập không thành công');
					 return false;
				 }
			},
			error: function(){
				
			}
		});
	}
</script>