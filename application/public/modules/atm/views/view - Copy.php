<style title="" type="text/css">
	table col.c1 { width: 50px; }
	table col.c2 { width: 60px; }
	table col.c3 { width: 180px;}
	table col.c4 { width: 110px;}
	table col.c5 { width: 75px;}
	table col.c6 { width: 90px;}
	table col.c7 { width: 150px;}
	table col.c8 { width: 150px;}
	table col.c9 { width: 150px;}
	table col.c10 { width: 150px;}
	table col.c11 { width: 150px;}
	table col.c12 { width: 150px;}
	table col.c13 { width: 150px;}
	table col.c14 { width: 150px;}
	table col.c15 { width: 150px;}
	table col.c16 { width: 150px;}
	table col.c17 { width: 150px;}
	table col.c18 { width: 150px;}
	table col.c19 { width: 150px;}
	table col.c20 { width: 150px;}
	table col.c21 { width: 150px;}
	table col.c22 { width: 150px;}
	table col.c23 { width: 150px;}
	table col.c24 { width: 150px;}
	table col.c25 { width: 150px;}
	table col.c26 { width: 150px;}
	table col.c27 { width: 150px;}
	table col.c28 { width: 150px;}
	table col.c29 { width: 150px;}
	table col.c30 { width: 150px;}
	table col.c31 { width: 150px;}
	table col.c32 { width: 200px;}
	table col.c33 { width: auto;}
	.col-md-4{ padding-right: 0 !important; padding-left:10px !important; white-space: nowrap !important;}
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
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('ma-nhan-vien')?></label>
							<div class="col-md-8">
								<input type="text" name="code" id="code" placeholder="Nhập mã nhân viên" class="searchs form-control" required />
							</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('ho-ten')?></label>
						<div class="col-md-8">
							<input type="text" name="fullname" id="fullname" placeholder="Nhập họ tên" class="searchs form-control" required />
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('cmnd')?></label>
							<div class="col-md-8">
								<input type="text" name="identity" id="identity" placeholder="Nhập chứng minh nhân dân" class="searchs form-control" required />
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
						<label class="control-label col-md-4"><?=getLanguage('chuc-vu')?></label>
						<div class="col-md-8">
							<select class="combos" id="positionid" name="positionid">
								<?php foreach($positions as $item){?>
									<option value="<?=$item->id;?>"><?=$item->position_name;?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('dien-thoai')?></label>
							<div class="col-md-8">
								<input type="text" name="phone" id="phone" placeholder="Nhập số điện thoại" class="searchs form-control" required />
							</div>
					</div>
				</div>
			</div>
			<div class="row mtop10">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('trinh-do-hoc-van')?></label>
						<div class="col-md-8">
							<select id="academic_level" name="academic_level" class="combos"> 
									<?php foreach($academics as $item){?>
										<option value="<?=$item->id;?>"><?=$item->academic_name;?></option>
									<?php }?>
								</select>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('dan-toc')?></label>
						<div class="col-md-8">
							<select id="ethnicid" name="ethnicid" class="combos">
								<?php foreach($ethnics as $item){?>
									<option value="<?=$item->id;?>"><?=$item->ethnic_name;?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('ton-giao')?></label>
						<div class="col-md-8">
							<select id="religionid" name="religionid" class="combos">
								<?php foreach($religions as $item){?>
									<option value="<?=$item->id;?>"><?=$item->religion_name;?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row mtop10">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('tinh-trang-cong-viec')?></label>
						<div class="col-md-8">
							<select class='combos' id='jobstatusid' name='jobstatusid'>
								<?php foreach($jobstatus as $item){?>
									<option value="<?=$item->id;?>"><?=$item->status_name;?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row mtop10"></div>
		</div>
	</div>
</div>
<div class="box">
	<div class="box-header with-border">
	  <div class="brc"><?=getLanguage('tim-thay');?> <span class="semi-bold viewtotal">0</span> <?=getLanguage('dan-toc');?></div>

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
					<?php for($i=1; $i< 34; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<tr>
						<th><input type="checkbox" name="checkAll" id="checkAll" /></th>
						<th><?=getLanguage('stt')?></th>								
						<th id="ord_s.fullname"><?=getLanguage( 'ho-ten');?></th>
						<th id="ord_s.code"><?=getLanguage( 'ma-nhan-vien');?></th>
						<th id="ord_s.sex"><?=getLanguage( 'gioi-tinh');?></th>
						<th id="ord_s.birthday"><?=getLanguage( 'ngay-sinh');?></th>
						<th id="ord_s.place_of_birth"><?=getLanguage( 'noi-sinh');?></th>
						<th id="ord_s.marriage"><?=getLanguage( 'hon-nhan');?></th>
						<th id="ord_s.nationality"><?=getLanguage( 'quoc-tich');?></th>
						<th id="ord_s.ethnicid"><?=getLanguage( 'dan-toc');?></th>
						<th id="ord_s.religionid"><?=getLanguage('ton-giao');?></th>
						<th id="ord_s.identity"><?=getLanguage('cmnd');?></th>
						<th id="ord_s.identity_date"><?=getLanguage('ngay-cap');?></th>
						<th id="ord_s.identity_from"><?=getLanguage('noi-cap');?></th>
						<th id="ord_s.academic_level"><?=getLanguage('trinh-do-hoc-van');?></th>
						<th id="ord_s.academic_skills"><?=getLanguage('trinh-do-chuyen-mon');?></th>
						<th id="ord_s.departmentid"><?=getLanguage('phong-ban');?></th>
						<th id="ord_s.positionid"><?=getLanguage('chu-vu');?></th>
						<th id="ord_s.group_work_id"><?=getLanguage('to-nhom');?></th>
						<th id="ord_s.date_start"><?=getLanguage('ngay-bat-dau');?></th>
						<th id="ord_s.contrac_date"><?=getLanguage('ngay-ky-hop-dong');?></th>
						<th id="ord_s.contrac_code"><?=getLanguage('ma-hop-dong');?></th>
						<th id="ord_s.contac_expired_date"><?=getLanguage('ngay-het-han');?></th>
						<th id="ord_s.insurance_code"><?=getLanguage('ma-so-bao-hiem');?></th>
						<th id="ord_s.insurance_hospital"><?=getLanguage('benh-vien-dang-ky');?></th>
						<th id="ord_s.tax_code"><?=getLanguage('ma-so-thue');?></th>
						<th id="ord_s.bank_accout"><?=getLanguage('tk-ngan-hang');?></th>
						<th id="ord_s.bank_name"><?=getLanguage('ngan-hang');?></th>
						<th id="ord_s.jobstatusid"><?=getLanguage('tinh-trang-cong-viec');?></th>
						<th id="ord_s.family_name"><?=getLanguage('ten-nguoi-than');?></th>
						<th id="ord_s.family_phone"><?=getLanguage('dien-thoai');?></th>
						<th id="ord_s.family_relation"><?=getLanguage('quan-he');?></th>
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
					<?php for($i=1; $i< 34; $i++){?>
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
		$('#export').click(function(){
			search = getSearch();
			window.location = controller+'export?search='+ search;
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
		if(obj.ethnic_name == ""){
			warning('<?=getLanguage('hre_ethnic-khong-duoc-trong');?>'); 
			$("#ethnic_name").focus();
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
			single: false
		});
		$('#positionid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-chuc-vu')?>',
			single: false
		});
		$('#jobstatusid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-tinh-trang-cong-viec')?>',
			single: false
		});
		$('#academic_level').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-trinh-do-hoc-van')?>',
			single: false
		}); 
		$('#ethnicid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-dan-toc')?>',
			single: false
		}); 
		$('#religionid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-ton-giao')?>',
			single: false
		});
	}
	function funcList(obj){
		$('.edit').each(function(e){
			$(this).click(function(){ 
				 var fullname = $('.fullname').eq(e).html().trim();
				 var identity = $('.identity').eq(e).html().trim();
				 var code = $('.code').eq(e).html().trim();
				 
				 var positionid = $(this).attr('positionid');
				 var departmentid = $(this).attr('departmentid');
				 var jobstatusid = $(this).attr('jobstatusid');
				 
				 var academic_level = $(this).attr('academic_level');
				 var ethnicid = $(this).attr('ethnicid');
				 var religionid = $(this).attr('religionid');
				 
				 var id = $(this).attr('id');
				 $('#id').val(id);	
				 $('#fullname').val(fullname);
				 $('#identity').val(identity);		
				 $('#code').val(code);
		
				 $('#positionid').multipleSelect('setSelects', positionid.split(','));
				 $('#departmentid').multipleSelect('setSelects', departmentid.split(','));
				 $('#jobstatusid').multipleSelect('setSelects', jobstatusid.split(','));
				 
				 $('#academic_level').multipleSelect('setSelects', academic_level.split(','));
				 $('#ethnicid').multipleSelect('setSelects', ethnicid.split(','));
				 $('#religionid').multipleSelect('setSelects', religionid.split(','));
			});
			function getIDChecked(){
				return 1;	
			} 
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
		$('#departmentid,#positionid,#jobstatusid,#academic_level,#ethnicid,#religionid').multipleSelect('uncheckAll');
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