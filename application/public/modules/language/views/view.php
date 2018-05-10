<style title="" type="text/css">
	table col.c1 { width: 45px; }
	table col.c2 { width: 45px; }
	table col.c3 { width: 100px; }
	table col.c4 { width: 180px; }
	table col.c5 { width: 120px; }
	table col.c6 { width: auto;}
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
					<label class="control-label col-md-4"><?=getLanguage('tu-khoa');?></label>
					<div class="col-md-8">
						<input type="text" name="langkey" placeholder="<?=getLanguage('nhap-tu-khoa');?>" id="langkey" class="searchs form-control tab-event" />
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('ngon-ngu');?> (<span class="red">*</span>)</label>
					<div class="col-md-8">
						<input type="text" name="langname" placeholder="<?=getLanguage('nhap-ngon-ngu');?>" id="langname" class="searchs form-control tab-event" />
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label col-md-5"><?=getLanguage('icon');?></label>
					<div class="col-md-7">
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
		 <!--header-->
		 <div id="cHeader">
			<div id="tHeader">    	
				<table width="100%" cellspacing="0" border="1" class="table ">
					<?php for($i=1; $i< 7; $i++){?>
						<col class="c<?=$i;?>">
					<?php }?>
					<tr>
						<th><input type="checkbox" id="checkAll" autocomplete="off" /></th>
						<th><?=getLanguage('stt');?></th>
						<th><?=getLanguage('tu-khoa');?></th>
						<th><?=getLanguage('ngon-ngu');?></th>
						<th><?=getLanguage('icon');?></th>
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
					<?php for($i=1; $i< 7; $i++){?>
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
				warning(cldcs);
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
			if(obj.langkey == ""){
				warning('<?=getLanguage('tu-khoa-khong-duoc-trong');?>'); 
				$("#langkey").focus();
				return false;		
			}
			if(obj.langname == ""){
				warning('<?=getLanguage('ngon-ngu-khong-duoc-trong');?>'); 
				$("#langname").focus();
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
				var langname = $(".langname").eq(e).text().trim();
				/*var grouptype = parseInt($(this).attr('grouptype'));
				var approved = $(this).attr('approved');
				var position = $(this).attr('position');*/
				var id = $(this).attr('id');
				$("#id").val(id);	
				$("#langname").val(langname);	
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