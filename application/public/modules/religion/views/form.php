<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ton-giao');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_religion_name"  id="input_religion_name" class="form-input form-control tab-event" 
				value="<?=$finds->religion_name;?>" placeholder="<?=getLanguage('nhap-ton-giao');?>"
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
		$('#input_religion_name').select();
	}
</script>
