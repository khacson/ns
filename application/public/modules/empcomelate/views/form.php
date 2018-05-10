<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ma-nhan-vien');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="code"  id="code" class="form-input form-control tab-event" 
				value="<?=$finds->ethnic_name;?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ho-ten');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="fullname"  id="fullname" class="form-input form-control tab-event" 
				value="<?=$finds->ethnic_name;?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4" ><?=getLanguage('thoi-gian-di-tre');?>
			 (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<div class="input-group " >
					<div id="datetimepicker2" class="input-append input-group input-process">
						<input class="searchs form-control tab-event input-process" data-format="dd/MM/yyyy hh:mm:ss" type="text" id="input_time_start"></input>
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
			<label class="control-label col-md-4" ><?=getLanguage('thoi-gian-ve-som');?> (<span class="red">*</span>)
			</label>
			<div class="col-md-8">
				<div class="input-group " >
					<div id="datetimepicker3" class="input-append input-group input-process">
						<input class="searchs form-control tab-event input-process" data-format="dd/MM/yyyy hh:mm:ss" type="text" id="input_time_end"></input>
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
			<label class="control-label col-md-4"><?=getLanguage('ly-do-nghi');?> </label>
			<div class="col-md-8">
				<input type="text" name="absent_content"  id="absent_content" class="form-input form-control tab-event" 
				value=""
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
		$('#datetimepicker2,#datetimepicker3').datetimepicker({
		    locale: 'en',
			format: 'DD/MM/YYYY HH:mm',
		});
		initForm();
	});
	function initForm(){
		//$('#input_ethnic_name').select();
	}
</script>
