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
			<label class="control-label col-md-4"><?=getLanguage('ngay-khen-thuong');?> </label>
			<div class="col-md-8">
				<div class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
					<input id="input_date_reward" name="input_date_reward" type="text" class="form-input form-control tab-event" value="<?=$dates;?>" />
					<div class="input-group-addon">
						<i class="fa fa-calendar "></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('noi-dung-khen-thuong');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_reward_content"  id="input_reward_content" class="form-input form-control tab-event" 
				value="<?=$finds->reward_content;?>" placeholder="<?=getLanguage('nhap-noi-dung-khen-thuong');?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tien-thuong');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_money"  id="input_money" class="form-input form-control tab-event fm-number" 
				value="<?=$finds->money;?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('dong-bao-hiem')?></label>
			<div class="col-md-8">
				<select id="input_isinsurrance" name="input_isinsurrance" class="form-input select2me form-control" >
					<option value=""></option>
					<option <?php if(0 == $finds->isinsurrance){?> selected <?php }?> value="0"><?=getLanguage('khong')?></option>
					<option <?php if(1 == $finds->isinsurrance){?> selected <?php }?> value="1"><?=getLanguage('co')?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tinh-trang')?></label>
			<div class="col-md-8">
				<select id="input_statusid" name="input_statusid" class="form-input select2me form-control" data-placeholder="<?=getLanguage('chon-tinh-trang')?>">
					<option value=""></option>
					<option <?php if(1 == $finds->statusid){?> selected <?php }?> value="1"><?=getLanguage('chuyen-tien-rieng')?></option>
					<option <?php if(2 == $finds->statusid){?> selected <?php }?> value="2"><?=getLanguage('cong-luong-thang')?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('thanh-toan')?></label>
			<div class="col-md-8">
				<select id="input_ispay" name="input_ispay" class="form-input select2me form-control " >
					<option value=""></option>
					<option <?php if(0 == $finds->ispay){?> selected <?php }?> value="0"><?=getLanguage('chua-thanh-toan')?></option>
					<option <?php if(1 == $finds->ispay){?> selected <?php }?> value="1"><?=getLanguage('da-thanh-toan')?></option>
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
		handleSelect2();
	});
	function initForm(){
		//$('#input_reward_content').select();
	}
</script>
