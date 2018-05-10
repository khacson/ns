<style title="" type="text/css">
	table col.c1 { width: 45px; }
	table col.c2 { width: 45px; }
	table col.c3 { width: 180px; }
	table col.c4 { width: 180px; }
	table col.c5 { width: 100px; }
	table col.c6 { width: 100px; }
	table col.c7 { width: 100px; }
	table col.c8 { width: 100px; }
	table col.c9 { width: 100px; }
	table col.c10 { width: 100px; }
	table col.c11 { width: 100px; }
	table col.c12 { width: auto;}
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
					<label class="control-label col-md-4"><?=getLanguage('ten-cong-ty');?> (<span class="red">*</span>)</label>
					<div class="col-md-8">
						<input type="text" name="company_name" placeholder="<?=getLanguage('nhap-ten-cong-ty');?>" id="company_name" class="searchs form-control tab-event" />
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('dia-chi');?></label>
					<div class="col-md-8">
						<input type="text" name="address" placeholder="<?=getLanguage('nhap-dia-chi');?>" id="address" class="searchs form-control tab-event" />
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
					<label class="control-label col-md-4"><?=getLanguage('fax');?></label>
					<div class="col-md-8">
						<input type="text" name="fax" placeholder="<?=getLanguage('nhap-fax');?>" id="fax" class="searchs form-control tab-event" />
					</div>
				</div>
			</div>
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
					<label class="control-label col-md-4"><?=getLanguage('mst');?></label>
					<div class="col-md-8">
						<input type="text" name="mst" placeholder="<?=getLanguage('nhap-mst');?>" id="mst" class="searchs form-control tab-event" />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('ngay-bat-dau');?></label>
					<div class="col-md-8">
						<div class="input-group date" data-provide="datepicker">
							<input id="datestart" name="datestart" type="text" class="searchs form-control tab-event" placeholder="<?=getLanguage('chon-ngay');?>">
							<div class="input-group-addon">
								<i class="fa fa-calendar "></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('ngay-ket-thuc');?></label>
					<div class="col-md-8">
						<div class="input-group date" data-provide="datepicker">
							<input id="dateend" name="dateend" type="text" class="searchs form-control tab-event" placeholder="<?=getLanguage('chon-ngay');?>">
							<div class="input-group-addon">
								<i class="fa fa-calendar "></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('logo');?></label>
					<div class="col-md-8">
						<div class="col-md-6" style="padding:0 5px !important;" >
							<ul style="margin:0px;" class="button-group">
								<li class="" onclick ="javascript:document.getElementById('profileAvatar').click();"><button type="button" class="btnone"><?=getLanguage('chon-file');?></button></li>
							</ul>
							<input style='display:none;' accept="image/*" id ="profileAvatar" type="file" name="avatar">
						</div>
						<div class="col-md-6" >
							 <span id="showavatar"></span> 
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4" style="padding-left:0;">
					
			</div>
		</div>
		<div class="row mtop10"></div>
	</div>
</div>
<div class="box">
	<div class="box-header with-border">
	  <div class="brc"><?=getLanguage('tim-thay');?> <span class="semi-bold viewtotal">0</span> <?=getLanguage('ket-qua');?></div>

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
				<?php if(isset($permission['add']) && empty($companyid)){?>
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
				<?php if(isset($permission['delete']) && empty($companyid)){?>
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
						<th><?=getLanguage('ten-cong-ty');?></th>
						<th><?=getLanguage('dia-chi');?></th>
						<th><?=getLanguage('dien-thoai');?></th>
						<th><?=getLanguage('fax');?></th>
						<th><?=getLanguage('email');?></th>
						<th><?=getLanguage('mst');?></th>
						<th><?=getLanguage('ngay-bat-dau');?></th>
						<th><?=getLanguage('ngay-ket-thuc');?></th>
						<th><?=getLanguage('logo');?></th>
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
		$("#save").click(function(){
			save('','save');
		});
		$("#edit").click(function(){
			var id = $('#id').val();
			if(id == ''){
				warning('Chọn nhà sản xuất cần sửa');
				return false;
			} 
			save(id,'edit');
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
	function save(id,func){
		var search = getSearch();
			var obj = $.evalJSON(search); 
			if(obj.manufacture_name == ""){
				warning("Nhà sản xuất không được trống"); 
				$("#manufacture_name").focus();
				return false;		
			}
			$('.loading').show();
			var data = new FormData();
			var objectfile2 = document.getElementById('profileAvatar').files;
			data.append('avatarfile', objectfile2[0]);
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
					$("#token").val(obj.csrfHash);
					$('.loading').hide();
					if(obj.status == 0){
						if(id == ''){
							error("Thêm mới không thành công"); return false;	
						}
						else{
							error("Sửa không thành công"); return false;	
						}
					}
					else if(obj.status == -1){
						error("Nhà sản xuất đã tồn tại"); return false;		
					}
					else{
						if(id == ''){
							success("Thêm mới thành công"); 
						}
						else{
							success("Sửa thành công"); 
						}
						refresh();
					}
				},
				error : function(){
					$('.loading').hide();
					if(id == ''){
						error("Thêm mới không thành công"); return false;	
					}
					else{
						error("Sửa không thành công"); return false;	
					}
				}
			});
	}
	function init(){
		$('#profileAvatar').change(function(evt) {
            var files = evt.target.files;
            for (var i = 0, f; f = files[i]; i++){
                var size = f.size;
                if (size < 2048000){
                    if (!f.type.match('image.*'))
                    {
                        continue;
                    }
                    var reader = new FileReader();
                    reader.onload = (function(theFile) {
                        return function(e) { //size e = e.tatal
                            $('#showavatar').html('<img src="' + e.target.result + '" style="width:60px; height:40px" />');
                            $("#img1").val(e.target.result);
                        };
                    })(f);
                    reader.readAsDataURL(f);
                }
                else{
                    $("#fileupload").val("");
                    $('.showImages').attr('src', "");
                    // alert("File size can't over 2Mb.");
					toastr.error("File size can't over 2Mb.", messageError, {closeButton:true, timeOut:5000});
                }
            }
        });
	}
	function funcList(obj){
		$(".edit").each(function(e){
			$(this).click(function(){ 
				var company_name = $(".company_name").eq(e).text().trim();
				var address = $(".address").eq(e).text().trim();
				var phone = $(".phone").eq(e).text().trim();
				var fax = $(".fax").eq(e).text().trim();
				var email = $(".email").eq(e).text().trim();
				var mst = $(".mst").eq(e).text().trim();
				
				var id = $(this).attr('id');
				var datestart = $(this).attr('datestart');
				var dateend = $(this).attr('dateend');
				$("#id").val(id);	
				$("#company_name").val(company_name);	
				$("#address").val(address);	
				$("#phone").val(phone);	
				$("#fax").val(fax);	
				$("#email").val(email);	
				$("#mst").val(mst);	
				$("#datestart").val(datestart);	
				$("#dateend").val(dateend);	
			});
		});	
	}
	function refresh(){
		$(".loading").show();
		$(".searchs").val("");
		$('#activate,#processid,#groupid').multipleSelect('uncheckAll');
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