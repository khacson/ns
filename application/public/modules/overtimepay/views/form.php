<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tieu-de');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_overtime_name"  id="input_overtime_name" class="form-input form-control" 
				value="<?=$finds->overtime_name;?>" />
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tien-tang-ca');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_overtime_pay"  id="input_overtime_pay" class="form-input fm-number form-control" 
				value="<?=$finds->overtime_pay;?>" />
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('loai');?> </label>
			<div class="col-md-8">
				<select  id="input_overtime_pay_type" name="input_overtime_pay_type" class="select2me form-input form-control " data-placeholder="<?=getLanguage('chon-loai')?>">
					<option <?php if($finds->overtime_pay_type == 2){?> selected <?php }?>  value="2"><?=getLanguage('tien');?> </option>
					<option <?php if($finds->overtime_pay_type == 1){?> selected <?php }?>  value="1">%</option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tinh-theo');?> </label>
			<div class="col-md-8">
				<select  id="input_overtime_pay_by" name="input_overtime_pay_by" class="select2me form-input form-control " data-placeholder="<?=getLanguage('chon-loai')?>">
					<option <?php if($finds->overtime_pay_by == 1){?> selected <?php }?>  value="1"><?=getLanguage('theo-gio');?></option>
					<option <?php if($finds->overtime_pay_by == 2){?> selected <?php }?>  value="2"><?=getLanguage('theo-san-pham');?> </option>
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
		handleSelect2();
		initForm();
		formatNumber('fm-number');
		formatNumberKeyUp('fm-number');
	});
	function initForm(){
		$('#input_overtime_name').select();
	}
</script>
