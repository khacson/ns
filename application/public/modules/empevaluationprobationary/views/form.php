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
		<div class="col-md-12" style=" border-top:1px dashed #999;"></div>
	</div>
	<?php $i=1; 
		$statusid = ''; $description = '';
		foreach($criteriaProbationary as $item){
			if(!empty($cemployee[$item->id])){
				$point = $cemployee[$item->id]->point;
				$statusid = $cemployee[$item->id]->statusid;
				$description = $cemployee[$item->id]->description;
			}
			else{
				$point = '';
			}
		?>
		<div class="col-md-12 mtop10">
			<div class="form-group">
				<label class="control-label col-md-4"><?=$item->aprobationary_name;?></label>
				<div class="col-md-8">
					<input type="text" name="input_kpi_<?=$item->id;?>"  id="input_kpi_<?=$item->id;?>" class="form-input form-control" value="<?=$point;?>"  />
				</div>
			</div>
		</div>
	<?php $i++;}?>
	<div class="col-md-12 mtop10">
		<div class="col-md-12" style=" border-top:1px dashed #999;"></div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ket-qua');?></label>
			<div class="col-md-8" id="loademployees">
				<select id="input_statusid" name="input_statusid" class="select2me form-input form-control " data-placeholder="<?=getLanguage('chon-ket-qua')?>">
					<option value=""></option>
					<option <?php if($statusid == 1){?> selected <?php }?> value="1"><?=getLanguage('dat');?></option>
					<option <?php if($statusid == 2){?> selected <?php }?> value="2"><?=getLanguage('tiep-tuc-dao-tao');?></option>
					<option <?php if($statusid == 3){?> selected <?php }?> value="3"><?=getLanguage('khong-dat');?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4" style="white-space:nowrap"><?=getLanguage('ghi-chu')?></label>
			<div class="col-md-8">
				<input type="text" name="description" id="description" placeholder="<?=getLanguage('nhap-ghi-chu')?>" class="form-input form-control" value="<?=$description;?>" />
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
