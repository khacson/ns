<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('bao-hiem-kpcd');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_insurance_name"  id="input_insurance_name" class="form-input form-control tab-event" 
				value="<?=$finds->insurance_name;?>"  placeholder="<?=getLanguage('nhap-bao-hiem-kpcd');?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('so-tien');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_insurance_value"  id="input_insurance_value" class="form-input form-control tab-event" 
				value="<?=number_format($finds->insurance_value);?>" placeholder="<?=getLanguage('nhap-so-tien');?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('loai');?> </label>
			<div class="col-md-8">
				<select id="input_insurance_type" name="input_insurance_type" class="combos-input" >
					<option value=""></option>
						<?php foreach($types as $key=>$val){?>
							<option <?php if($key == $finds->insurance_type){ echo 'selected';}?>  value="<?=$key;?>"><?=$val;?></option>
						<?php }?>
				</select>
			</div>
		</div>
	</div>
</div>
<?php
	//print_r($finds);
?>
<script>
	$(function(){
		formatNumber('fm-number');
		formatNumberKeyUp('fm-number');
		initForm();
	});
	function initForm(){
		$('#input_insurance_name').select();
		$('#input_insurance_type').multipleSelect({
			filter: true,
			single: true,
			placeholder: '<?=getLanguage('chon-loai')?>'
		});
	}
</script>
