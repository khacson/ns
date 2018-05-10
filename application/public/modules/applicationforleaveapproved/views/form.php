<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ma-nhan-vien');?></label>
			<div class="col-md-8">
				<input type="text" name="code"  id="code" class="form-input form-control tab-event" 
				value="<?=$items->code;?>" readonly
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ho-ten');?></label>
			<div class="col-md-8">
				<input type="text" name="fullname"  id="fullname" class="form-input form-control tab-event" 
				value="<?=$items->fullname;?>" readonly
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<?php
			$time_start = '';
			if(!empty($finds->time_start)){
				$time_start = date(configs('cfdate').' H:i:s',strtotime($finds->time_start));
			}
			$time_end = '';
			if(!empty($finds->time_end)){
				$time_end = date(configs('cfdate').' H:i:s',strtotime($finds->time_end));
			}
		
		?>
		<div class="form-group">
			<label class="control-label col-md-4" ><?=getLanguage('thoi-gian-bat-dau');?>
			 </label>
			<div class="col-md-8">
				<div class="input-group " >
					<div id="datetimepicker2" class="input-append input-group input-process">
						<input class="form-control form-input" data-format="dd/MM/yyyy hh:mm:ss" type="text" id="input_time_start" value="<?=$time_start;?>" readonly></input>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4" ><?=getLanguage('thoi-gian-ket-thuc');?>
			</label>
			<div class="col-md-8">
				<div class="input-group " >
					<div id="datetimepicker3" class="input-append input-group input-process">
						<input class="form-control form-input" data-format="dd/MM/yyyy hh:mm:ss" type="text" id="input_time_end" value="<?=$time_end;?>" readonly></input>
					
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ly-do-nghi');?></label>
			<div class="col-md-8">
				<textarea readonly id="input_description" name="input_description" class="form-control form-input" rows="4" cols="100%"><?=$finds->description;?></textarea> 
			</div>
		</div>
	</div>
	<?php if($login['approved_leave'] == 1){?>
		<div class="col-md-12 mtop10">
			<div class="form-group">
				<label class="control-label col-md-4"><?=getLanguage('duyet-nghi-phep')?> <?php if($approved == 1){?>(<span class="red">*</span>) <?php }?></label>
				<div class="col-md-8">
					<select class="form-input form-control select2me" id="input_approved" name="input_approved"  data-placeholder="<?=getLanguage('chon-trang-thai')?>">
						<option value=""></option>
						<option <?php if($finds->approved == 1){?> selected <?php }?> value="1"><?=getLanguage('cho-nghi-phep')?></option>
						<option <?php if($finds->approved == 0){?> selected <?php }?> value="0"><?=getLanguage('khong-cho-nghi-phep')?></option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-12 mtop10">
			<div class="form-group">
				<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?></label>
				<div class="col-md-8">
					<textarea id="input_approved_description" name="input_approved_description" class="form-control form-input" rows="4" cols="100%"><?=$finds->approved_description;?></textarea> 
				</div>
			</div>
		</div>
	<?php }?>
</div>
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
