<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tieu-chi-danh-gia');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_aprobationary_name"  id="input_aprobationary_name" class="form-input form-control tab-event" 
				value="<?=$finds->aprobationary_name;?>" placeholder="<?=getLanguage('nhap-tieu-chi-danh-gia');?>" 
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
		$('#input_aprobationary_name').select();
	}
</script>
