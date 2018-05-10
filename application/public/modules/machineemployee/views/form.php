<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ma-nhan-vien');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_employee_code"  id="input_employee_code" class="form-input form-control" 
				value="<?=$finds->employee_code;?>"  placeholder="<?=getLanguage('nhap-ma-nhan-vien');?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ten-nhan-vien');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_fullname"  id="input_fullname" class="form-input form-control" value="<?=$finds->fullname;?>"  placeholder="<?=getLanguage('nhap-ten-nhan-vien');?>"/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('password');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_password"  id="input_password" class="form-input form-control" value="<?=$finds->password;?>"  placeholder="<?=getLanguage('nhap-mat-khau');?>" />
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('privilege');?></label>
			<div class="col-md-8">
				<input type="text" name="input_privilege"  id="input_privilege" class="form-input form-control" value="<?=$finds->privilege;?>"  placeholder="<?=getLanguage('nhap-privilege');?>"/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('enabled');?></label>
			<div class="col-md-8">
				<input type="text" name="input_enabled"  id="input_enabled" class="form-input form-control" value="<?=$finds->enabled;?>"  placeholder="<?=getLanguage('nhap-enabled');?>"/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('version');?></label>
			<div class="col-md-8">
				<input type="text" name="input_version"  id="input_version" class="form-input form-control" value="<?=$finds->version;?>"  placeholder="<?=getLanguage('nhap-version');?>"/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('Flag1');?></label>
			<div class="col-md-8">
				<input type="text" name="input_Flag1"  id="input_Flag1" class="form-input form-control" value="<?=$finds->Flag1;?>"  placeholder="<?=getLanguage('nhap-Flag1');?>"/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('TmpData1');?></label>
			<div class="col-md-8">
				<input type="text" name="input_TmpData1"  id="input_TmpData1" class="form-input form-control" value="<?=$finds->TmpData1;?>"  placeholder="<?=getLanguage('nhap-TmpData1');?>"/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('TmpLength1');?></label>
			<div class="col-md-8">
				<input type="text" name="input_TmpLength1"  id="input_TmpLength1" class="form-input form-control" value="<?=$finds->TmpLength1;?>"  placeholder="<?=getLanguage('nhap-TmpLength1');?>"/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('Flag2');?></label>
			<div class="col-md-8">
				<input type="text" name="input_Flag2"  id="input_Flag2" class="form-input form-control" value="<?=$finds->Flag2;?>"  placeholder="<?=getLanguage('nhap-Flag2');?>"/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('TmpData2');?></label>
			<div class="col-md-8">
				<input type="text" name="input_TmpData2"  id="input_TmpData2" class="form-input form-control" value="<?=$finds->TmpData2;?>"  placeholder="<?=getLanguage('nhap-TmpData2');?>"/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('TmpLength2');?></label>
			<div class="col-md-8">
				<input type="text" name="input_TmpLength2"  id="input_TmpLength2" class="form-input form-control" value="<?=$finds->TmpLength2;?>"  placeholder="<?=getLanguage('nhap-TmpLength2');?>"/>
			</div>
		</div>
	</div>
</div>
<?php
	//print_r($finds);
?>
<script>
	$(function(){
		initForm();
	});
	function initForm(){
		$('#input_departmanet_name').select();
	}
</script>
