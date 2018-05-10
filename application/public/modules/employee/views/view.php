<style title="" type="text/css">
	table col.c1 { width: 50px; }
	table col.c2 { width: 60px; }
	table col.c3 { width: 80px;}
	table col.c4 { width: 160px;}
	table col.c5 { width: 75px;}
	table col.c6 { width: 90px;}
	table col.c7 { width: 150px;}
	table col.c8 { width: 110px;}
	table col.c9 { width: 100px;}
	table col.c10 { width: 100px;}
	table col.c11 { width: 100px;}
	table col.c12 { width: 95px;}
	table col.c13 { width: 90px;}
	table col.c14 { width: 110px;}
	table col.c15 { width: 130px;}
	table col.c16 { width: 150px;}
	table col.c17 { width: 150px;}
	table col.c18 { width: 150px;}
	table col.c19 { width: 150px;}
	table col.c20 { width: 100px;}
	table col.c21 { width: 130px;}
	table col.c22 { width: 140px;}
	table col.c23 { width: 110px;}
	table col.c24 { width: 150px;}
	table col.c25 { width: 150px;}
	table col.c26 { width: 110px;}
	table col.c27 { width: 120px;}
	table col.c28 { width: 130px;}
	table col.c29 { width: 150px;}
	table col.c30 { width: 120px;}
	table col.c31 { width: 120px;}
	table col.c32 { width: 200px;}
	table col.c33 { width: auto;}
	table col.cc20 { width: 20px;}
	.col-md-4{ padding-right: 0 !important; padding-left:10px !important; white-space: nowrap !important;}
	
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
				
				<?php if(isset($permission['delete'])){?>
				<li id="delete">
					<button type="button" class="button">
						<i class="fa fa-times"></i>
						<?=getLanguage('xoa');?>
					</button>
				</li>
				<?php }?>
				<?php if(isset($permission['export'])){?>
				<li id="export">
					<button class="button">
						<i class="fa fa-file-excel-o"></i>
						<?=getLanguage('export')?>
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
					<?php for($i=1; $i< 34; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<col class="cc20">
					<tr>
						<th><input type="checkbox" name="checkAll" id="checkAll" /></th>
						<th><?=getLanguage('stt')?></th>								
						<th id="ord_s.code"><?=getLanguage( 'ma-nhan-vien')?></th>
						<th id="ord_s.fullname"><?=getLanguage( 'ho-ten')?></th>
						<th id="ord_s.sex"><?=getLanguage( 'gioi-tinh')?></th>
						<th id="ord_s.birthday"><?=getLanguage( 'ngay-sinh')?></th>
						<th id="ord_s.place_of_birth"><?=getLanguage( 'noi-sinh')?></th>
						<th id="ord_s.marriage"><?=getLanguage( 'hon-nhan')?></th>
						<th id="ord_s.nationality"><?=getLanguage( 'quoc-tich')?></th>
						<th id="ord_s.ethnicid"><?=getLanguage( 'dan-toc')?></th>
						<th id="ord_s.religionid"><?=getLanguage('ton-giao')?></th>
						<th id="ord_s.identity"><?=getLanguage('cmnd')?></th>
						<th id="ord_s.identity_date"><?=getLanguage('ngay-cap')?></th>
						<th id="ord_s.identity_from"><?=getLanguage('noi-cap')?></th>
						<th id="ord_s.academic_level"><?=getLanguage('trinh-do-hoc-van')?></th>
						<th id="ord_s.academic_skills"><?=getLanguage('trinh-do-chuyen-mon')?></th>
						<th id="ord_s.departmentid"><?=getLanguage('phong-ban')?></th>
						<th id="ord_s.positionid"><?=getLanguage('chu-vu')?></th>
						<th id="ord_s.group_work_id"><?=getLanguage('to-nhom')?></th>
						<th id="ord_s.date_start"><?=getLanguage('ngay-bat-dau')?></th>
						<th id="ord_s.contrac_date"><?=getLanguage('ngay-ky-hop-dong')?></th>
						<th id="ord_s.contrac_code"><?=getLanguage('ma-hop-dong')?></th>
						<th id="ord_s.contac_expired_date"><?=getLanguage('ngay-het-han')?></th>
						<th id="ord_s.insurance_code"><?=getLanguage('ma-so-bao-hiem')?></th>
						<th id="ord_s.insurance_hospital"><?=getLanguage('benh-vien-dang-ky')?></th>
						<th id="ord_s.tax_code"><?=getLanguage('ma-so-thue')?></th>
						<th id="ord_s.bank_accout"><?=getLanguage('tk-ngan-hang')?></th>
						<th id="ord_s.bank_name"><?=getLanguage('ngan-hang')?></th>
						<th id="ord_s.jobstatusid"><?=getLanguage('tinh-trang-cong-viec')?></th>
						<th id="ord_s.family_name"><?=getLanguage('ten-nguoi-than')?></th>
						<th id="ord_s.family_phone"><?=getLanguage('dien-thoai')?></th>
						<th id="ord_s.family_relation" class="text-left"><?=getLanguage('quan-he')?></th>
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
					<?php for($i=1; $i< 34; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<tr class="row-searach">
						<td></td>
						<td></td>
						<td>
							<input type="text" name="code" id="code" placeholder="" class="searchs form-control" required />
						</td>
						<td>
							<input type="text" name="fullname" id="fullname" placeholder="" class="searchs form-control" required />
						</td>
						<td>
							<select  id="sex" name="sex" class="combos" data-placeholder="<?=getLanguage('chon-gioi-tinh')?>">
								<option  value="1"><?=getLanguage('nam');?></option>
								<option  value="2"><?=getLanguage('nu');?></option>
								<option  value="-1"><?=getLanguage('gioi-tinh-khac');?></option>
							</select>
						</td>
						<td>
							<div id="click_birthday" class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
								<input id="birthday" name="birthday" type="text" class="searchs form-control tab-event">
								<div class="input-group-addon">
									<i class="fa fa-calendar "></i>
								</div>
							</div>
						</td>
						<td>
							<input type="text" name="place_of_birth" id="place_of_birth" placeholder="" class="searchs form-control" required />
						</td>
						<td style="display: table-cell;">
								<select id="marriage" name="marriage" class="combos" >
									<option value="1">Đã có gia đình</option>
									<option value="2">Độc thân</option>
									<option value="-1">Khác</option>
								</select>
						</td>
						<td>
							<select id="nationality" name="nationality" class="combos">
								<option value="1">Việt Nam</option>
								<option value="-1">Quốc tịch khác</option>
							</select>
						</td>
						<td>
							<select id="ethnicid" name="ethnicid" class="combos">
								<?php foreach($ethnics as $item){?>
									<option value="<?=$item->id;?>"><?=$item->ethnic_name;?></option>
								<?php }?>
							</select>
						</td>
						<td>
							<select id="religionid" name="religionid" class="combos">
								<?php foreach($religions as $item){?>
									<option value="<?=$item->id;?>"><?=$item->religion_name;?></option>
								<?php }?>
							</select>
						</td>
						<td>
							<input type="text" name="identity" id="identity" placeholder="" class="searchs form-control" required />
						</td>
						<td>
							<div  id="click_identity_date" class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
								<input id="identity_date" name="identity_date" type="text" class="searchs form-control tab-event">
								<div class="input-group-addon">
									<i class="fa fa-calendar "></i>
								</div>
							</div>
						</td>
						<td>
							<select id="identity_from" name="identity_from" class="combos" >
								<?php foreach($provinces as $item){?>
									<option value="<?=$item->id;?>"><?=$item->province_name;?></option>
								<?php }?>
							</select>
						</td>
						<td>
							<select id="academic_level" name="academic_level" class="combos"> 
								<?php foreach($academics as $item){?>
									<option value="<?=$item->id;?>"><?=$item->academic_name;?></option>
								<?php }?>
							</select>
						</td>
						<td>
							<input type="text" name="academic_skills" id="academic_skills" placeholder="" class="searchs form-control" required />
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
								<option value=""></option>
								<?php foreach($departmentGroups as $item){?>
									<option value="<?=$item->id;?>"><?=$item->departmentgroup_name;?></option>
								<?php }?>
							</select>
						</td>
						<td>
							<div  id="click_date_start" class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
								<input id="date_start" name="date_start" type="text" class="searchs form-control tab-event">
								<div class="input-group-addon">
									<i class="fa fa-calendar "></i>
								</div>
							</div>
						</td>
						<td>
							<div  id="click_contrac_date" class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
								<input id="contrac_date" name="contrac_date" type="text" class="searchs form-control tab-event">
								<div class="input-group-addon">
									<i class="fa fa-calendar "></i>
								</div>
							</div>
						</td>
						<td>
							<input type="text" name="contrac_code" id="contrac_code" placeholder="" class="searchs form-control" required />
						</td>
						<td>
							<div  id="click_contac_expired_date" class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
								<input id="contac_expired_date" name="contac_expired_date" type="text" class="searchs form-control tab-event">
								<div class="input-group-addon">
									<i class="fa fa-calendar "></i>
								</div>
							</div>
						</td>
						<td>
							<input type="text" name="insurance_code" id="insurance_code" placeholder="" class="searchs form-control" required />
						</td>
						<td>
							<input type="text" name="insurance_hospital" id="insurance_hospital" placeholder="" class="searchs form-control" required />
						</td>
						<td>
							<input type="text" name="tax_code" id="tax_code" placeholder="" class="searchs form-control" required />
						</td>
						<td>
							<input type="text" name="bank_accout" id="bank_accout" placeholder="" class="searchs form-control" required />
						</td>
						<td>
							<input type="text" name="bank_name" id="bank_name" placeholder="" class="searchs form-control" required />
						</td>
						<td>
							<select class='combos' id='jobstatusid' name='jobstatusid'>
								<?php foreach($jobstatus as $item){?>
									<option value="<?=$item->id;?>"><?=$item->status_name;?></option>
								<?php }?>
							</select>
						</td>
						<td>
							<input type="text" name="family_name" id="family_name" placeholder="" class="searchs form-control" required />
						</td>
						<td>
							<input type="text" name="family_phone" id="family_phone" placeholder="" class="searchs form-control" required />
						</td>
						<td>
							<input type="text" name="family_relation" id="family_relation" placeholder="" class="searchs form-control" required />
						</td>
						<td>
						
						</td>
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
		searchFunction();
	});
	function searchFunction(){
		$("#code,#fullname,#identity,#place_of_birth,#academic_skills,#contrac_code,#insurance_code,#insurance_hospital,#tax_code,#bank_accout,#bank_name,#family_name,#family_phone,#family_relation").keyup(function() {
			searchList();	
		});
		$('#click_birthday').datepicker().on('changeDate', function (ev) {
			searchList();
		});
		$('#click_identity_date').datepicker().on('changeDate', function (ev) {
			searchList();
		});
		$('#click_date_start').datepicker().on('changeDate', function (ev) {
			searchList();
		});
		$('#click_contrac_date').datepicker().on('changeDate', function (ev) {
			searchList();
		});
		$('#click_contac_expired_date').datepicker().on('changeDate', function (ev) {
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
		$('#nationality').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-quoc-tich')?>',
			single: false,
			onClick: function(view){
				searchList();
			}
		});
		$('#group_work_id').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-to-nhom')?>',
			single: false,
			onClick: function(view){
				searchList();
			}
		});
		$('#identity_from').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-noi-cap')?>',
			single: false,
			onClick: function(view){
				searchList();
			}
		});
		
		$('#marriage').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-tinh-trang-hon-nhan')?>',
			single: false,
			onClick: function(view){
				searchList();
			}
		});
		$('#sex').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-gioi-tinh')?>',
			single: false,
			onClick: function(view){
				searchList();
			}
		});
		$('#departmentid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-phong-ban')?>',
			single: false,
			onClick: function(view){
				searchList();
			}
		});
		$('#positionid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-chuc-vu')?>',
			single: false,
			onClick: function(view){
				searchList();
			}
		});
		$('#jobstatusid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-tinh-trang-cong-viec')?>',
			single: false,
			onClick: function(view){
				searchList();
			}
		});
		$('#academic_level').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-trinh-do-hoc-van')?>',
			single: false,
			onClick: function(view){
				searchList();
			}
		}); 
		$('#ethnicid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-dan-toc')?>',
			single: false,
			onClick: function(view){
				searchList();
			}
		}); 
		$('#religionid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-ton-giao')?>',
			single: false,
			onClick: function(view){
				searchList();
			}
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