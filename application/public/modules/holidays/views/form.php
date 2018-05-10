<div class="row">
	<?php 
	$dateoff = '';
	if(!empty($finds->dateoff) && $finds->dateoff != '0000-00-00'){
		$dateoff = $finds->dateoff;
	}
	$datework = '';
	if(!empty($finds->datework) && $finds->datework != '0000-00-00'){
		$datework = $finds->datework;
	}
	?>
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ngay-nghi')?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<div class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
					<input value="<?=$dateoff;?>" id="input_dateoff" name="input_dateoff" type="text" class="form-input form-control tab-event">
					<div class="input-group-addon">
						<i class="fa fa-calendar "></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ngay-lam-bu')?></label>
			<div class="col-md-8">
				<div class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
					<input value="<?=$datework;?>" id="input_datework" name="input_datework" type="text" class="form-input form-control tab-event">
					<div class="input-group-addon">
						<i class="fa fa-calendar "></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('loai-ngay-nghi')?></label>
			<div class="col-md-8">
				<select class="form-input form-control select2me" id="input_typeid" name="input_typeid"  data-placeholder="<?=getLanguage('chon-loai-ngay-nghi')?>">
					<option <?php if($finds->typeid ==1){?> selected <?php }?> value="1"><?=getLanguage('nghi-co-luong');?></option>
					<option <?php if($finds->typeid ==2){?> selected <?php }?> value="2"><?=getLanguage('nghi-khong-luong');?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_description"  id="input_description" class="form-input form-control tab-event" value="<?=$finds->description;?>"  placeholder="<?=getLanguage('nhap-ghi-chu');?>" />
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
	});
	function initForm(){
		
	}
</script>
