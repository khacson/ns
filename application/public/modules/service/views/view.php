<style title="" type="text/css">
	table col.c1 { width: 45px; }
	table col.c2 { width: 60px; }
	table col.c3 { width: 180px; }
	table col.c4 { width: 150px; }
	table col.c5 { width: 180px; }
	table col.c6 { width: 180px; }
	table col.c7 { width: 180px; }
	table col.c8 { width: auto; }
	.control-label.col-md-4 {
		white-space: nowrap;
	}
</style>
<!-- BEGIN PORTLET-->
<!-- TABLE: LATEST ORDERS -->
<div class="box box-info">
	<div class="box-header with-border">
	  <div class="box-title">
		<?=$this->load->inc('breadcrumb');?>  
	  </div>
	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		</button>
	  </div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		    <div class="row mtop10">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4">Customer name(<span class="red">*</span>)</label>
						<div class="col-md-8">
							<input type="text" name="customer_name" placeholder="Input customer name" id="customer_name" class="searchs form-control" />
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4">Phone</label>
						<div class="col-md-8">
							<input type="text" name="customer_phone" placeholder="Input phone" id="customer_phone" class="searchs form-control" />
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4">Email</label>
						<div class="col-md-8">
							<input type="text" name="customer_email" placeholder="Input email" id="customer_email" class="searchs form-control" />
						</div>
					</div>
				</div> 
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4">Address</label>
						<div class="col-md-8" >
							<input type="text" name="customer_address" placeholder="Input address" id="customer_address" class="searchs form-control" />
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label col-md-4">User Contact</label>
						<div class="col-md-8" >
							<input type="text" name="customer_contact" placeholder="Input user contact" id="customer_contact" class="searchs form-control" />
						</div>
					</div>
				</div>
			</div><!--E Row-->
	  <!-- /.table-responsive -->
	</div>
</div>
<!-- /.box -->
<div class="box box-default">
	<div class="box-header with-border">
	  <h3 class="box-title">
		  <i>Show <span class='viewtotal'>0</span> results</i>
	  </h3>
	  <div class="box-tools pull-right">
			 <!--S btn-->
		  <input type="hidden" name="id" id="id" />
		 <ul class="button-group pull-right">
			<li id="search">
				<button type="button" class="button">
					<i class="fa fa-search"></i> Search
				</button>
			</li>
			<li id="refresh">
				<button type="button" class="button">
					<i class="fa fa-refresh"></i> Refresh
				</button>
			</li>
			<?php if(isset($permission['add'])){?>
			<li id="save">
				<button type="button" class="button">
					<i class="fa fa-save"></i> Save
				</button>
			</li>
			<?php }?>
			<?php if(isset($permission['edit'])){?>
			<li id="edit">
				<button type="button" class="button">
					<i class="fa fa-save"></i> Edit
				</button>
			</li>
			<?php }?>
			<?php if(isset($permission['delete'])){?>
			<li id="deletes">
				<button type="button" class="button">
					<i class="fa fa-times"></i> Delete
				</button>
			</li>
			<?php }?>	
		 </ul>
		  <!--E btn-->
	  </div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		  <!--S Content-->
		  <div id="gridview" >
				<table class="resultset" id="grid"></table>
				<!--header-->
				<div id="cHeader">
					<div id="tHeader">    	
						<table width="100%" cellspacing="0" border="1" id="tb<?=$routes;?>" >
							<?php for($i=1; $i< 9; $i++){?>
								<col class="c<?=$i;?>">
							<?php }?>
							<tr>
								<th width="40px" class="text-center"><input type="checkbox" name="checkAll" id="checkAll" /></th>
								<th>No.</th>
								<th id="ord_c.customer_name">Customer name</th>
								<th id="ord_c.customer_phone">Phone</th> 
								<th id="ord_c.customer_email">Email</th>
								<th id="ord_c.customer_address">Address</th> 								
								<th id="ord_c.customer_contact">User Contact</th> 
								<th></th>
							</tr>
						</table>
					</div>
				</div>
				<!--end header-->
				<!--body-->
				<div id="data">
					<div id="gridView">
						<table  width="100%" cellspacing="0" border="1">
							<?php for($i=1; $i< 9; $i++){?>
								<col class="c<?=$i;?>">
							<?php }?>
							<tbody id="grid-rows"></tbody>
						</table>
					</div>
				</div>
				<!--end body-->
            </div> 
		  <!--E Content-->
	</div>
	<!-- /.box-body -->
	<div class="box-footer no-padding">
	   <div class="portlet-body mtopa20" id="paging"></div>
	</div>
	<!-- /.footer -->
  </div>
  <!-- /.box -->
<!-- END PORTLET-->
<div class="loading" style="display: none;">
	<div class="blockUI blockOverlay" style="width: 100%;height: 100%;top:0px;left:0px;position: absolute;background-color: rgb(0,0,0);opacity: 0.1;z-index: 1000;">
	</div>
	<div class="blockUI blockMsg blockElement" style="width: 30%;position: absolute;top: 15%;left:35%;text-align: center;">
		<img src="<?=url_tmpl()?>img/ajax_loader.gif" style="z-index: 2;position: absolute;"/>
	</div>
