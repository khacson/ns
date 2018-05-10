<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('phong-ban')?></label>
			<div class="col-md-8">
				<select id="input_departmentid" name="input_departmentid" class="form-input select2me form-control " data-placeholder="<?=getLanguage('chon-bo-phan')?>">
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
						<option <?php if($item->id == $finds->id){ echo 'selected';}?> value="<?=$item->id;?>"><?=$item->code;?> - <?=$item->fullname;?></option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ngay-phep-cong-them');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_bonus_holiday"  id="input_bonus_holiday" class="form-input form-control tab-event" 
				value="<?=$finds->bonus_holiday;?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_bonus_holiday_note" id="input_bonus_holiday_note" class="form-input form-control tab-event" 
				value="<?=$finds->bonus_holiday_note;?>"
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
