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
			<label class="control-label col-md-4"><?=getLanguage('trinh-do')?></label>
			<div class="col-md-8">
				<select class="form-input form-control select2me" id="input_academic_levelid" name="input_academic_levelid"  data-placeholder="<?=getLanguage('chon-trinh-do')?>">
					<option value=""></option>
					<?php foreach($academics as $item){?>
					<option <?php if($item->id == $finds->academic_levelid){?> selected <?php }?> value="<?=$item->id;?>"><?=$item->academic_name;?></option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('yeu-cau');?> </label>
			<div class="col-md-8">
				<textarea name="input_request" rows="2" id="input_request" class="form-input form-control tab-event"><?=$finds->request;?></textarea>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('so-luong');?></label>
			<div class="col-md-8">
				<input type="text" name="input_quantity"  id="input_quantity" class="form-input form-control tab-event" value="<?=$finds->quantity;?>"  placeholder="<?=getLanguage('nhap-so-luong');?>"/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ly-do-tuyen');?> </label>
			<div class="col-md-8">
				<textarea name="input_note" rows="2" id="input_note" class="form-input form-control tab-event"><?=$finds->note;?></textarea>
			</div>
		</div>
	</div>
	<?php
		$fromdate = '';
		if(!empty($finds->fromdate)){
			$fromdate = date(configs('cfdate'),strtotime($finds->fromdate));
		}
		$todate = '';
		if(!empty($finds->todate)){
			$todate = date(configs('cfdate'),strtotime($finds->todate));
		}
	
	?>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tu-ngay');?></label>
			<div class="col-md-8">
				<div class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
					<input value="<?=$fromdate;?>" id="input_fromdate" name="input_fromdate" type="text" class="searchs form-control tab-event">
					<div class="input-group-addon">
						<i class="fa fa-calendar "></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('den-ngay');?></label>
			<div class="col-md-8">
				<div class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
					<input value="<?=$todate;?>" id="input_fromdate" name="input_fromdate" type="text" class="searchs form-control tab-event">
					<div class="input-group-addon">
						<i class="fa fa-calendar "></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if($approved_recruitment == 1){?>
		<div class="col-md-12 mtop10">
			<div class="form-group">
				<label class="control-label col-md-4"><?=getLanguage('duyet-tuyen-dung')?> <?php if($approved == 1){?>(<span class="red">*</span>) <?php }?></label>
				<div class="col-md-8">
					<select class="form-input form-control select2me" id="input_approved" name="input_approved"  data-placeholder="<?=getLanguage('chon-trang-thai')?>">
						<option value=""></option>
						<option <?php if($finds->approved == 1){?> selected <?php }?> value="1"><?=getLanguage('cho-phep-tuyen')?></option>
						<option <?php if($finds->approved == 0){?> selected <?php }?> value="0"><?=getLanguage('khong-cho-phep-tuyen')?></option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-12 mtop10">
			<div class="form-group">
				<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?></label>
				<div class="col-md-8">
					<textarea id="input_description" name="input_description" class="form-control form-input" rows="2" cols="100%"><?=$finds->description;?></textarea> 
				</div>
			</div>
		</div>
	<?php }?>
</div>
<?php
	//print_r($finds);
?>
<script>
	$(function(){
		initForm();
	});
	handleSelect2();
	function initForm(){
		$('#input_departmanet_name').select();
	}
</script>
