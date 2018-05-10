<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('serial');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_machine_sn"  id="input_machine_sn" class="form-input form-control tab-event" 
				value="<?=$finds->machine_sn;?>" placeholder="<?=getLanguage('nhap-serial');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('shutdown')?></label>
			<div class="col-md-8">
				<select class="form-input form-control select2me" id="input_shutdown" name="input_shutdown"  data-placeholder="<?=getLanguage('chon-trang-thai')?>">
					<option <?php if($finds->shutdown == 0){?> selected <?php }?> value="0"><?=getLanguage('no')?></option>
					<option <?php if($finds->shutdown == 1){?> selected <?php }?> value="1"><?=getLanguage('syncing')?></option>
					<option <?php if($finds->shutdown == 2){?> selected <?php }?> value="2"><?=getLanguage('updated')?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('restart')?></label>
			<div class="col-md-8">
				<select class="form-input form-control select2me" id="input_restart" name="input_restart"  data-placeholder="<?=getLanguage('chon-trang-thai')?>">
					<option  <?php if($finds->restart == 0){?> selected <?php }?> value="0"><?=getLanguage('no')?></option>
					<option  <?php if($finds->restart == 1){?> selected <?php }?> value="1"><?=getLanguage('syncing')?></option>
					<option  <?php if($finds->restart == 2){?> selected <?php }?> value="2"><?=getLanguage('updated')?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('upload')?></label>
			<div class="col-md-8">
				<select class="form-input form-control select2me" id="input_uploademployee" name="input_uploademployee"  data-placeholder="<?=getLanguage('chon-trang-thai')?>">
					<option  <?php if($finds->uploademployee == 0){?> selected <?php }?> value="0"><?=getLanguage('no')?></option>
					<option  <?php if($finds->uploademployee == 1){?> selected <?php }?> value="1"><?=getLanguage('syncing')?></option>
					<option <?php if($finds->uploademployee == 2){?> selected <?php }?> value="2"><?=getLanguage('updated')?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('download')?></label>
			<div class="col-md-8">
				<select class="form-input form-control select2me" id="input_downloademployee" name="input_downloademployee"  data-placeholder="<?=getLanguage('chon-trang-thai')?>">
					<option  <?php if($finds->downloademployee == 0){?> selected <?php }?> value="0"><?=getLanguage('no')?></option>
					<option  <?php if($finds->downloademployee == 1){?> selected <?php }?> value="1"><?=getLanguage('syncing')?></option>
					<option  <?php if($finds->downloademployee == 2){?> selected <?php }?> value="2"><?=getLanguage('updated')?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('delete')?></label>
			<div class="col-md-8">
				<select class="form-input form-control select2me" id="input_deleteemployee" name="input_deleteemployee"  data-placeholder="<?=getLanguage('chon-trang-thai')?>">
					<option  <?php if($finds->deleteemployee == 0){?> selected <?php }?> value="0"><?=getLanguage('no')?></option>
					<option  <?php if($finds->deleteemployee == 1){?> selected <?php }?> value="1"><?=getLanguage('syncing')?></option>
					<option  <?php if($finds->deleteemployee == 2){?> selected <?php }?> value="2"><?=getLanguage('updated')?></option>
				</select>
			</div>
		</div>
	</div>
	<!--S delete file-->
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('delete-file')?></label>
			<div class="col-md-8">
				<select class="form-input form-control select2me" id="input_delete_file" name="input_delete_file"  data-placeholder="<?=getLanguage('chon-trang-thai')?>">
					<option  <?php if($finds->delete_file == 0){?> selected <?php }?> value="0"><?=getLanguage('no')?></option>
					<option  <?php if($finds->delete_file == 1){?> selected <?php }?> value="1"><?=getLanguage('syncing')?></option>
					<option  <?php if($finds->delete_file == 2){?> selected <?php }?> value="2"><?=getLanguage('updated')?></option>
				</select>
			</div>
		</div>
	</div>
	<!--E delete file-->
	<!--S delete file-->
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('fingerprint')?></label>
			<div class="col-md-8">
				<select class="form-input form-control select2me" id="input_fingerprint" name="input_fingerprint"  data-placeholder="<?=getLanguage('chon-trang-thai')?>">
					<option  <?php if($finds->fingerprint == 0){?> selected <?php }?> value="0"><?=getLanguage('no')?></option>
					<option  <?php if($finds->fingerprint == 1){?> selected <?php }?> value="1"><?=getLanguage('syncing')?></option>
					<option  <?php if($finds->fingerprint == 2){?> selected <?php }?> value="2"><?=getLanguage('updated')?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('from-date')?></label>
			<div class="col-md-8">
				<?php 
				$fingerprint_date_from = '';
				if(!empty($finds->fingerprint_date_from)){
					$fingerprint_date_from = date(configs('cfdate'),strtotime($finds->fingerprint_date_from));
				}
				?>
				<div class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
					<input value="<?=$fingerprint_date_from;?>" id="input_fingerprint_date_from" name="input_fingerprint_date_from" type="text" class="searchs form-control form-input">
					<div class="input-group-addon">
						<i class="fa fa-calendar "></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('to-date')?></label>
			<div class="col-md-8">
				<?php 
				$fingerprint_date_to = '';
				if(!empty($finds->fingerprint_date_to)){
					$fingerprint_date_to = date(configs('cfdate'),strtotime($finds->fingerprint_date_to));
				}
				?>
				<div class="input-group date" data-provide="datepicker"  data-date-format="dd/mm/yyyy">
					<input value="<?=$fingerprint_date_to;?>" id="input_fingerprint_date_to" name="input_fingerprint_date_to" type="text" class="searchs form-control form-input">
					<div class="input-group-addon">
						<i class="fa fa-calendar "></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--E delete file-->
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
		$('#input_machine_sn').select();
	}
</script>
