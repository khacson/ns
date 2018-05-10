<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('quan-huyen');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<input type="text" name="input_distric_name"  id="input_distric_name" class="form-input form-control tab-event" 
				value="<?=$finds->distric_name;?>" placeholder="<?=getLanguage('nhap-quan-huyen');?>"
				/>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('tinh-thanh-pho');?> </label>
			<div class="col-md-8">
				<select id="input_provinceid" name="input_provinceid" class="combos-input" >
					<option value=""></option>
					<?php foreach($provinces as $item){?>
						<option <?php if($item->id == $finds->provinceid){ echo 'selected';}?> value="<?=$item->id;?>"><?=$item->province_name;?></option>
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
		$('#input_distric_name').select();
		$('#input_provinceid').multipleSelect({
			filter: true,
			single: true,
			placeholder: '<?=getLanguage('chon-tinh-thanh-pho')?>'
		});
	}
</script>
