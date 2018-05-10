<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('phu-cap');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_allowance_name"  id="input_allowance_name" class="form-input form-control tab-event" 
				value="<?=$finds->allowance_name;?>" placeholder="<?=getLanguage('nhap-phu-cap');?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tien-phu-cap');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_allowance_money"  id="input_allowance_money" class="form-input form-control tab-event" 
				value="<?=number_format($finds->allowance_money);?>" placeholder="<?=getLanguage('nhap-loai-phu-cap');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('loai-phu-cap');?> </label>
			<div class="col-md-8">
				<select id="input_allowance_type" name="input_allowance_type" class="combos-input" >
					<option value=""></option>
						<?php foreach($types as $key=>$val){?>
							<option <?php if($key == $finds->allowance_type){ echo 'selected';}?>  value="<?=$key;?>"><?=$val;?></option>
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
		$('#input_allowance_name').select();
		$('#input_allowance_type').multipleSelect({
			filter: true,
			single: true,
			placeholder: '<?=getLanguage('chon-loai-phu-cap')?>'
		});
	}
</script>
