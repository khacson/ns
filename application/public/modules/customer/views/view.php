<style title="" type="text/css">
	table col.c1 { width: 45px; }
	table col.c2 { width: 45px; }
	table col.c3 { width: 120px; }
	table col.c4 { width: 180px; }
	table col.c5 { width: 120px; }
	table col.c6 { width: 180px; }
	table col.c7 { width: 180px; }
	table col.c8 { width: 120px; }
	table col.c9 { width: 120px; }
	table col.c10 { width: auto;}
</style>
<link href="<?=url_tmpl();?>css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<div class="box">
	<div class="box-header with-border">
	  <?=$this->load->inc('breadcrumb');?>
	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Đóng">
		  <i class="fa fa-minus"></i></button>
	  </div>
	</div>
	<div class="box-body">
	    <div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('ma-khach-hang');?> </label>
					<div class="col-md-8">
						<input type="text" name="customer_code" placeholder="<?=getLanguage('nhap-ma-kh');?>" id="customer_code" class="searchs form-control tab-event" />
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('khach-hang');?></label>
					<div class="col-md-8">
						<input type="text" name="customer_name" placeholder="<?=getLanguage('nhap-ten-kh');?>" id="customer_name" class="searchs form-control tab-event" />
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('dien-thoai');?> </label>
					<div class="col-md-8">
						<input type="text" name="phone" placeholder="<?=getLanguage('nhap-dien-thoai');?>" id="phone" class="searchs form-control tab-event" />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">	
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('email');?></label>
					<div class="col-md-8">
						<input type="text" name="email" placeholder="<?=getLanguage('nhap-email');?>" id="email" class="searchs form-control tab-event" />
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('dia-chi');?></label>
					<div class="col-md-8">
						<input type="text" name="address" placeholder="<?=getLanguage('nhap-dia-chi');?>" id="address" class="searchs form-control tab-event" />
					</div>
				</div>
			</div>
			<div class="col-md-4" >
				<label class="control-label col-md-4" ><?=getLanguage('sinh-nhat');?></label>
				<div class="col-md-8">
					<div class="input-group date" data-provide="datepicker">
						<input id="birthday" name="birthday" type="text" class="searchs form-control tab-event" placeholder="<?=getLanguage('chon-ngay');?>">
						<div class="input-group-addon">
							<i class="fa fa-calendar "></i>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="row mtop10">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('mst');?></label>
					<div class="col-md-8">
						<input type="text" name="mst" placeholder="<?=getLanguage('nhap-mst');?>" id="mst" class="searchs form-control tab-event" />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10"></div>
	</div>
