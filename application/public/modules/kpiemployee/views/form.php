<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('phong-ban')?></label>
			<div class="col-md-8">
				<select class="form-input form-control select2me" id="input_departmentid" name="input_departmentid"  data-placeholder="<?=getLanguage('chon-phong-ban')?>">
					<option value=""></option>
					<?php foreach($departments as $item){?>
					<option <?php if($item->id == $departmentid){?> selected <?php }?> value="<?=$item->id;?>"><?=$item->departmanet_name;?></option>
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
						<option <?php if($employeeid == $item->id){?> selected <?php }?> value="<?=$item->id;?>"><?=$item->code;?> - <?=$item->fullname;?></option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('thang');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<select id="input_monthid" name="input_monthid" class="select2me form-input form-control" data-placeholder="<?=getLanguage('chon-thang')?>"> 
					<option value=""></option>
					<?php foreach($months as $item){?>
						<option <?php if($item->id == $monthid){?> selected <?php }?> value="<?=$item->id;?>"><?=$item->monthyear;?></option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="col-md-12" style=" border-top:1px dashed #999;"></div>
	</div>
	<?php $i=1; 
		foreach($kpis as $item){
			if(!empty($kpiemployee[$item->id])){
				$point = $kpiemployee[$item->id];
			}
			else{
				$point = $item->kpi_point_max;
			}
		?>
		<div class="col-md-12 mtop10">
			<div class="form-group">
				<label class="control-label col-md-4"><?=$item->kpi_name;?></label>
				<div class="col-md-8">
					<input type="text" name="input_kpi_<?=$item->id;?>"  id="input_kpi_<?=$item->id;?>" class="form-input form-control" value="<?=$point;?>"  placeholder="Max: <?=$item->kpi_point_max;?>"/>
					<input type="hidden" class="form-input" name="input_max_kpi_<?=$item->id;?>"  id="input_max_kpi_<?=$item->id;?>"  value="<?=$item->kpi_point_max;?>"/>
				</div>
			</div>
		</div>
	<?php $i++;}?>
	<div class="col-md-12 mtop10">
		<div class="col-md-12" style=" border-top:1px dashed #999;"></div>
	</div>
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
		//$('#input_ethnic_name').select();
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
