<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('phong-ban')?></label>
			<div class="col-md-8">
				<select id="input_departmentid" name="input_departmentid" class="form-input select2me form-control " data-placeholder="<?=getLanguage('chon-bo-phan')?>">
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
		<div class="form-group">
			<label class="control-label col-md-4" style="white-space:nowrap"><?=getLanguage('khoa-hoc')?> (<span class="red">*</span>)</label>
			 <div class="col-md-8">
				<select class="select2me form-input form-control" id="catalogid" name="catalogid" data-placeholder="<?=getLanguage('chon-khoa-hoc')?>">
					<option value=""></option>
					<?php foreach($catalogs as $item){?>
					<option <?php if($item->id == $finds->catalogid){ echo 'selected';}?>  value="<?=$item->id;?>"><?=$item->trainingcourse_name;?></option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ket-qua-dao-tao');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_result_status"  id="input_result_status" class="form-input form-control " 
				value="<?=$finds->result_status;?>" placeholder="<?=getLanguage('nhap-ket-qua');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<?php
			$date_finish = '';
			if(!empty($finds->date_finish)){
				$date_finish = date(configs('cfdate').' H:i:s',strtotime($finds->date_finish));
			}
			$time_end = '';
			if(!empty($finds->time_end)){
				$time_end = date(configs('cfdate').' H:i:s',strtotime($finds->time_end));
			}
		
		?>
		<div class="form-group">
			<label class="control-label col-md-4" ><?=getLanguage('ngay-hoan-thanh');?>
			 (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<div class="input-group " >
					<div id="datetimepicker2" class="input-append input-group input-process">
						<input class="form-control tab-event form-input" data-format="dd/MM/yyyy" type="text" id="input_date_finish" value="<?=$date_finish;?>"></input>
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
		$('#datetimepicker2').datetimepicker({
		    locale: 'en',
			format: 'DD/MM/YYYY',
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
