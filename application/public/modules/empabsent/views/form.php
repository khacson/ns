<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('bo-phan')?></label>
			<div class="col-md-8">
				<select class="combos-input" id="input_departmentid" name="input_departmentid">
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
			<label class="control-label col-md-4"><?=getLanguage('ma-nhan-vien');?></label>
			<div class="col-md-8">
				<input type="text" name="code"  id="code" class="form-input form-control tab-event" 
				value="<?=$code;?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ho-ten');?></label>
			<div class="col-md-8">
				<input type="text" name="fullname"  id="fullname" class="form-input form-control tab-event" 
				value="<?=$fullname;?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<?php
			$time_start = '';
			if(!empty($finds->time_start)){
				$time_start = date(configs('cfdate'),strtotime($finds->time_start));
			}
			$time_end = '';
			if(!empty($finds->time_end)){
				$time_end = date(configs('cfdate'),strtotime($finds->time_end));
			}
		
		?>
		<div class="form-group">
			<label class="control-label col-md-4" ><?=getLanguage('thoi-gian-vao');?>
			 (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<div class="input-group " >
					<div id="datetimepicker2" class="input-append input-group input-process">
						<input class="searchs form-control tab-event input-process" data-format="dd/MM/yyyy hh:mm:ss" type="text" id="input_time_start" value="<?=$time_start;?>"></input>
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
			<label class="control-label col-md-4" ><?=getLanguage('thoi-gian-ra');?> (<span class="red">*</span>)
			</label>
			<div class="col-md-8">
				<div class="input-group " >
					<div id="datetimepicker3" class="input-append input-group input-process">
						<input class="searchs form-control tab-event input-process" data-format="dd/MM/yyyy hh:mm:ss" type="text" id="input_time_end" value="<?=$time_end;?>"></input>
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
		$('#input_departmentid').multipleSelect({
			filter: true,
			placeholder:'<?=getLanguage('chon-bo-phan')?>',
			single: false
		});
		initForm();
	});
	function initForm(){
		//$('#input_ethnic_name').select();
	}
</script>
