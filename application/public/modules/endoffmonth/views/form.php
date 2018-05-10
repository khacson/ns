<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('thang-nam');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_monthyear"  id="input_monthyear" class="form-input form-control" 
				value="<?=$finds->monthyear;?>"  placeholder="mm/yyyy"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tu-ngay');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<?php
					$date_start = '';
					if(!empty($finds->date_start)){
						$date_start = date(configs('cfdate'),strtotime($finds->date_start));
					}
					$date_end = '';
					if(!empty($finds->date_end)){
						$date_end = date(configs('cfdate'),strtotime($finds->date_end));
					}
				?>
				<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
					<input value="<?=$date_start;?>" id="input_date_start" name="input_date_start" type="text" class="form-input form-control">
					<div class="input-group-addon">
						<i class="fa fa-calendar "></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('den-ngay');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
					<input value="<?=$date_end;?>" id="input_date_end" name="input_date_end" type="text" class="form-input form-control">
					<div class="input-group-addon">
						<i class="fa fa-calendar "></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ngay-cong');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_number_days"  id="input_number_days" class="form-input form-control" 
				value="<?=$finds->number_days;?>"  placeholder="<?=getLanguage('nhap-ngay-cong');?>"
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
	});
	function initForm(){
		$('#input_monthyear').select();
	}
</script>
