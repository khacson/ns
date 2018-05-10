<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('nhan-vien');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<select id="input_employeeid" name="input_employeeid" class="select2me form-input form-control " data-placeholder="<?=getLanguage('chon-nhan-vien')?>">
					<option value=""></option>
					<?php foreach($employees as $item){?>
						<option <?php if($item->id == $finds->employeeid){ echo 'selected';}?> value="<?=$item->id;?>"><?=$item->code;?> - <?=$item->fullname;?></option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ngay-tam-ung');?> </label>
			<div class="col-md-8">
				<div class="input-group date" data-provide="datepicker">
					<input id="input_salaryadvance_date" name="input_salaryadvance_date" type="text" class="form-input form-control tab-event" value="<?=$dates;?>" />
					<div class="input-group-addon">
						<i class="fa fa-calendar "></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('so-tien');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_salaryadvance_money"  id="input_salaryadvance_money" class="form-input form-control tab-event fm-number" 
				value="<?=$finds->salaryadvance_money;?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_salaryadvance_content"  id="input_salaryadvance_content" class="form-input form-control tab-event" 
				value="<?=$finds->salaryadvance_content;?>" placeholder="<?=getLanguage('nhap-ghi-chu');?>"
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
		formatNumber('fm-number');
		formatNumberKeyUp('fm-number');
		handleSelect2();
		initForm();
	});
	function initForm(){
		//$('#input_salaryadvance_content').select();
		$('#input_employeeid').multipleSelect({
			filter: true,
			single: true,
			placeholder: '<?=getLanguage('chon-nhan-vien')?>'
		});
	}
</script>
