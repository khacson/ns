<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('nguoi-phong-van');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_employee_interview"  id="input_employee_interview" class="form-input form-control " 
				value="<?=$finds->employee_interview;?>" placeholder="<?=getLanguage('nhap-ho-ten');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ket-qua-phong-van');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<select class="form-input form-control select2me" id="result_interview" name="result_interview">
					<option <?php if($finds->result_interview == -1){?> selected <?php }?> value="-1"><?=getLanguage('chua-phong-van')?></option>
					<option <?php if($finds->result_interview == 1){?> selected <?php }?> value="1"><?=getLanguage('dat')?></option>
					<option <?php if($finds->result_interview == 0){?> selected <?php }?> value="0"><?=getLanguage('khong-dat')?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_description_interview"  id="input_description_interview" class="form-input form-control " 
				value="<?=$finds->description_interview;?>" placeholder="<?=getLanguage('nhap-ghi-chu');?>" 
				/>
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
		handleSelect2();
	});
	function initForm(){
		
	}
</script>
