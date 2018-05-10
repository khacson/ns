<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('to-nhom');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_departmentgroup_name"  id="input_departmentgroup_name" class="form-input form-control tab-event" 
				value="<?=$finds->departmentgroup_name;?>" placeholder="<?=getLanguage('nhap-to-nhom');?>" 
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('bo-phan');?> </label>
			<div class="col-md-8">
				<select id="input_departmentid" name="input_departmentid" class="combos-input" >
					<option value=""></option>
					<?php foreach($departments as $item){?>
						<option <?php if($item->id == $finds->departmentid){ echo 'selected';}?> value="<?=$item->id;?>"><?=$item->departmanet_name;?></option>
					<?php }?>
				</select>
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
		$('#input_departmentgroup_name').select();
		$('#input_departmentid').multipleSelect({
			filter: true,
			single: true,
			placeholder: '<?=getLanguage('chon-bo-phan')?>'
		});
	}
</script>
