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
					<input id="input_otherdebt_date" name="input_otherdebt_date" type="text" class="form-input form-control tab-event" value="<?=$dates;?>" />
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
				<input type="text" name="input_otherdebt_money"  id="input_otherdebt_money" class="form-input form-control tab-event fm-number" 
				value="<?=$finds->otherdebt_money;?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_otherdebt_content"  id="input_otherdebt_content" class="form-input form-control tab-event" 
				value="<?=$finds->otherdebt_content;?>" placeholder="<?=getLanguage('nhap-ghi-chu');?>"
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
