<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tinh-thanh-pho');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_province_name"  id="input_province_name" class="form-input form-control tab-event" 
				value="<?=$finds->province_name;?>" placeholder="<?=getLanguage('nhap-tinh-thanh-pho');?>"
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
		$('#input_province_name').select();
	}
</script>
