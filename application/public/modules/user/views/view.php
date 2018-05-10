<style title="" type="text/css">
	table col.c1 { width: 45px; }
	table col.c2 { width: 45px; }
	table col.c3 { width: 110px; }
	table col.c4 { width: 120px; }
	table col.c5 { width: 150px; }
	table col.c6 { width: 100px; }
	table col.c7 { width: 120px; }
	table col.c8 { width: 130px; }
	table col.c9 { width: 130px; }
	table col.c10 { width: 130px; }
	table col.c11 { width: 100px; }
	table col.c12 { width: 100px; }
	table col.c13 { width: 100px; }
	table col.c14 {width: auto;}
</style>
<link href="<?=url_tmpl();?>css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<div class="box">
	<div class="box-header with-border">
	  <?=$this->load->inc('breadcrumb');?>
	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Đóng">
		  <i class="fa fa-minus"></i></button>
		<!--<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
		  <i class="fa fa-times"></i></button>-->
	  </div>
	</div>
	<div class="box-body">
	    <div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('tai-khoan');?> </label>
					<div class="col-md-8">
						<input type="text" name="username" placeholder="<?=getLanguage('nhap-tai-khoan');?>" id="username" class="searchs form-control tab-event" />
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('ho-ten');?></label>
					<div class="col-md-8">
						<input type="text" name="fullname" placeholder="<?=getLanguage('nhap-ho-ten');?>" id="fullname" class="searchs form-control tab-event" />
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('dien-thoai');?></label>
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
					<label class="control-label col-md-4"><?=getLanguage('nhom-quyen');?></label>
					<div class="col-md-8" >
						<select name="groupid" id="groupid" class="combos tab-event" >
							<option value=""></option>
							<?php foreach ($groups as $item) { ?>
								<option value="<?=$item->id;?>"><?=$item->groupname?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('chi-nhanh');?></label>
					<div class="col-md-8" >
						<select name="branchid" id="branchid" class="combos tab-event" >
							<?php foreach ($branchs as $item) { ?>
								<option value="<?=$item->id;?>"><?=$item->branch_name?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>	
		</div>
		<div class="row mtop10">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('phong-ban')?></label>
					<div class="col-md-8">
						<select class="combos" id="departmentid" name="departmentid">
							<?php foreach($departments as $item){?>
							<option value="<?=$item->id;?>"><?=$item->departmanet_name;?></option>
							<?php }?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('trang-thai');?></label>
					<div class="col-md-8" >
						<select name="activate" id="activate" class="combos tab-event">
							<option value=""></option>
							<option value="1"><?=getLanguage('kich-hoat');?></option>
							<option value="0"><?=getLanguage('vo-hieu');?></option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10"></div>
	</div>
</div>
<div class="box">
	<div class="box-header with-border">
	  <div class="brc"><?=getLanguage('tim-thay');?> <span class="semi-bold viewtotal">0</span> <?=getLanguage('nhan-vien');?></div>
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
				<li id="save" data-toggle="modal" data-target="#myModalFrom"> 
					<button class="button">
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
					<?php for($i=1; $i< 15; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<tr>
						<th><input type="checkbox" id="checkAll" autocomplete="off" /></th>
						<th><?=getLanguage('stt');?></th>
						<th><?=getLanguage('tai-khoan');?></th>
						<th><?=getLanguage('ho-ten');?></th>
						<th><?=getLanguage('email');?></th>
						<th><?=getLanguage('dien-thoai');?></th>
						<th><?=getLanguage('nhom-quyen');?></th>
						<th><?=getLanguage('chi-nhanh');?></th>
						<th><?=getLanguage('phong-ban');?></th>
						<th><?=getLanguage('trang-thai');?></th>
						<th><?=getLanguage('hinh');?></th>
						<th><?=getLanguage('chu-ky');?></th>
						<th></th>
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
					<?php for($i=1; $i< 15; $i++){?>
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
<!-- ui-dialog -->
<!--S Modal -->
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
        <button id="close" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> <?=getLanguage('dong');?></button>
      </div>
    </div>
  </div>
</div>
<!--E Modal -->
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
		$("#close").click(function(){
			$(".loading").show();
			refresh();
		});
		$('#save').click(function(){
			$('#id').val('');
			tabPosition = 1;
			//tabControl();
			$('#input_username').focus();
			loadForm();
		});
		$('#edit').click(function(){
			var id = $('#id').val();
			if(id == ''){
				warning('<?=getLanguage('chon-nhom-quyen');?>');
				return false;
			} 
			loadForm();
			tabPosition = 1;
			$('#input_username').focus();
			//tabControl();
		});
		$('#delete').click(function(){
			var id = getCheckedId();
			if(id == ''){ return false;}
			confirmDelete(id);
			return false
		});
		$('#actionSave').click(function(){
			save();
		});
	});
	function loadForm(){
		var id = $('#id').val(); 
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
			}
		});
	}
	function save(){
		var id = $('#id').val(); 
		var func = 'save';
		if(id != ''){
			func = 'edit';
		}
		else{
			var password = $('#input_password').val();
			var cfpassword = $('#input_cfpassword').val();
			if(password != '' && password != cfpassword){
				warning('<?=getLanguage('xac-nhan-mat-khau-khong-dung');?>');
				return false;
			}
		}
		
		var search = getFormInput(); 
		var obj = $.evalJSON(search); 
		if(obj.username == ''){
			warning('<?=getLanguage('tai-khoan-khong-duong-trong');?>'); 
			$("#username").focus();
			return false;		
		}
		if(id == ''){
			if(obj.password == ''){
				warning('<?=getLanguage('mat-khau-khong-duoc-trong');?>');
				return false;
			}	
			if(obj.password != obj.cfpassword){
				warning('<?=getLanguage('xac-nhan-mat-khau-khong-dung');?>');
				return false;
			}	
		}
		else{
			if(obj.password != '' && (obj.password != obj.cfpassword)){
				warning('<?=getLanguage('xac-nhan-mat-khau-khong-dung');?>');
				return false;
			}	
		}
		if(obj.fullname==""){
			warning('<?=getLanguage('ho-ten-khong-duoc-trong');?>');
			return false;
		}	
		if(!validateEmail(obj.email) && obj.email != ""){
			warning('<?=getLanguage('email-khong-dung-dinh-dang');?>'); 
			$('#email').focus();
			return false;	
		}			
		if(obj.groupid == ''){
			warning('<?=getLanguage('nhom-quyen-khong-duong-trong');?>'); 
			$('#username').focus();
			return false;		
		}
		$('.loading').show();
		var data = new FormData();
		var objectfile = document.getElementById('profileAvatar').files;
		data.append('avatarfile', objectfile[0]);
		var signatures = document.getElementById('signatures').files;
		data.append('signatures', signatures[0]);
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
					searchList();
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
		$('#departmentid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-phong-ban')?>',
			single: false
		});
		$('#branchid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-chi-nhanh');?>',
			single: false
		});
		$('#groupid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-nhom-quyen');?>',
			single: false
		});
		$('#activate').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-trang-thai');?>',
			single: true
		});
		var branchid = '<?=$branchid;?>';
		$('#branchid').multipleSelect('setSelects', branchid.split(','));
	}
	function funcList(obj){
		$('.edit').each(function(e){
			$(this).click(function(){ 
				var groupid = $(this).attr('groupid');
				var activate = $(this).attr('activate'); 	
				
				var fullname = $('.fullname').eq(e).text().trim();
				var email = $('.email').eq(e).text().trim();
				var phone = $(this).attr('phone'); 	
				var username = $(this).attr('username'); 
				var branchid = $(this).attr('branchid');
				var supplierid = $(this).attr('supplierid');
				
				var id = $(this).attr('id');
				$('#id').val(id);	
				$('#fullname').val(fullname);	
				$('#email').val(email);
				$('#phone').val(phone);
				$('#username').val(username);
				$('#activate').multipleSelect('setSelects', [activate]);
				$('#groupid').multipleSelect('setSelects', [groupid]);
				$('#branchid').multipleSelect('setSelects', [branchid]);
				$('#supplierid').multipleSelect('setSelects', [supplierid]);
			});
		});	
		$('.edititem').each(function(e){
			$(this).click(function(){ 
				loadForm();
			});
		});
	}
	function refresh(){
		var branchid = '<?=$branchid;?>'; // alert(branchid);
		$(".loading").show();
		$(".searchs").val("");
		$('#username').prop('disabled', false);
		$('#activate,#departmentid,#groupid,#branchid').multipleSelect('uncheckAll');
		$('#branchid').multipleSelect('setSelects', branchid.split(','));
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
