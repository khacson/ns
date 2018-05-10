<style title="" type="text/css">
	table col.c1 { width: 45px; }
	table col.c2 { width: 45px; }
	table col.c3 { width: 180px; }
	table col.c4 { width: 150px; }
	table col.c5 { width: 250px; }
	table col.c6 { width: 70px; }
	table col.c7 { width: 200px; }	
	table col.c8 { width: 110px; }
	table col.c9 { width: 100px; }	
	table col.c10 { width: 100px; }
	table col.c11 { width: 150px; }	
	table col.c12 { width: auto;}
</style>
<?=$this->load->inc('breadcrumb');?>
<div class="box mtop10">
	<div class="box-header with-border">
	  <div class="brc"><?=getLanguage('tim-thay');?> <span class="semi-bold viewtotal">0</span> <?=getLanguage('tuyen-dung');?></div>

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
					<?php for($i=1; $i< 13; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<tr>
						<th><input type="checkbox" id="checkAll" autocomplete="off" /></th>
						<th><?=getLanguage('stt');?></th>
						<th id="ord_d.departmanet_name"><?=getLanguage('phong-ban');?></th>
						<th id="ord_al.academic_name"><?=getLanguage('trinh-do');?></th>
						<th id="ord_r.request"><?=getLanguage('yeu-cau');?></th>
						<th id="ord_r.quantity"><?=getLanguage('so-luong');?></th>
						<th id="ord_r.note"><?=getLanguage('ly-do-tuyen');?></th>
						<th id="ord_r.approved"><?=getLanguage('trang-thai');?></th>
						<th id="ord_r.fromdate"><?=getLanguage('tu-ngay');?></th>
						<th id="ord_r.todate"><?=getLanguage('den-ngay');?></th>
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
					<?php for($i=1; $i< 13; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<tr class="row-searach">
						<td></td>
						<td></td>
						<td>
							<select class="combos" id="departmentid" name="departmentid">
								<?php foreach($departments as $item){?>
								<option value="<?=$item->id;?>"><?=$item->departmanet_name;?></option>
								<?php }?>
							</select>
						</td>
						<td>
							<select class="combos" id="academic_levelid" name="academic_levelid">
								<?php foreach($academics as $item){?>
								<option value="<?=$item->id;?>"><?=$item->academic_name;?></option>
								<?php }?>
							</select>
						</td>
						<td>
							<input type="text" name="request" id="request" class="searchs form-control " />
						</td>
						<td>
							<input type="text" name="quantity" id="quantity" class="searchs form-control " />
						</td>
						<td>
							<input type="text" name="note" id="note" class="searchs form-control " />
						</td>
						<td>
							<select class="combos" id="approved" name="approved"  >
								<option value=""></option>
								<option value="1"><?=getLanguage('cho-phep-tuyen')?></option>
								<option value="0"><?=getLanguage('khong-cho-phep-tuyen')?></option>
							</select>
						</td>
						<td></td>
						<td></td>
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
				warning('<?=getLanguage('chon-nhom-quyen');?>');
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
		searchFunction();
	});
	function searchFunction(){
		$("#request,#quantity,#note").keyup(function() {
			searchList();	
		});
	}
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
				$('#input_departmanet_name').select();
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
		if(obj.departmanet_name == ""){
			warning('<?=getLanguage('phong-ban-khong-duoc-trong');?>'); 
			$("#departmanet_name").focus();
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
			placeholder:'<?=getLanguage('chon-phong-ban')?>',
			single: false,
			onClick: function(view){
				searchList();
			}
		});
		$('#approved').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-trang-thai')?>',
			single: false,
			onClick: function(view){
				searchList();
			}
		});
		$('#academic_levelid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-trinh-do')?>',
			single: false,
			onClick: function(view){
				searchList();
			}
		});
	}
	function funcList(obj){
		$(".edit").each(function(e){
			$(this).click(function(){ 
				var departmanet_name = $(".departmanet_name").eq(e).text().trim();
				var phone = $(".phone").eq(e).text().trim();
				var fax = $(".fax").eq(e).text().trim();
				var heads = $(".heads").eq(e).text().trim();
				var id = $(this).attr('id');
				$("#id").val(id);	
				$("#departmanet_name").val(departmanet_name);	
				$("#phone").val(phone);	
				$("#fax").val(fax);	
				$("#heads").val(heads);	
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
