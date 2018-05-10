<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ma-kpi');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_kpi_code"  id="input_kpi_code" class="form-input form-control tab-event" 
				value="<?=$finds->kpi_code;?>" placeholder="<?=getLanguage('nhap-ma');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ten-kpi');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_kpi_name"  id="input_kpi_name" class="form-input form-control tab-event" 
				value="<?=$finds->kpi_name;?>" placeholder="<?=getLanguage('nhap-ten');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('diem-toi-da');?></label>
			<div class="col-md-8">
				<input type="text" name="input_kpi_point_max"  id="input_kpi_point_max" class="form-input form-control tab-event" 
				value="<?=$finds->kpi_point_max;?>" placeholder="<?=getLanguage('nhap-diem');?>" 
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
	});
	function initForm(){
		$('#input_kpi_code').select();
	}
</script>
