<style title="" type="text/css">
	table col.c1 { width: 45px; }
	table col.c2 { width: 45px; }
	table col.c3 { width: 180px; }
	table col.c4 { width: 100px; }
	table col.c5 { width: auto;}
</style>
<link href="<?=url_tmpl();?>css/jquery-ui.css" rel="stylesheet" type="text/css"/>
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
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('sa-den-han-ky-hd');?></label>
					<div class="col-md-8">
						<input type="text" name="sapdenhankyhd" placeholder="<?=getLanguage('nhap-thang');?>" id="sapdenhankyhd" value="<?=$finds->sapdenhankyhd;?>" class="searchs form-control " />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('dinh-dang-ngay-thang');?> </label>
					<div class="col-md-8">
						<select id="cfdate" name = "cfdate" class="form-control select2me" data-placeholder="<?=getLanguage('chon-dinh-dang')?>">
							<option value=""></option>
							<option <?php if($finds->cfdate == 'd-m-Y'){?> selected <?php }?> value="d-m-Y">dd-mm-YYYY (01-09-<?=gmdate("Y",time() + 7 * 3600);?>)</option>
							<option  <?php if($finds->cfdate == 'd/m/Y'){?> selected <?php }?>  value="d/m/Y">dd/mm/YYYY (01/09/<?=gmdate("Y",time() + 7 * 3600);?>)</option>
							<option  <?php if($finds->cfdate == 'd M Y'){?> selected <?php }?> value="d M Y">dd MM YYYY (01 Sep <?=gmdate("Y",time() + 7 * 3600);?>)</option>
							<option <?php if($finds->cfdate == 'm-d-Y'){?> selected <?php }?> value="m-d-Y">mm-dd-YYYY (09-01-<?=gmdate("Y",time() + 7 * 3600);?>)</option>
							<option <?php if($finds->cfdate == 'm/d/Y'){?> selected <?php }?> value="m/d/Y">mm/dd/YYYY (09/01/<?=gmdate("Y",time() + 7 * 3600);?>)</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('lam-thu-7');?></label>
					<div class="col-md-8">
						<select id="lamthu7" name = "lamthu7" class="form-control select2me" data-placeholder="<?=getLanguage('chon-lam-thu-7')?>">
							<option value=""></option>
							<option value="1" <?php if($finds->lamthu7 == 1){?> selected <?php }?> value="1"><?=getLanguage('lam-ca-ngay');?></option>
							<option value="0.5" <?php if($finds->lamthu7 == 0.5){?> selected <?php }?>><?=getLanguage('lam-mot-buoi');?></option>
						</select>	
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-4"><?=getLanguage('di-tre-ve-som');?></label>
					<div class="col-md-8">
						<select id="lamthu7" name = "lamthu7" class="form-control select2me" data-placeholder="<?=getLanguage('chon-tran-thai')?>">
							<option value=""></option>
							<option value="1" <?php if($finds->truphep == 1){?> selected <?php }?> value="1"><?=getLanguage('tru-ngay-phep');?></option>
							<option  value="2" <?php if($finds->truphep == 2){?> selected <?php }?>><?=getLanguage('tru-ngay-cong');?></option>
							<option  value="3" <?php if($finds->truphep == 3){?> selected <?php }?>><?=getLanguage('khong-tru');?></option>
						</select>	
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<div class="col-md-12">
						<ul style="margin:0px; float:right;" class="button-group">
							<li class=""><button id="edit" type="button" class="btnone"><i class="fa fa-save"></i> <?=getLanguage('update');?></button></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10"></div>
	</div>
</div>
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
		handleSelect2();
		init();
		//refresh();
		$("#search").click(function(){
			$(".loading").show();
			searchList();	
		});
		$("#refresh").click(function(){
			$(".loading").show();
			refresh();
		});
		$("#edit").click(function(){
			save();
		});
	});
	function save(){
		func = 'edit';
		var id = '<?=$finds->id;?>';
		var search = getSearch();
			var obj = $.evalJSON(search); 
			$('.loading').show();
			var data = new FormData();
			//data.append('csrf_stock_name', token);
			data.append('search', search);
			data.append('id',id);
			$.ajax({
				url : controller + func,
				type: 'POST',
				async: false,
				data:{id:id,search:search},
				//enctype: 'multipart/form-data',
				//processData: false,  
				//contentType: false,   
				success:function(datas){
					var obj = $.evalJSON(datas); 
					$("#token").val(obj.csrfHash);
					$('.loading').hide();
					if(obj.status == 0){
						error(sktc); return false;	
					}
					else{
						success(stc); 
					}
				},
				error : function(){
					$('.loading').hide();
					error(sktc); return false;	
				}
			});
	}
	function init(){
		
	}
	function funcList(obj){
		
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
