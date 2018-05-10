<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tu-nam');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_holidays_year_from"  id="input_holidays_year_from" class="form-input form-control tab-event" value="<?=$finds->holidays_year_from;?>"  placeholder="<?=getLanguage('nhap-so-nam');?>" />
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('den-nam');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_holidays_year_to"  id="input_holidays_year_to" class="form-input form-control tab-event" value="<?=$finds->holidays_year_to;?>"  placeholder="<?=getLanguage('nhap-so-nam');?>" />
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('so-ngay-nghi');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_holidays_date"  id="input_holidays_date" class="form-input form-control tab-event" value="<?=$finds->holidays_date;?>"  placeholder="<?=getLanguage('nhap-so-ngay-nghi');?>" />
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_description"  id="input_description" class="form-input form-control tab-event" value="<?=$finds->description;?>"  placeholder="<?=getLanguage('nhap-ghi-chu');?>" />
			</div>
		</div>
	</div>
</div>
<?php
	//print_r($finds);
?>
<script>
	$(function(){
		handleSelect2();
	});
	function initForm(){
		
	}
</script>
