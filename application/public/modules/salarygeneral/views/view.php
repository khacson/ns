<style title="" type="text/css">
	table col.c1 { width: 45px; }
	table col.c2 { width: 45px; }
	table col.c3 { width: 150px; }
	table col.c4 { width: 100px; }
	table col.c5 { width: 150px; }
	table col.c6 { width: 110px; }
	table col.c7 { width: 110px; }
	table col.ccallowances { width: 130px; }
	table col.caction { width: 100px; }
	table col.cauto { width: auto;}
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
					<label class="control-label col-md-4" style="white-space:nowrap"><?=getLanguage('ma-nhan-vien');?></label>
					<div class="col-md-8">
						<input type="text" name="code" id="code" placeholder="<?=getLanguage('nhap-ma-nhan-vien')?>" class="searchs form-control" required />
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4" style="white-space:nowrap"><?=getLanguage('ho-ten')?></label>
					<div class="col-md-8">
						<input type="text" name="fullname" id="fullname" placeholder="<?=getLanguage('nhap-ho-ten')?>" class="searchs form-control" required />
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4" style="white-space:nowrap"><?=getLanguage('cmnd')?></label>
					<div class="col-md-8">
						<input type="text" name="identity" id="identity" placeholder="<?=getLanguage('nhap-cmnd')?>" class="searchs form-control" required />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('bo-phan')?></label>
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
					<label class="control-label col-md-4"><?=getLanguage('ky-luong')?></label>
					<div class="col-md-8">
						<select id="endoffmonthid" name="endoffmonthid" class="combos" >
							<option value=""></option>
							<?php $i=1; foreach($endoffmonths as $item){?>
							<option <?php if($i==1){?> selected <?php }?> value="<?=$item->id;?>"><?=$item->monthyear;?></option>
							<?php $i++;}?>
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
				
				<li id="save" >
					<button class="button" >
					<i class="fa fa-usd"></i>
					<?=getLanguage('chot-luong');?>
					</button>
				</li>
				<li id="export">
					<button class="button">
						<i class="fa fa-file-excel-o"></i>
						<?=getLanguage('export')?>
					</button>
				</li>
				
			</ul>	
	  </div>
	</div>
	<div class="box-body">
	     <div id="gridview" >
		 <!--header-->
		 <div id="cHeader">
			<div id="tHeader">    	
				<table width="100%" cellspacing="0" border="1" class="table ">
					<?php 
					for($i=1; $i< 8; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<?php foreach($allowances as $item){?>
						<col class="ccallowances">
					<?php }?>
					<?php foreach($insurances as $item){?>
						<col class="ccallowances">
					<?php }?>
					<col class="caction">
					<col class="caction">
					<col class="cauto">
					<tr>
						<th><input type="checkbox" id="checkAll" autocomplete="off" /></th>
						<th><?=getLanguage('stt');?></th>
						<th id="ord_d.departmanet_name"><?=getLanguage('phong-ban');?></th>
						<th id="ord_e.code"><?=getLanguage('ma-nhan-vien');?></th>
						<th id="ord_e.fullname"><?=getLanguage('ho-ten');?></th>
						<th id=""><?=getLanguage('tong-cong');?></th>
						<th id="ord_r.othercollect_money"><?=getLanguage('luong-co-ban');?></th>
						<?php foreach($allowances as $item){?>
						<th id=""><?=$item->allowance_name;?></th>
						<?php }?>
						<?php foreach($insurances as $item){?>
						<th id=""><?=$item->insurance_name;?></th>
						<?php }?>
						<th><?=getLanguage('loai-luong');?></th>
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
					<?php 
					for($i=1; $i< 8; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<?php foreach($allowances as $item){?>
						<col class="ccallowances">
					<?php }?>
					<?php foreach($insurances as $item){?>
						<col class="ccallowances">
					<?php }?>
					<col class="caction">
					<col class="caction">
					<col class="cauto">
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
		$("#export").click(function(){
			search = getSearch(); 
			window.location = controller+'export?search='+search;
		});
		$('#save').click(function(){
			$('#id').val('');
			loadForm();
		});
		$('#edit').click(function(){
			var id = $('#id').val();
			if(id == ''){
				warning(cldcs);
				return false;
			} 
			loadForm(id);
		});
		$("#delete").click(function(){
			var id = getCheckedId();
			if(id == ''){ return false;}
			confirmDelete(id);
			return false
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
		$('#actionSave').click(function(){
			save();
		});
	});
	function loadForm(id){
		$.ajax({
			url : controller + 'form',
			type: 'POST',
			async: false,
			data:{id:id},  
			success:function(datas){
				var obj = $.evalJSON(datas); 
				$('#loadContentFrom').html(obj.content);
				$('#modalTitleFrom').html(obj.title);
				$('#input_reward_content').select();
				$('#id').html(obj.id);
			}
		});
	}
	function save(id,func){
		var id = $('#id').val(); 
		var func = 'save';
		if(id != ''){
			func = 'edit';
		}
		
		var search = getFormInput(); 
		var obj = $.evalJSON(search); 
		if(obj.employeeid == ""){
			warning('<?=getLanguage('nhan-vien-khong-duoc-trong');?>'); 
			return false;		
		}
		if(obj.salary == ""){
			warning('<?=getLanguage('luong-co-ban-khong-duoc-trong');?>'); 
			return false;		
		}
		var allowance = getAllowance();
		$('.loading').show();
		var data = new FormData();
		//var objectfile2 = document.getElementById('profileAvatar').files;
		//data.append('avatarfile', objectfile2[0]);
		//data.append('csrf_stock_name', token);
		data.append('search', search);
		data.append('allowance', allowance);
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
		$('#departmentid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-bo-phan')?>',
			single: false
		});
		$('#endoffmonthid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-ky-luong')?>',
			single: true
		});
		
	}
	function funcList(obj){
		$(".edit").each(function(e){
			$(this).click(function(){ 
				var reward_content = $(".reward_content").eq(e).text().trim();
				var othercollect_date  = $(".othercollect_date").eq(e).text().trim();
				var id = $(this).attr('id');
				var departmentid = $(this).attr('departmentid');
				$("#id").val(id);	
				$("#reward_content").val(reward_content);
				$("#othercollect_date").val(othercollect_date);
				$('#departmentid').multipleSelect('setSelects', departmentid.split(','));				
			});
		});	
		$('.edititem').each(function(e){
			$(this).click(function(){
				var id = $(this).attr('id');
				loadForm(id);
			});
		});
		$('.deleteitem').each(function(e){
			$(this).click(function(){
				var id = $(this).attr('id');
				confirmDelete(id);
				return false
			});
		});
	}
	function refresh(){
		$(".loading").show();
		$(".searchs").val("");
		$('#departmentid').multipleSelect('uncheckAll');
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