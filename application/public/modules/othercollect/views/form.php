<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('bo-phan')?></label>
			<div class="col-md-8">
				<select class="form-input form-control select2me" id="input_departmentid" name="input_departmentid"  data-placeholder="<?=getLanguage('chon-bo-phan')?>">
					<option value=""></option>
					<?php foreach($departments as $item){?>
					<option <?php if($item->id == $finds->departmentid){?> selected <?php }?> value="<?=$item->id;?>"><?=$item->departmanet_name;?></option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('nhan-vien');?> (<span class="red">*</span>)</label>
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
			<label class="control-label col-md-4"><?=getLanguage('ngay-thu-khac');?> </label>
			<div class="col-md-8">
				<div class="input-group date" data-provide="datepicker">
					<input id="input_othercollect_date" name="input_othercollect_date" type="text" class="form-input form-control tab-event" value="<?=$dates;?>" />
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
				<input type="text" name="input_othercollect_money"  id="input_othercollect_money" class="form-input form-control tab-event fm-number" 
				value="<?=$finds->othercollect_money;?>"
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
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_othercollect_content"  id="input_othercollect_content" class="form-input form-control tab-event" 
				value="<?=$finds->othercollect_content;?>" placeholder="<?=getLanguage('nhap-ghi-chu');?>"
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
		$("#input_departmentid").change(function() {
			var departmentid = $(this).val();
			var links = controller+'getEmployee';
			$.ajax({					
				url: links,	
				type: 'POST',
				data: {departmentid:departmentid},	
				success: function(data) {
					$('#loademployees').html(data);
					$('#input_employeeid').select2({
						placeholder: "<?=getLanguage('chon-nhan-vien');?>",
						allowClear: true
					});
				}
			});
		});
	}
</script>
