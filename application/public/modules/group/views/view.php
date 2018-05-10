<style title="" type="text/css">
	table col.c1 { width: 45px; }
	table col.c2 { width: 60px; }
	table col.c3 { width: 250px; }
	table col.c4 { width: 180px; }
	table col.c5 { width: 180px; }
	table col.c6 { width: 100px; }
	table col.c7 { width: auto;}
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
						<label class="control-label col-md-4"><?=getLanguage('nhom-quyen');?></label>
						<div class="col-md-8">
							<input type="text" name="groupname" placeholder="Nhóm quyền" id="groupname" class="searchs form-control tab-event" required />
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('loai-nhom');?></label>
						<div class="col-md-8">
							<select name="grouptype" id="grouptype" class="combos tab-event">
								<option value=""> </option>
								<?php if($grouptype == -1){?>
								<option value="-1">Root</option>
								<?php }?>
								<option value="0"><?=getLanguage('admin');?></option>
								<option value="1"><?=getLanguage('truong-phong-nhan-su');?></option>
								<option value="2"><?=getLanguage('truong-phong-ban');?></option>
								<option value="3"><?=getLanguage('to-truong-truong-nhom');?></option>
								<option value="4"><?=getLanguage('nhan-vien');?></option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('cong-ty');?></label>
						<div class="col-md-8">
							<select name="companyid" id="companyid" class="combos tab-event">
								<option value=""> </option>
								<?php foreach($companys as $item){?>
								<option value="<?=$item->id;?>"><?=$item->company_name;?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row mtop10">
				<div class="col-md-12">
						
				</div>
			</div>
	</div>
</div>
<div class="box">
	<div class="box-header with-border">
	  <div class="brc"><?=getLanguage('tim-thay');?> <span class="semi-bold viewtotal">0</span> <?=getLanguage('ket-qua');?></div>

	  <div class="box-tools pull-right">
			<ul class="button-group pull-right">
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
						<li id="save"><button class="button">
							<i class="fa fa-plus"></i>
							<?=getLanguage('them-moi');?>
							</button>
						</li>
						<?php }?>
						<?php if(isset($permission['edit'])){?>
						<li id="edit">
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
		 <table class="resultset" id="grid"></table>
		 <!--header-->
		 <div id="cHeader">
			<div id="tHeader">    	
				<table width="100%" cellspacing="0" border="1" class="table ">
					<?php for($i=1; $i< 8; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<tr>
						<th><input type="checkbox" id="checkAll" autocomplete="off" /></th>
						<th><?=getLanguage('stt');?></th>
						<th><?=getLanguage('nhom-quyen');?></th>
						<th><?=getLanguage('loai-nhom');?></th>
						<th><?=getLanguage('cong-ty');?></th>
						<th><?=getLanguage('phan-quen');?></th>
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
					<?php for($i=1; $i< 8; $i++){?>
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
<div id="dialog" title="<?=getLanguage('nhom-quyen');?>"></div>
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
		$("#save").click(function(){
			save('');
		});
		$("#edit").click(function(){
			var id = $('#id').val();
			if(id == ''){
				warning('<?=getLanguage('chon-du-lieu-can-sua');?>');
				return false;
			} 
			save(id);
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
	});
	function save(id){
		var search = getSearch();
			var obj = $.evalJSON(search); 
			if(obj.groupname == ""){
				error('<?=getLanguage('nhom-quyen-khong-duoc-trong');?>'); 
				$("#groupname").focus();
				return false;		
			}
			var token = $("#token").val();
			$.ajax({
				url : controller + 'save',
				type: 'POST',
				async: false,
				data: {csrf_stock_name:token,search:search , id:id},
				success:function(datas){
					var obj = $.evalJSON(datas); 
					$("#token").val(obj.csrfHash);
					if(obj.status == 0){
						if(id == ''){
							error('<?=getLanguage('them-moi-khong-thanh-cong');?>'); return false;
						}
						else{
							error('<?=getLanguage('sua-khong-thanh-cong');?>'); return false;	
						}	
					}
					else if(obj.status == -1){
						error('<?=getLanguage('ten-chi-nhanh-da-ton-tai');?>'); return false;
					}
					else{
						if(id == ''){
							success('<?=getLanguage('them-moi-thanh-con');?>'); 
							refresh();
							return false;
						}
						else{
							success('<?=getLanguage('sua-thanh-cong');?>'); 
							refresh();
							return false;
						}
						
					}
				},
				error : function(){
					if(id == ''){
						error('<?=getLanguage('them-moi-khong-thanh-cong');?>'); return false;	
					}
					else{
						error('<?=getLanguage('sua-khong-thanh-cong');?>'); return false;
					}
				}
			});
	}
	function init(){
		$('#grouptype').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-nhom');?>',
			single: true
		});
		$('#companyid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-cong-ty');?>',
			single: true
		});
		var companyid = '<?=$companyid;?>';
		$("#companyid").multipleSelect('setSelects', companyid.split(','));
	}
	function funcList(obj){
		$(".edit").each(function(e){
			$(this).click(function(){ 
				 var groupname = $(".groupname").eq(e).text().trim();
				 var grouptype = $(this).attr('grouptype');
				 var companyid = $(this).attr('companyid');
				 var id = $(this).attr('id');
				 $("#id").val(id);	
				 $("#groupname").val(groupname);	
				 $("#companyid").multipleSelect('setSelects', companyid.split(','));
				 $("#grouptype").multipleSelect('setSelects', grouptype.split(','));
			});
			function getIDChecked(){
				return 1;	
			} 
		});	
		$(".permission").each(function(e){
			$(this).click(function(event){ 
				$( "#dialog" ).dialog( "open" );
				event.preventDefault();
				var id = $(this).attr('id');
				var token = $("#token").val();
				$.ajax({
					url : controller + 'getRight',
					type: 'POST',
					async: false,
					data: {csrf_stock_name:token, id:id},
					success:function(datas){
						var obj = $.evalJSON(datas); 
						$("#token").val(obj.csrfHash); 
						$('#dialog').html(obj.content);
						$("#saveright").click(function(){
							var right = getRight();
							token = $("#token").val();
							$.ajax({
								url : controller + 'setRight',
								type: 'POST',
								async: false,
								data: {csrf_stock_name:token, id:id, right:right},
								success:function(datas){
									var obj2 = $.evalJSON(datas);
									//$("#token").val(obj2.csrfHash);
								}
							});
							success('<?=getLanguage('sua-thanh-cong');?>');
							$("#dialog").dialog( "close" );	
							
						});	
					},
					error : function(){
						error('<?=getLanguage('sua-khong-thanh-cong');?>');
					}
				});
				return false;
			});
		});
	}
	function refresh(){
		var companyid = '<?=$companyid;?>';
		$(".loading").show();
		$(".searchs").val("");
		$('#grouptype').multipleSelect('uncheckAll');
		$("#companyid").multipleSelect('setSelects', companyid.split(','));
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