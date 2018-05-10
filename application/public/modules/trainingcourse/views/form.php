<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ten-khoa-hoc');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_trainingcourse_name"  id="input_trainingcourse_name" class="form-input form-control tab-event" 
				value="<?=$finds->trainingcourse_name;?>" placeholder="<?=getLanguage('nhap-ten-khoa-hoc');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<?php
			$time_start = '';
			if(!empty($finds->time_start) && $finds->time_start != '0000-00-00'){
				$time_start = date(configs('cfdate').' H:i:s',strtotime($finds->time_start));
			}
			$time_end = '';
			if(!empty($finds->time_end) && $finds->time_end != '0000-00-00'){
				$time_end = date(configs('cfdate').' H:i:s',strtotime($finds->time_end));
			}
		
		?>
		<div class="form-group">
			<label class="control-label col-md-4" ><?=getLanguage('tu-ngay');?>
			 </label>
			<div class="col-md-8">
				<div class="input-group " >
					<div id="datetimepicker1" class="input-append input-group input-process">
						<input class="form-control tab-event form-input" data-format="dd/MM/yyyy hh:mm:ss" type="text" id="input_time_start" value="<?=$time_start;?>"></input>
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
			<label class="control-label col-md-4" ><?=getLanguage('tu-ngay');?>
			 </label>
			<div class="col-md-8">
				<div class="input-group " >
					<div id="datetimepicker2" class="input-append input-group input-process">
						<input class="form-control tab-event form-input" data-format="dd/MM/yyyy hh:mm:ss" type="text" id="input_time_end" value="<?=$time_end;?>"></input>
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
			<label class="control-label col-md-4"><?=getLanguage('ghi-chu');?> </label>
			<div class="col-md-8">
				<input type="text" name="input_description"  id="input_description" class="form-input form-control " 
				value="<?=$finds->description;?>" placeholder="<?=getLanguage('nhap-ghi-chu');?>" 
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
		$('#datetimepicker1,#datetimepicker2').datetimepicker({
		    locale: 'en',
			format: 'DD/MM/YYYY',
		});
	});
	function initForm(){
		$('#input_trainingcourse_name').select();
	}
</script>
