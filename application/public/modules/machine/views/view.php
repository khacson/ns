<style title="" type="text/css">
	table col.c1 { width: 45px; }
	table col.c2 { width: 45px; }
	table col.c3 { width: 120px; }
	table col.c4 { width: 80px; }
	table col.c5 { width: 110px; }
	table col.c6 { width: 80px; }
	table col.c7 { width: 100px; }
	table col.c8 { width: 80px; }
	table col.c9 { width: 100px; }
	table col.c10 { width: 80px; }
	table col.c11 { width: 110px; }
	table col.c12 { width: 80px; }
	table col.c13 { width: 100px; }
	table col.c14 { width: 80px; }
	table col.c15 { width: 100px; }
	table col.c14 { width: 80px; }
	table col.c15 { width: 100px; }
	table col.c16 { width: 80px; }
	table col.c17 { width: 90px; }
	table col.c18 { width: 90px; }
	table col.c19 { width: 100px; }
	table col.c20 { width: 80px; }
	table col.c21 { width: auto;}
</style>
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
					<label class="control-label col-md-4"><?=getLanguage('serial');?></label>
					<div class="col-md-8">
						<input type="text" name="machine_sn" placeholder="<?=getLanguage('nhap-serial');?>" id="machine_sn" class="searchs form-control tab-event" />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10"></div>
	</div>
</div>
<div class="box">
	<div class="box-header with-border">
	  <div class="brc"><?=getLanguage('tim-thay');?> <span class="semi-bold viewtotal">0</span> <?=getLanguage('may-cham-com');?></div>

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
					<button class="button" >
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
					<?php for($i=1; $i< 22; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<tr>
						<th style="vertical-align:middle" rowspan="2"><input type="checkbox" id="checkAll" autocomplete="off" /></th>
						<th style="vertical-align:middle" rowspan="2"><?=getLanguage('stt');?></th>
						<th style="vertical-align:middle" rowspan="2" id="ord_m.machine_sn" ><?=getLanguage('serial');?></th>
						<th colspan="2"><?=getLanguage('shutdown');?></th>
						<th colspan="2"><?=getLanguage('restart');?></th>
						<th colspan="2"><?=getLanguage('upload');?></th>
						<th colspan="2"><?=getLanguage('download');?></th>
						<th colspan="2"><?=getLanguage('delete');?></th>
						<th colspan="2"><?=getLanguage('delete-file');?></th>
						<th colspan="4"><?=getLanguage('fingerprint');?></th>
						<th rowspan="2"></th>
						<th rowspan="2"></th>
					</tr>
					<tr>
						<!--S shutdown-->
						<th><?=getLanguage('status');?></th>
						<th><?=getLanguage('date-sync');?></th>
						<!--E shutdown-->
						<!--S restart-->
						<th><?=getLanguage('status');?></th>
						<th><?=getLanguage('date-sync');?></th>
						<!--E restart-->
						<!--S upload-->
						<th><?=getLanguage('status');?></th>
						<th><?=getLanguage('date-sync');?></th>
						<!--E upload-->
						<!--S upload-->
						<th><?=getLanguage('status');?></th>
						<th><?=getLanguage('date-sync');?></th>
						<!--E upload-->
						<!--S upload-->
						<th><?=getLanguage('status');?></th>
						<th><?=getLanguage('date-sync');?></th>
						<!--E upload-->
						<!--S upload-->
						<th><?=getLanguage('status');?></th>
						<th><?=getLanguage('date-sync');?></th>
						<!--E upload-->
						<!--S upload-->
						<th><?=getLanguage('status');?></th>
						<th><?=getLanguage('from-date');?></th>
						<th><?=getLanguage('to-date');?></th>
						<th><?=getLanguage('date-sync');?></th>
						<!--E upload-->
					</tr>
				</table>
			</div>
		</div>
		<!--end header-->
		<!--body-->
		<div id="data">
			<div id="gridView">
				<table id="group"  width="100%" cellspacing="0" border="1">
					<?php for($i=1; $i< 22; $i++){?>
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
  <div class="modal-dialog w500">
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
				$(".loading").show();
				searchList();
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
				$('#input_machine_sn').select();
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
		if(obj.machine_sn == ""){
			warning('<?=getLanguage('serial-khong-duong-trong');?>'); 
			$("#machine_sn").focus();
			return false;		
		}
		$('.loading').show();
		var data = new FormData();
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
				var machine_sn = $(".machine_sn").eq(e).text().trim();
				var id = $(this).attr('id');
				$("#id").val(id);	
				$("#machine_sn").val(machine_sn);	
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
		//$('#activate,#processid,#groupid').multipleSelect('uncheckAll');
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
