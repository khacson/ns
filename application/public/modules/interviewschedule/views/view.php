<style title="" type="text/css">
	table col.c1 { width: 45px; }
	table col.c2 { width: 45px; }
	table col.c3 { width: 150px; }
	table col.c4 { width: 100px; }
	table col.c5 { width: 150px; }
	table col.c6 { width: 80px; }
	table col.c7 { width: 100px; }
	table col.c8 { width: 150px; }
	table col.c9 { width: 120px; }
	table col.c10 { width: 130px; }
	table col.c11 { width: 150px; }
	table col.c12 { width: 180px; }
	table col.c13 { width: 100px; }
	table col.c14 { width: auto;}
</style>
<?=$this->load->inc('breadcrumb');?>
<div class="box mtop10">
	<div class="box-header with-border">
	  <div class="brc"><?=getLanguage('tim-thay');?> <span class="semi-bold viewtotal">0</span> <?=getLanguage('ung-vien');?></div>
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
					<?php for($i=1; $i< 15; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<tr>
						<th><input type="checkbox" id="checkAll" autocomplete="off" /></th>
						<th ><?=getLanguage('stt');?></th>
						<th id="ord_it.fullname" ><?=getLanguage('ho-ten');?></th>
						<th id="ord_it.phone" ><?=getLanguage('dien-thoai');?></th>
						<th id="ord_it.email" ><?=getLanguage('email');?></th>
						<th id="ord_it.sex" ><?=getLanguage('gioi-tinh');?></th>
						<th id="ord_it.birthday" ><?=getLanguage('ngay-sinh');?></th>
						<th id="ord_it.recruitment_position" ><?=getLanguage('vi-tri-ung-tuyen');?></th>
						<th id="ord_it.date_interview" ><?=getLanguage('ngay-phong-van');?></th>
						<th id="ord_it.academic_level" ><?=getLanguage('trinh-do-hoc-van');?></th>
						<th id="ord_it.input_academic_skills"><?=getLanguage('trinh-do-chuyen-mon');?></th>
						<th id="ord_it.description" ><?=getLanguage('ghi-chu');?></th>
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
					<tr class="row-searach">
						<td></td>
						<td></td>
						<td>
							<input type="text" name="fullname" id="fullname" class="searchs form-control " />
						</td>
						<td>
							<input type="text" name="phone" id="phone" class="searchs form-control " />
						</td>
						<td>
							<input type="text" name="email" id="email" class="searchs form-control " />
						</td>
						<td>
							<select  id="sex" name="sex" class="combos">
								<option value="1"><?=getLanguage('nam');?></option>
								<option value="2"><?=getLanguage('nu');?></option>
								<option value="-1"><?=getLanguage('gioi-tinh-khac');?></option>
							</select>
						</td>
						<td></td>
						<td>
							<input type="text" name="recruitment_position" id="recruitment_position" class="searchs form-control " />
						</td>
						<td>
							<div id="click_date_interview" class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
								<input value="" id="date_interview" name="date_interview" type="text" class="searchs form-control tab-event">
								<div class="input-group-addon">
									<i class="fa fa-calendar "></i>
								</div>
							</div>
						</td>
						<td>
							<select id="academic_level" name="academic_level" class="combos" >
								<option value=""></option>
								<?php foreach($academics as $item){?>
									<option value="<?=$item->id;?>"><?=$item->academic_name;?></option>
								<?php }?>
							</select>
						</td>
						<td>
							<input type="text" name="input_academic_skills" id="input_academic_skills" class="searchs form-control " />
						</td>
						<td>
							<input type="text" name="description" id="description" class="searchs form-control " />
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
		searchFunction();
	});
	function searchFunction(){
		$("#fullname,#phone,#email,#recruitment_position,#input_academic_skills,#description").keyup(function() {
			searchList();	
		});
		$('#date_interview').datepicker().on('changeDate', function (ev) {
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
		if(obj.fullname == ""){
			warning('<?=getLanguage('ho-ten-duoc-trong');?>'); 
			$("#input_fullname").focus();
			return false;		
		}
		if(obj.phone == ""){
			warning('<?=getLanguage('dien-thoai-duoc-trong');?>'); 
			$("#input_phone").focus();
			return false;		
		}
		if(obj.date_interview == ""){
			warning('<?=getLanguage('ngay-phong-van-khong-duoc-trong');?>'); 
			$("#input_date_interview").focus();
			return false;		
		}
		if(obj.recruitment_position == ""){
			warning('<?=getLanguage('vi-tri-ung-tuyen-duoc-trong');?>'); 
			$("#input_recruitment_position").focus();
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
		$('#sex').multipleSelect({
			filter: true,
			single: false,
			placeholder: '<?=getLanguage('chon-gioi-tinh')?>',
			onClick: function(view){
				searchList();
			}
		});
		$('#academic_level').multipleSelect({
			filter: true,
			single: false,
			placeholder: '<?=getLanguage('chon-trinh-do')?>',
			onClick: function(view){
				searchList();
			}
		});
	}
	function funcList(obj){
		$(".edit").each(function(e){
			$(this).click(function(){ 
				var ethnic_name = $(".ethnic_name").eq(e).text().trim();
				var id = $(this).attr('id');
				$("#id").val(id);	
				$("#ethnic_name").val(ethnic_name);	
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
