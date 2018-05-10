<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('chuc-vu');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_position_name"  id="input_position_name" class="form-input form-control tab-event" 
				value="<?=$finds->position_name;?>" placeholder="<?=getLanguage('nhap-chuc-vu');?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('thu-tu');?></label>
			<div class="col-md-8">
				<input type="text" name="input_ordering"  id="input_ordering" class="form-input form-control tab-event" value="<?=$finds->ordering;?>" placeholder="<?=getLanguage('nhap-nhap-thu-tu');?>"/>
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
		$('#input_position_name').select();
	}
</script>