</div> 
<script>
	var controller = '<?=base_url().$routes;?>/';
	var csrfHash = '<?=$csrfHash;?>';
	var table;
	var cpage = 0;
	var search;
	var currId = 0;
	var inProgress = false;
	var routes = '<?=$routes;?>';
	$(function(){
		refresh();
		$("#refresh").click(function(){
			$(".loading").show();
			refresh();
		});
		$("#export").click(function() {
                exportdata();
            });
		
		$("#search").click(function(){
			$(".loading").show();
			searchList();	
		});
		$("#save").click(function(){
			search = getSearch();
			var obj = $.evalJSON(search); 
			var token = $("#token").val();
			var id = $("#id").val();
			if(obj.customer_name == ""){
				warning("Customer name can not be empty"); 
				$("#customer_name").focus();
				return false;		
			}
			var data = new FormData();
			//var objectfile = document.getElementById('imageEnable').files;
			//data.append('userfile', objectfile[0]);
			data.append('csrf_stock_name', token);
			data.append('search', search);
			data.append('id','');
			$.ajax({
				url : controller + 'save',
				type: 'POST',
				async: false,
				data:data,
				enctype: 'multipart/form-data',
				processData: false,  
				contentType: false,   
				success:function(datas){
					var obj = $.evalJSON(datas); 
					$("#token").val(obj.csrfHash);
					if(obj.status == 0){
						error("Add failed "); return false;	
					}
					else{
						success("Add successfull"); 
						refresh();
					}
				},
				error : function(){
					error("Add failed "); return false;	
				}
			});
		});
		$("#edit").click(function(){
			search = getSearch();
			var obj = $.evalJSON(search); 
			var token = $("#token").val();
			var id = $("#id").val();
			if(obj.customer_name == ""){
				warning("Customer name can not be empty"); 
				$("#customer_name").focus();
				return false;		
			}
			var data = new FormData();
			//var objectfile = document.getElementById('imageEnable').files;
			//data.append('userfile', objectfile[0]);
			data.append('csrf_stock_name', token); 
			data.append('search', search);
			data.append('id',id);
			$.ajax({
				url : controller + 'edit',
				type: 'POST',
				async: false,
				data:data,
				enctype: 'multipart/form-data',
				processData: false,  
				contentType: false,   
				success:function(datas){
					var obj = $.evalJSON(datas); 
					$("#token").val(obj.csrfHash);
					if(obj.status == 0){
						error("Edit failed "); return false;	
					}
					else{
						success("Edit successfull"); 
						refresh();
					}
				},
				error : function(){
					error("Edit failed "); return false;	
				}
			});
		});
		$("#deletes").click(function(){  
			var id = getCheckedId(); 
			if(id == ''){ return false;}
			$.msgBox({
				title: "Message",
				type: "error",
				content:"Do you want delete customer?",
				buttons: [{value: 'OK'},{ value: 'Cancel'}],
				success: function(result) { 
					if (result == 'OK') {
						var token = $("#token").val();
						$.ajax({
							url : controller + 'deletes',
							type: 'POST',
							async: false,
							data: {csrf_stock_name:token,id:id},
							success:function(datas){
								var obj = $.evalJSON(datas); 
								$("#token").val(obj.csrfHash);
								if(obj.status == 0){
									error("Delete failed");  return false;		
								}
								else{
									success("Delete successfull"); 
									refresh();	
								}
								
							},
							error : function(){
								error("Delete failed");  return false;	
							}
						});
					}
				}
			});
		});
		
	});
    function funcList(obj){
		$(".edit").unbind();
			$(document.body).on('click', '.edit', function (){ 
				var index = $('.edit').index($(this));

				var customer_name = $('.customer_name').eq(index).html();
				var customer_phone = $('.customer_phone').eq(index).html();
				var customer_email = $('.customer_email').eq(index).html();
				var customer_address = $('.customer_address').eq(index).html();
				var customer_contact = $('.customer_contact').eq(index).html();			
			
				var id = $(this).attr('id');
				$("#id").val(id);	
				$("#customer_name").val(customer_name);	
				$("#customer_phone").val(customer_phone);	
				$("#customer_email").val(customer_email);	
				$("#customer_address").val(customer_address);
				$("#customer_contact").val(customer_contact);

		});	
	}
	function refresh(){
		$(".loading").show();
		$(".searchs").val("");
		$('#show').html('');
		//$('#gender,#activate,#groupid').multipleSelect('uncheckAll');
		csrfHash = $('#token').val();
		search = getSearch();//alert(cpage);
		getList(cpage,csrfHash,routes);	
	}
	function searchList(){
		search = getSearch();//alert(cpage);exit;
		csrfHash = $('#token').val();
		getList(0,csrfHash,routes);	
	}
	function getSearch(){
		 var obj = {};
		$('.searchs').each(function(i) {
			var id = $(this).attr('id');
			var val = $(this).val();
			val = val.replace(/['"]/g, '');
			obj[id] = val; 
		});
		var str = JSON.stringify(obj) ; 
		return str; 
	}
</script>
