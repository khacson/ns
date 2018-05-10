
<div class="box ">
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
						<label class="control-label col-md-4"><?=getLanguage('ma-nhan-vien')?></label>
						<div class="col-md-8">
							<input value="<?=$code;?>" type="text" name="code" id="code" placeholder="<?=$code;?>" class="search form-control"/>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('cmnd')?></label>
							<div class="col-md-8">
								<input type="text" name="identity" id="identity" placeholder="" class="search form-control" required value="<?=$finds->identity;?>" />
							</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4"><?=getLanguage('dien-thoai')?></label>
							<div class="col-md-8">
								<input type="text" name="phone" id="phone" placeholder="" class="search form-control" required value="<?=$finds->phone;?>" />
							</div>
					</div>
				</div>
			</div>
			<div class="row mtop10">
				<div class="col-md-4">
					
				</div>
				<div class="col-md-8">
					<div class="mright10" >
						<input type="hidden" id="token" name="<?=$csrfName;?>" value="<?=$csrfHash;?>" />
						<ul class="button-group pull-right" style="margin-right:15px;">
							<li id="search">
								<button class="button">
									<i class="fa fa-search"></i>
									<?=getLanguage('tim-kiem')?>
								</button>
							</li>
							<li id="refresh" >
								<button class="button">
									<i class="fa fa-refresh"></i>
									<?=getLanguage('lam-moi')?>
								</button>
							</li>
							<?php if(isset($permission['add'])){?>
							<li id="save">
								<button class="button">
									<i class="fa fa-plus"></i>
									<?=getLanguage('them-moi')?>
								</button>
							</li>
							<?php } ?>
							<?php if(isset($permission['edit'])){?>
							<li id="edit">
								<button class="button">
									<i class="fa fa-save"></i>
									<?=getLanguage('sua')?>
								</button>
							</li>
							<?php } ?>
							<li id="print">
								<button class="button">
									<i class="fa fa-print"></i>
									<?=getLanguage('in-ho-so')?>
								</button>
							</li>
						</ul>
					</div>		
				</div>
			</div>
		</div>
</div>
<span id="grid-rows"></span>
<script type="text/javascript">
	var controller = '<?=base_url().$routes;?>/';
	var csrfHash = '<?=$csrfHash;?>';
	var cpage = 0;
	var search;
	var code = '<?=$code;?>'; 
	$(function(){
		searchList();
		$('#search').click(function(){
			$(".loading").show();
			searchList();	
		});
		$('#refresh').click(function(){
			$('.loading').show();
			refresh();
		});
		$('#save').click(function(){
			save('save','');
		});
		$('#edit').click(function(){
			var employeeid = $("#employeeid").val();
			if(employeeid == ''){
				error('Vui lòng chọn nhân viên cần sửa.'); return false;	
			}
			save('edit',employeeid);
		});
	});
	function refresh(){
		$('.loading').show();
		$('.searchs').val('');	
		$('.search').val('');				
		csrfHash = $('#token').val();
		$('.select2me').select2("val", "");
		//window.history.pushState('obj', 'newtitle', '/abc');
		window.location = '<?=base_url();?>employeefile.html';
		search = getSearchs();
		searchList(cpage,csrfHash);	
	}
	function searchList(page,csrfHash){
		search = getSearchs();
		csrfHash = $('#token').val();
		
		$.ajax({
		  url:controller+'getList',
		  async: false,
		  type: 'POST',
		  data:{search:search, code:code},
		  success:function(datas) {
			 var obj = $.evalJSON(datas);  
			 if(obj.status == 0){
				warning('<?=getLanguage('khong-tim-thay-nhan-vien-trong-he-thong');?>');
			 }
			 $('#paging').html(obj.paging);
			 $('#grid-rows').html(obj.content);
			 $("#token").val(obj.csrfHash);
			 var total = obj.viewtotal;
			 $(".viewtotal").html(total);
			 $(".loading").hide();
			 paging(obj.csrfHash);
			 if(typeof(func_get)=='function'){
				func_get(obj);
			 }
			 if(typeof(funcList)=='function'){
				  funcList(obj);
			 }
		  }
	});
	}
	function getSearchs(){
		var str = '';
		$('input.search').each(function(){
			str += ',"'+ $(this).attr('id') +'":"'+ $(this).val().trim() +'"';
		})
		return '{'+ str.substr(1) +'}';
	}
	function funcList(obj){
		
	}
</script>