</div>
<div class="box">
	<div class="box-header with-border">
	  <div class="brc"><?=getLanguage('tim-thay');?> <span class="semi-bold viewtotal">0</span> <?=getLanguage('ket-qua');?></div>
	  <div class="box-tools pull-right">
		  <ul class="button-group pull-right btnpermission">
				<li id="search">
					<button class="button">
						<i class="fa fa-search"></i>
						<?=getLanguage('tim-kiem');?>
					</button>
				</li>
				<li id="refresh" >
					<button class="button">
						<i class="fa fa-refresh"></i>
						<?=getLanguage('lam-moi');?>
					</button>
				</li>
				<?php if(isset($permission['add'])){?>
				<li id="save" data-toggle="modal" data-target="#myModalFrom"><button class="button">
					<i class="fa fa-plus"></i>
					<?=getLanguage('them-moi');?>
					</button>
				</li>
				<?php }?>
				<?php if(isset($permission['edit'])){?>
				<li id="edit" data-toggle="modal" data-target="#myModalFrom">
					<button class="button">
						<i class="fa fa-save"></i>
						<?=getLanguage('sua');?>
					</button>
				</li>
				<?php }?>
				<?php if(isset($permission['delete'])){?>
				<li id="delete">
					<button type="button" class="button">
						<i class="fa fa-times"></i>
						<?=getLanguage('xoa');?>
					</button>
				</li>
				<?php }?>
			</ul>
	  </div>
	</div>
	<div class="box-body">
	     <div id="gridview" >
		 <!--header-->
		 <div id="cHeader">
			<div id="tHeader">    	
				<table width="100%" cellspacing="0" border="1" class="table ">
					<?php for($i=1; $i< 11; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<tr>
						<th><input type="checkbox" id="checkAll" autocomplete="off" /></th>
						<th><?=getLanguage('stt');?></th>
						<th id="ord_c.customer_code"><?=getLanguage('ma-khach-hang');?></th>
						<th id="ord_c.customer_name"><?=getLanguage('khach-hang');?></th>
						<th id="ord_c.phone"><?=getLanguage('dien-thoai');?></th>
						<th id="ord_c.email"><?=getLanguage('email');?></th>
						<th><?=getLanguage('dia-chi');?></th>
						<th id="ord_c.birthday"><?=getLanguage('sinh-nhat');?></th>
						<th id="ord_c.mst"><?=getLanguage('mst');?></th>
						<th></th>
					</tr>
				</table>
			</div>
		</div>
		<!--end header-->
		<!--body-->
		<div id="data">
			<div id="gridView">
				<table id="group"  width="100%" cellspacing="0" border="1">
					<?php for($i=1; $i< 11; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<tbody id="grid-rows"></tbody>
				</table>
			</div>
		</div>
		<!--end body-->
	 </div>
	 <div class="">
		<div class="fleft" id="paging"></div>
	 </div>
	</div>
</div>
<!-- END grid-->
<div class="loading" style="display: none;">
	<div class="blockUI blockOverlay" style="width: 100%;height: 100%;top:0px;left:0px;position: absolute;background-color: rgb(0,0,0);opacity: 0.1;z-index: 1000;">
	</div>
	<div class="blockUI blockMsg blockElement" style="width: 30%;position: absolute;top: 15%;left:35%;text-align: center;">
		<img src="<?=url_tmpl()?>img/preloader.gif" style="z-index: 2;position: absolute;"/>
	</div>
</div> 
<!-- Modal -->
<div id="myModalFrom" class="modal fade" role="dialog">
  <div class="modal-dialog w800">
    <!-- Modal content-->
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modalTitleFrom"></h4>
      </div>
      <div id="loadContentFrom" class="modal-body">
      </div>
      <div class="modal-footer">
		 <button id="actionSave" type="button" class="btn btn-info" ><i class="fa fa-save" aria-hidden="true"></i>  <?=getLanguage('luu');?></button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> <?=getLanguage('dong');?></button>
      </div>
    </div>
  </div>
</div>
<!-- ui-dialog -->
<input type="hidden" name="id" id="id" />
<script>
	var controller = '<?=base_url().$routes;?>/';
	var table;
	var cpage = 0;
	var search;
	var routes = '<?=$routes;?>';
	$(function(){	
		init();
		//refresh();
		searchList();	
		$("#search").click(function(){
			$(".loading").show();
			searchList();	
		});
		$("#refresh").click(function(){
			$(".loading").show();
			refresh();
		});
		$("#actionSave").click(function(){
			save();
		});
		$("#save").click(function(){
			//save('','save');
			$('#id').val('');
			loadForm('');
		});
		$("#edit").click(function(){
			var id = $('#id').val();
			if(id == ''){
				warning('<?=getLanguage('chon-du-lieu-can-sua');?>');
				return false;
			} 
			//save(id,'edit');
			loadForm(id);
		});
		$("#delete").click(function(){
			var id = getCheckedId();
			if(id == ''){ return false;}
			confirmDelete(id);
			return false
		});
		$( "#dialog" ).dialog({
			autoOpen: false,
			width: 400,
			height:460,
			modal:false
		});
		$(document).keypress(function(e) {
			 var id = $("#id").val();
			 if (e.which == 13) {
				  if(id == ''){
					  save('','save');
				  }
				  else{
					  save(id,'edit');
				  }
			 }
		});
	});
	function loadForm(id){
		$("#id").val(id);
		$.ajax({
			url : controller + 'form',
			type: 'POST',
			async: false,
			data:{id:id},  
			success:function(datas){
				var obj = $.evalJSON(datas); 
				$('#loadContentFrom').html(obj.content);
				$('#modalTitleFrom').html(obj.title);
				$('#id').html(obj.id);
				setNumberKeyUp('phone');
			}
		});
	}
	function save(){
		var id = $('#id').val();
		var func = 'save';
		if(id != ''){
			func = 'edit';
		}
		var search = getFormInput();
		var obj = $.evalJSON(search); 
		/*if(obj.customer_code == ""){
			warning('<?=getLanguage('ma-khach-hang-khong-duoc-trong');?>'); 
			$("#customer_code").focus();
			return false;		
		}*/
		if(obj.customer_name == ""){
			warning('<?=getLanguage('khach-hang-khong-duoc-trong');?>'); 
			$("#customer_name").focus();
			return false;		
		}
		if(obj.phone == ""){
			warning('<?=getLanguage('dien-thoai-khong-duoc-trong');?>'); 
			$("#phone").focus();
			return false;		
		}
		if(!validateEmail(obj.email) && obj.email != ""){
			warning('<?=getLanguage('email-khong-dung-dinh-dang');?>'); 
			$('#email').focus();
			return false;	
		}	
		$('.loading').show();
		var data = new FormData();
		//var objectfile2 = document.getElementById('profileAvatar').files;
		//data.append('avatarfile', objectfile2[0]);
		//data.append('csrf_stock_name', token);
		data.append('search', search);
		data.append('id',id);
		$.ajax({
			url : controller + func,
			type: 'POST',
			async: false,
			data:data,
			enctype: 'multipart/form-data',
			processData: false,  
			contentType: false,   
			success:function(datas){
				var obj = $.evalJSON(datas); 
				$("#token").val(obj.csrfHash);
				$('.loading').hide();
				if(obj.status == 0){
					if(id == ''){
						error(tmktc); return false;	
					}
					else{
						error(sktc); return false;	
					}
				}
				else if(obj.status == -1){
					error(dldtt); return false;		
				}
				else{
					if(id == ''){
						success(tmtc); 
					}
					else{
						success(stc); 
					}
					refresh();
				}
			},
			error : function(){
				$('.loading').hide();
				if(id == ''){
					error(tmktc); return false;	
				}
				else{
					error(sktc); return false;	
				}
			}
		});
	}
	function init(){
		
	}
	function funcList(obj){
		$(".edit").each(function(e){
			$(this).click(function(){ 
				var customer_name = $(".customer_name").eq(e).text().trim();
				var phone = $(".phone").eq(e).text().trim();
				var email = $(".email").eq(e).text().trim();
				var address = $(".address").eq(e).text().trim();
				var mst = $(".mst").eq(e).text().trim();
				var customer_code  = $(".customer_code").eq(e).text().trim();

				var id = $(this).attr('id');
				var birthday = $(this).attr('birthday');
				$("#id").val(id);	
				$("#customer_name").val(customer_name);	
				$("#phone").val(phone);	
				$("#email").val(email);	
				$("#address").val(address);	
				$("#birthday").val(birthday);	
				$("#mst").val(mst);	
				$("#customer_code").val(customer_code);	
			});
		});	
	}
	function refresh(){
		$(".loading").show();
		$(".searchs").val("");
		$('#activate,#processid,#groupid').multipleSelect('uncheckAll');
		csrfHash = $('#token').val();
		search = getSearch();
		getList(cpage,csrfHash);	
	}
	function searchList(){
		$(".loading").show();
		search = getSearch();
		csrfHash = $('#token').val();
		getList(cpage,csrfHash);	
	}
</script>
<script src="<?=url_tmpl();?>js/right.js" type="text/javascript"></script>