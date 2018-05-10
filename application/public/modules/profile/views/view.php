<style title="" type="text/css">
	table col.c1 { width: 45px; }
	table col.c2 { width: 45px; }
	table col.c3 { width: 150px;}
	table col.c4 { width: 200px; }
	table col.c5 { width: 250px; }
	table col.c6 {  width: auto;}
</style>
<link href="<?=url_tmpl();?>css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<div class="box">
	<div class="box-header with-border">
	  <h3 class="box-title">Thông tin hồ sơ</h3>
	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Đóng">
		  <i class="fa fa-minus"></i></button>
		<!--<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
		  <i class="fa fa-times"></i></button>-->
	  </div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Tài khoản</label>
					<div class="col-md-9">
						<input readonly type="text" name="username" id="username" placeholder="" value="<?=$find->username;?>" class="form-control" />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Họ tên</label>
					<div class="col-md-9">
						<input type="text" name="hellologin" id="fullname" placeholder="" value="<?=$find->fullname;?>" class="searchs form-control" />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Điện thoại</label>
					<div class="col-md-9">
						<input type="text" name="phone" id="phone" placeholder="" value="<?=$find->phone;?>" class="searchs form-control" />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Email</label>
					<div class="col-md-9">
						<input type="text" name="email" id="email" placeholder="" value="<?=$find->email;?>" class="searchs form-control" />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Mật khẩu</label>
					<div class="col-md-9">
						<input type="password" name="password" id="password" placeholder="" value="" class="searchs form-control" />
					</div>
				</div>
			</div>
		</div>
		<div class="row mtop10">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Hình đại diện</label>
					<div class="col-md-9">
						 <div class="col-md-3" style="padding:0px !important;" >
							<ul style="margin:0px;" class="button-group">
								<li class="" onclick ="javascript:document.getElementById('imageEnable').click();"><button type="button" class="btnone">Chọn file</button></li>
							</ul>
							<input style='display:none;' accept="image/*" id ="imageEnable" type="file" name="userfile">
						</div>
						<div class="col-md-6" >
							 <span id="show">
								  <img src="<?=base_url();?>files/user/<?=$find->avatar;?>" style="width:80px; height:50px" />
							 </span> 
						</div>
					</div>
				</div>
			</div>
		</div>
	    <div class="row mtop10">	
			<div class="col-md-6" style="padding-left:0;">
				<ul class="button-group pull-right btnpermission">
					<?php if(isset($permission['edit'])){?>
					<li id="edit">
						<button class="button">
							<i class="fa fa-save"></i>
							Sửa
						</button>
					</li>
					<?php }?>
				</ul>	
			</div>
			<div class="col-md-6"></div>
		</div>
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
		init();	
		$('#imageEnable').change(function(evt) {
            var files = evt.target.files;
            for (var i = 0, f; f = files[i]; i++){
                var size = f.size;
                if (size < 2048000){
                    if (!f.type.match('image.*')){
                        continue;
                    }
                    var reader = new FileReader();
                    reader.onload = (function(theFile) {
                        return function(e) { //size e = e.tatal
                            $('#show').html('<img src="'+e.target.result+'" style="width:80px; height:50px" />');
                            //$("#img1").val(e.target.result);
                        };
                    })(f);
                    reader.readAsDataURL(f);
                }
                else{
                    error('Dung lượng tối đa 2MB');
                }
            }
        });
		$("#search").click(function(){
			$(".loading").show();
			searchList();	
		});
		$("#refresh").click(function(){
			$(".loading").show();
			refresh();
		});
		$("#edit").click(function(){
			var id = '<?=$find->id;?>';
			save(id,'save');
		});
	});
	function save(id,func){
		var search = getSearch();
			var obj = $.evalJSON(search); 
			$('.loading').show();
			var data = new FormData();
			var objectfile = document.getElementById('imageEnable').files;
			data.append('userfile', objectfile[0]);
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
						error("Sửa không thành công"); return false;	
					}
					else{
						success("Sửa thành công");
					}
				},
				error : function(){
					$('.loading').hide();
					error("Sửa không thành công"); return false;	
				}
			});
	}
	function init(){
		/*$("#customerid").multipleSelect({
			filter: true,
			placeholder:'Chọn khách hàng',
			single: true
		});*/
	}
	function refresh(){
		$(".loading").show();
		$(".searchs").val("");
		//$('#customerid').multipleSelect('uncheckAll');
		csrfHash = $('#token').val();
		search = getSearch();
		getList(cpage,csrfHash);	
	}
</script>
<script src="<?=url_tmpl();?>js/right.js" type="text/javascript"></script>