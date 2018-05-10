<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('bo-phan')?></label>
			<div class="col-md-8">
				<select class="form-input form-control select2me" id="input_departmentid" name="input_departmentid"  data-placeholder="<?=getLanguage('chon-bo-phan')?>">
					<?php if(count($departments) > 1){?>
					<option value=""></option>
					<?php }?>
					<?php foreach($departments as $item){
						?>
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
						<option <?php if($item->id == $finds->employeeid){ echo 'selected';}?> value="<?=$item->id;?>"><?=$item->code;?> - <?=$item->fullname;?></option>
					<?php }?>
				</select>
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
			<label class="control-label col-md-4" ><?=getLanguage('den-ngay');?> (<span class="red">*</span>)
			</label>
			<div class="col-md-8">
				<div class="input-group " >
					<div id="datetimepicker3" class="input-append input-group input-process">
						<input class="form-control tab-event form-input" data-format="dd/MM/yyyy hh:mm:ss" type="text" id="input_time_end" value="<?=$time_end;?>"></input>
						<span class="add-on input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
					</div>
				</div>
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
