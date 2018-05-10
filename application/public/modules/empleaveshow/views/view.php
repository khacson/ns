<style title="" type="text/css">
	table col.c1 { width: 50px; }
	table col.c2 { width: 50px; }
	table col.c3 { width: 80px;}
	table col.c4 { width: 150px; }
	table col.c5 { width: 150px; }
	table col.c6 { width: 150px; }
	table col.c7 { width: 150px;}
	table col.c8 { width: 150px; }
	table col.c9 { width: 180px; }
	table col.c10 { width: 100px; }
	table col.c11 { width: auto;}
	.col-md-4{ white-space: nowrap !important;}
</style>
<?=$this->load->inc('breadcrumb');?>
<div class="box mtop10">
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
					<button class="button" >
					<i class="fa fa-plus"></i>
					<?=getLanguage('cham-nghi-phep');?>
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
					<?php for($i=1; $i< 12; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<tr>
						<th><input type="checkbox" name="checkAll" id="checkAll" /></th>
						<th><?=getLanguage('stt')?></th>	
						<th id="ord_s.code"><?=getLanguage('ma-nhan-vien')?></th>	
						<th id="ord_s.fullname"><?=getLanguage('ho-ten')?></th>
						<th id="ord_s.fullname"><?=getLanguage('tu-ngay')?></th>
						<th id="ord_c.absent_times"><?=getLanguage('den-ngay')?></th>
						<th id="ord_d.departmanet_name"><?=getLanguage('bo-phan')?></th>
						<th id="ord_d.departmanet_name"><?=getLanguage('chu-vu')?></th>
						<th id="ord_d.departmanet_name"><?=getLanguage('to-nhom')?></th>
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
					<?php for($i=1; $i< 12; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<tr class="row-searach">
						<td></td>
						<td></td>
						
						<td>
							<input type="text" name="code" id="code" class="searchs form-control " />
						</td>
						<td>
							<input type="text" name="fullname" id="fullname" class="searchs form-control " />
						</td>
						<td>
							<div id="click_time_start" class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
								<input value="" id="time_start" name="time_start" type="text" class="searchs form-control tab-event">
								<div class="input-group-addon">
									<i class="fa fa-calendar "></i>
								</div>
							</div>
						</td>
						<td>
							<div id="click_time_end" class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
								<input value="<?=$datenow;?>" id="time_end" name="time_end" type="text" class="searchs form-control tab-event">
								<div class="input-group-addon">
									<i class="fa fa-calendar "></i>
								</div>
							</div>
						</td>
						<td>
							<select class="combos" id="departmentid" name="departmentid">
								<?php foreach($departments as $item){?>
								<option value="<?=$item->id;?>"><?=$item->departmanet_name;?></option>
								<?php }?>
							</select>
						</td>
						<td>
							<select class="combos" id="positionid" name="positionid">
								<?php foreach($positions as $item){?>
									<option value="<?=$item->id;?>"><?=$item->position_name;?></option>
								<?php }?>
							</select>
						</td>
						<td>
							<select id='group_work_id' name='group_work_id' class="combos" >
								<?php foreach($departmentGroups as $item){?>
									<option value="<?=$item->id;?>"><?=$item->departmentgroup_name;?></option>
								<?php }?>
							</select>
						</td>
						<td></td>
						<td></td>
					</tr>
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
<link rel="stylesheet" href="<?=url_tmpl();?>datetimepicker/css/bootstrap-datetimepicker.min.css">
<script src="<?=url_tmpl();?>datetimepicker/js/bootstrap-datetimepicker.js"></script>
<link href="<?=url_tmpl();?>css/jquery-ui.css" rel="stylesheet" type="text/css"/>
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
			window.location = controller+'export?search='+search
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
				$('#input_ethnic_name').select();
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
		var departmentid = obj.departmentid;
		var departmentid = obj.departmentid;
		if(obj.departmentid == "" && departmentid == ""){
			warning('<?=getLanguage('ma-nhan-vien-hoac-bo-phan-khong-duoc-trong');?>'); 
			return false;		
		}
		if(obj.time_start == ""){
			warning('<?=getLanguage('thoi-gian-bat-dau-khong-duoc-trong');?>'); 
			return false;		
		}
		if(obj.time_end == ""){
			warning('<?=getLanguage('thoi-gian-ket-thuc-khong-duoc-trong');?>'); 
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
				$('.loading').hide();
				if(obj.status == -2){
					error('<?=getLanguage('nhan-vien-khong-ton-tai');?>'); return false;
				}
				else if(obj.status == 0){
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
	}
	function funcList(obj){
		$(".edit").each(function(e){
			$(this).click(function(){ 
				var code = $(".code").eq(e).text().trim();
				var fullname = $(".fullname").eq(e).text().trim();
				var identity = $(this).attr('identity');
				var departmentid = $(this).attr('departmentid');
				var id = $(this).attr('id');
				$("#id").val(id);	
				$("#code").val(code);
				$("#fullname").val(fullname);	
				$("#identity").val(identity);	
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
		$('#datenow').val('<?=$datenow;?>');
		$('#departmentid').multipleSelect('uncheckAll');
		$('#fromdate').val('<?=$fromdate;?>');
		$('#todate').val('<?=$todate;?>');
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
