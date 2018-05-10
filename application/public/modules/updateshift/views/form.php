<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('bo-phan')?></label>
			<div class="col-md-8">
				<select class="form-input form-control select2me" id="input_departmentid" name="input_departmentid" data-placeholder="<?=getLanguage('chon-bo-phan')?>">
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
			<label class="control-label col-md-4"><?=getLanguage('ma-nhan-vien');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="code"  id="code" class="form-input form-control tab-event" 
				value="<?=$finds->code;?>" placeholder="<?=getLanguage('vd-nhap-nhieu-ma-nhan-vien');?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4" style="padding-right:0;"><?=getLanguage('ca-lam-viec')?></label>
			<div class="col-md-8">
				<select id='shiftid' name='shiftid' class="form-input select2me form-control " data-placeholder="<?=getLanguage('chon-ca-lam-viec')?>">
					<!--<option value=""></option>-->
					<?php foreach($shifts as $item){?>
						<option <?php if($finds->shiftid == $item->id){?> selected <?php }?> value="<?=$item->id;?>"><?=$item->shift_name;?></option>
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
		$('#datetimepicker2,#datetimepicker3').datetimepicker({
		    locale: 'en',
			format: 'DD/MM/YYYY HH:mm',
		});
		handleSelect2();
		initForm();
	});
	function initForm(){
		//$('#input_ethnic_name').select();
	}
</script>
