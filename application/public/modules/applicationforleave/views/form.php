<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ma-nhan-vien');?></label>
			<div class="col-md-8">
				<input type="text" name="code"  id="code" class="form-input form-control tab-event" 
				value="<?=$finds->code;?>" readonly
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ho-ten');?></label>
			<div class="col-md-8">
				<input type="text" name="fullname"  id="fullname" class="form-input form-control tab-event" 
				value="<?=$finds->fullname;?>" readonly
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
			 (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<div class="input-group " >
					<div id="datetimepicker2" class="input-append input-group input-process">
						<input class="form-control form-input" data-format="dd/MM/yyyy hh:mm:ss" type="text" id="input_time_start" value="<?=$time_start;?>"></input>
						<span class="add-on input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4" ><?=getLanguage('thoi-gian-ket-thuc');?> (<span class="red">*</span>)
			</label>
			<div class="col-md-8">
				<div class="input-group " >
					<div id="datetimepicker3" class="input-append input-group input-process">
						<input class="form-control form-input" data-format="dd/MM/yyyy hh:mm:ss" type="text" id="input_time_end" value="<?=$time_end;?>"></input>
						<span class="add-on input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('so-ngay-nghi');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="numberof"  id="numberof" class="form-input form-control tab-event" 
				value="<?=$finds->numberof;?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ly-do-nghi');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<textarea id="input_description" name="input_description" class="form-control form-input" rows="4" cols="100%"><?=$finds->description;?></textarea> 
			</div>
		</div>
	</div>
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
