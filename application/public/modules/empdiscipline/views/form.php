<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('nhan-vien');?> </label>
			<div class="col-md-8" id="loademployees">
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
			<label class="control-label col-md-4"><?=getLanguage('ngay-ky-luat');?> </label>
			<div class="col-md-8">
				<div class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
					<input id="input_date_discipline" name="input_date_discipline" type="text" class="form-input form-control tab-event" value="<?=$dates;?>" />
					<div class="input-group-addon">
						<i class="fa fa-calendar "></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('noi-dung-ky-luat');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_discipline_content"  id="input_discipline_content" class="form-input form-control tab-event" 
				value="<?=$finds->discipline_content;?>"  placeholder="<?=getLanguage('nhap-noi-dung-ky-luat');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tien-phat');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_money"  id="input_money" class="form-input form-control tab-event fm-number" 
				value="<?=$finds->money;?>"
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
		initForm();
		handleSelect2();
	});
	function initForm(){
		
	}
</script>
