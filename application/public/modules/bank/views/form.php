<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ma-ngan-hang');?></label>
			<div class="col-md-8">
				<input type="text" name="input_bank_code" placeholder="<?=getLanguage('nhap-ma-ngan-hang');?>" id="input_bank_code" class="form-input form-control tab-event" />
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ten-ngan-hang');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_bank_name" placeholder="<?=getLanguage('nhap-ten-ngan-hang');?>" id="input_bank_name" class="form-input form-control tab-event" />
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?></label>
			<div class="col-md-8">
				<input type="text" name="input_description" placeholder="<?=getLanguage('nhap-ghi-chu');?>" id="input_description" class="form-input form-control tab-event" />
			</div>
		</div>
	</div>
</div>
<script>
	$(function(){
		initForm();
	});
	function initForm(){
		$('#input_bank_code').val('<?=$finds->bank_code;?>');
		$('#input_bank_name').val('<?=$finds->bank_name;?>');
		$('#input_description').val('<?=$finds->description;?>');
	}
</script>