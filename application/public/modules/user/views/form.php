<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('tai-khoan');?> (<span class="red">*</span>)</label>
			<div class="col-md-7">
				<input type="text" name="input_username" placeholder="<?=getLanguage('nhap-tai-khoan');?>" id="input_username" class="form-input form-control input-tab" value="<?=$finds->username;?>" />
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('ho-ten');?> (<span class="red">*</span>)</label>
			<div class="col-md-7">
				<input type="text" name="input_fullname" placeholder="<?=getLanguage('nhap-ho-ten');?>" id="input_fullname" class="form-input form-control input-tab" value="<?=$finds->fullname;?>"  />
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 mtop10">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('mat-khau');?> (<span class="red">*</span>)</label>
			<div class="col-md-7">
				<input type="password" name="input_password" placeholder="<?=getLanguage('nhap-mat-khau');?>" id="input_password" class="form-input form-control input-tab" />
			</div>
		</div>
	</div>
	<div class="col-md-6 mtop10">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('xac-nhan-mat-khau');?> (<span class="red">*</span>)</label>
			<div class="col-md-7">
				<input type="password" name="input_cfpassword" placeholder="<?=getLanguage('nhap-mat-khau');?>" id="input_cfpassword" class="form-input form-control input-tab" />
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 mtop10">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('dien-thoai');?></label>
			<div class="col-md-7">
				<input type="text" name="input_phone" placeholder="<?=getLanguage('nhap-dien-thoai');?>" id="input_phone" class="form-input form-control input-tab" value="<?=$finds->phone;?>" />
			</div>
		</div>
	</div>
	<div class="col-md-6 mtop10">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('email');?></label>
			<div class="col-md-7">
				<input type="text" name="input_email" placeholder="<?=getLanguage('nhap-email');?>" id="input_email" class="form-input form-control input-tab" value="<?=$finds->email;?>"/>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 mtop10">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('nhom-quyen');?> (<span class="red">*</span>)</label>
			<div class="col-md-7" >
				<select name="input_groupid" id="input_groupid" class="form-input select2me form-control " data-placeholder="<?=getLanguage('chon-nhom-quyen')?>">
					<option value=""></option>
					<?php foreach ($groups as $item) { ?>
						<option <?php if($finds->groupid == $item->id){?>  selected <?php }?> value="<?=$item->id;?>"><?=$item->groupname?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-6 mtop10">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('chi-nhanh');?> (<span class="red">*</span>)</label>
			<div class="col-md-7" >
				<select name="input_branchid" id="input_branchid" class="form-input select2me form-control " data-placeholder="<?=getLanguage('chon-chi-nhanh')?>">
					<option value=""></option>
					<?php foreach ($branchs as $item) { ?>
						<option <?php if($finds->branchid == $item->id){?>  selected <?php }?> value="<?=$item->id;?>"><?=$item->branch_name?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 mtop10">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('bo-phan')?></label>
			<div class="col-md-7">
				<select id="input_departmentid" name="input_departmentid" class="form-input select2me form-control " data-placeholder="<?=getLanguage('chon-bo-phan')?>">
					<option value=""></option>
					<?php foreach($departments as $item){?>
					<option <?php if($finds->departmentid == $item->id){?>  selected <?php }?> value="<?=$item->id;?>"><?=$item->departmanet_name;?></option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-6 mtop10">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('trang-thai');?> (<span class="red">*</span>)</label>
			<div class="col-md-7" >
				<select name="input_activate" id="input_activate" class="form-input select2me form-control " data-placeholder="<?=getLanguage('chon-trang-thai')?>">
					<option <?php if($finds->activate == 1){?>  selected <?php }?> value="1"><?=getLanguage('kich-hoat');?></option>
					<option <?php if($finds->activate == 0){?>  selected <?php }?> value="0"><?=getLanguage('vo-hieu');?></option>
				</select>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 mtop10">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('duyet-nghi-phep');?> </label>
			<div class="col-md-7" >
				<select name="input_approved_leave" id="input_approved_leave" class="form-input select2me form-control " data-placeholder="<?=getLanguage('chon-trang-thai')?>">
					<option <?php if($finds->approved_leave == 1){?>  selected <?php }?> value="1"><?=getLanguage('duoc-duyet');?></option>
					<option <?php if($finds->approved_leave == 0){?>  selected <?php }?> value="0"><?=getLanguage('khong-duoc-duyet');?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-6 mtop10">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('duyet-tang-ca');?> </label>
			<div class="col-md-7" >
				<select name="input_approved_overtime" id="input_approved_overtime" class="form-input select2me form-control " data-placeholder="<?=getLanguage('chon-trang-thai')?>">
					<option <?php if($finds->approved_overtime == 1){?>  selected <?php }?> value="1"><?=getLanguage('duoc-duyet');?></option>
					<option <?php if($finds->approved_overtime == 0){?>  selected <?php }?> value="0"><?=getLanguage('khong-duoc-duyet');?></option>
				</select>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 mtop10">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('duyet-tuyen-dung');?> </label>
			<div class="col-md-7" >
				<select name="input_approved_recruitment" id="input_approved_recruitment" class="form-input select2me form-control " data-placeholder="<?=getLanguage('chon-trang-thai')?>">
					<option <?php if($finds->approved_recruitment == 1){?>  selected <?php }?> value="1"><?=getLanguage('duoc-duyet');?></option>
					<option <?php if($finds->approved_recruitment == 0){?>  selected <?php }?> value="0"><?=getLanguage('khong-duoc-duyet');?></option>
				</select>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 mtop10">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('hinh-dai-dien');?></label>
			<div class="col-md-7">
				<div class="col-md-6" style="padding:0 5px !important;" >
					<ul style="margin:0px;" class="button-group">
						<li class="" onclick ="javascript:document.getElementById('profileAvatar').click();"><button type="button" class="btnone"><?=getLanguage('chon-file');?></button></li>
					</ul>
					<input style='display:none;' accept="image/*" id ="profileAvatar" type="file" name="profileAvatar">
				</div>
				<div class="col-md-6" >
					 <span id="showavatar">
							<img width="60" height="40" src="<?=base_url();?>files/user/<?=$finds->avatar;?>" />
					 </span> 
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 mtop10">
		<div class="form-group">
			<label class="control-label col-md-5"><?=getLanguage('chu-ky');?></label>
			<div class="col-md-7">
				<div class="col-md-6" style="padding:0 5px !important;" >
					<ul style="margin:0px;" class="button-group">
						<li class="" onclick ="javascript:document.getElementById('signatures').click();"><button type="button" class="btnone"><?=getLanguage('chon-file');?></button></li>
					</ul>
					<input style='display:none;' accept="image/*" id ="signatures" type="file" name="signatures">
				</div>
				<div class="col-md-6" >
					 <span id="showsignatures">
						<img width="60" height="40" src="<?=base_url();?>files/user/<?=$finds->signatures;?>" />
					 </span> 
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){	
		handleSelect2();
		initForm();
	});
	function initForm(){
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
		//signatures
		$('#signatures').change(function(evt) {
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
                            $('#showsignatures').html('<img src="' + e.target.result + '" style="width:60px; height:40px" />');
                            //$("#img2").val(e.target.result);
                        };
                    })(f);
                    reader.readAsDataURL(f);
                }
                else{
                    $("#fileupload").val("");
                    $('.showsignatures').attr('src', "");
                    // alert("File size can't over 2Mb.");
					toastr.error("File size can't over 2Mb.", messageError, {closeButton:true, timeOut:5000});
                }
            }
        });
	}
</script>