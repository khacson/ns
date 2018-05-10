<style title="" type="text/css">
	table col.c1 { width: 50px; }
	table col.c2 { width: 50px; }
	table col.c3 { width: 150px;}
	table col.c4 { width: 80px;}
	table col.c5 { width: 150px;}
	table col.c6 { width: 80px;}
	table col.c7 { width: 100px;}
	table col.c8 { width: 150px;}
	table col.c9 { width: 150px;}
	table col.c10 { width: 150px;}
	table col.c11 { width: 50px;}
	table col.c12 {width: auto;}
	.col-md-4{white-space: nowrap !important;}
	table col.cc20 { width: 20px;}
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
						<th id="ord_d.departmanet_name"><?=getLanguage('phong-ban')?></th>
						<th id="ord_e.code"><?=getLanguage('ma-nhan-vien')?></th>
						<th id="ord_e.fullname"><?=getLanguage('ho-ten')?></th>
						<th id="ord_e.sex"><?=getLanguage('gioi-tinh')?></th>
						<th id="ord_e.phone"><?=getLanguage('dien-thoai')?></th>
						<th id="ord_e.birthday"><?=getLanguage('ngay-sinh')?></th>
						<th id="ord_e.birthday"><?=getLanguage('sinh-nhat')?></th>
						
						<th id="ord_p.position_name"><?=getLanguage('chu-vu')?></th>
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
					<?php for($i=1; $i < 12; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<tr class="row-search">
						<td></td>
						<td></td>
						<td>
							<select id="departmentid" name="departmentid" class="combos">
								<?php foreach($departments as $item){?>
								<option value="<?=$item->id;?>"><?=$item->departmanet_name;?></option>
								<?php }?>
							</select>
						</td>
						<td>
							<input type="text" name="code" id="code" class="searchs form-control" required />
						</td>
						<td>
							<input type="text" name="fullname" id="fullname" class="searchs form-control" required />
						</td>
						<td>
							<select  id="sex" name="sex" class="combos" >
								<option  value="1"><?=getLanguage('nam');?></option>
								<option  value="2"><?=getLanguage('nu');?></option>
								<option  value="-1"><?=getLanguage('gioi-tinh-khac');?></option>
							</select>
						</td>
						<td>
							<input type="text" name="phone" id="phone" class="searchs form-control" required />
						</td>
						<td>
							<div id="click_date_reward" class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
								<input id="date_reward" name="date_reward" type="text" class="searchs form-control tab-event">
								<div class="input-group-addon">
									<i class="fa fa-calendar "></i>
								</div>
							</div>
						</td>
						<td>
							<select id="birthday" name="birthday" class="combos"> 
								<option></option>
								<?php foreach($month as $key=>$val){?>
									<option <?php if($montNow == $key){?> selected <?php }?> value="<?=$key;?>"><?=$val;?></option>
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
		$("#date_reward,#code,#fullname").keyup(function() {
			searchList();	
		});
		$('#click_birthday').datepicker().on('changeDate', function (ev) {
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
	function init(){
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
		$('#birthday').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-thang')?>',
			single: true,
			onClick: function(view){
				searchList();
			}
		}); 
		$('.searchs').val('');		
		$('#departmentid').multipleSelect('uncheckAll');
		$('#positionid').multipleSelect('uncheckAll');
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
		$('#departmentid,#positionid,#birthday').multipleSelect('uncheckAll');
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