<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('nhan-vien');?> (<span class="red">*</span>)</label>
			<div class="col-md-8">
				<select id="input_employeeid" name="input_employeeid" class="select2me form-input form-control " data-placeholder="<?=getLanguage('chon-nhan-vien')?>">
					<option value=""></option>
					<?php foreach($employees as $item){?>
						<option <?php if($item->id == $finds->employeeid){ echo 'selected';}?> value="<?=$item->id;?>"><?=$item->code;?> - <?=$item->fullname;?></option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label col-md-4"><?=getLanguage('ky-luong')?></label>
			<div class="col-md-8">
				<select id="input_endoffmonthid" name="input_endoffmonthid" class="select2me form-input form-control " data-placeholder="<?=getLanguage('chon-ky-luong')?>">
					<?php foreach($endoffmonths as $item){
						?>
					<option <?php if($item->id == $finds->endoffmonthid){ echo 'selected';}?> value="<?=$item->id;?>"><?=$item->monthyear;?></option>
					<?php }?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="col-md-12"><div style="border-top:1px dashed #999; height:1px; width:100%;"></div></div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-2"><b><?=getLanguage('luong-co-ban');?></b> </label>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-3" style="padding-left:10px;">
						<b><?=getLanguage('so-tien');?></b>
					</div>
					<div class="col-md-3" style="padding-left:0px;">
						<b><?=getLanguage('tinh-bao-hiem')?></b>
					</div>
					<div class="col-md-3" style="padding-left:0px;">
						<b><?=getLanguage('tinh-thue-thu-nhap')?></b>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-2"><b><?=getLanguage('luong');?></b> (<span class="red">*</span>)</label>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-3" style="padding-left:10px;">
						<input type="text" name="input_salary"  id="input_salary" class="form-input form-control fm-number" 
						value="<?=$finds->salary;?>"/>
					</div>
					<div class="col-md-3" style="padding-left:0px;">
						<select id="input_isinsurances" name="input_isinsurances" class="select2me allowance form-control " data-placeholder="<?=getLanguage('tinh-bao-hiem');?>">
							 <option value="1"><?=getLanguage('co')?></option>
							 <option value="-1"><?=getLanguage('khong')?></option>
						</select>
					</div>
					<div class="col-md-3" style="padding-left:0px;">
						<select id="input_istaxs" name="input_istaxs" class="select2me allowance form-control " data-placeholder="<?=getLanguage('tinh-thue-thu-nhap');?>">
							 <option value="1"><?=getLanguage('co')?></option>
							 <option value="0"><?=getLanguage('khong')?></option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="col-md-12"><div style="border-top:1px dashed #999; height:1px; width:100%;"></div></div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-2"><b><?=getLanguage('phu-cap');?></b></label>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-3" style="padding-left:10px;">
						<b><?=getLanguage('so-tien');?></b>
					</div>
					<div class="col-md-3" style="padding-left:0px;">
						<b><?=getLanguage('cach-tinh');?></b>
					</div>
					<div class="col-md-3" style="padding-left:0px;">
						<b><?=getLanguage('tinh-bao-hiem')?></b>
					</div>
					<div class="col-md-3" style="padding-left:0px;">
						<b><?=getLanguage('tinh-thue-thu-nhap')?></b>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php foreach($allowances as $item){
		$allowanceS = 0;
		$typeid = 1;
		if(!empty($allowanceSalarys[$finds->employeeid][$item->id])){
			$allowanceS = $allowanceSalarys[$finds->employeeid][$item->id]->salary;
			$typeid = $allowanceSalarys[$finds->employeeid][$item->id]->typeid;
		}
		?>
		<div class="col-md-12 mtop10">
			<div class="form-group">
				<label class="control-label col-md-2"><?=$item->allowance_name;?></label>
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-3" style="padding-left:10px;">
							<input type="text" name="input_<?=$item->id;?>"  id="input_<?=$item->id;?>" class="form-input form-control allowance fm-number" 
							value="<?=$allowanceS;?>"
							/>
						</div>
						<div class="col-md-3" style="padding-left:0;">
							<select id="input_typeid_<?=$item->id;?>" name="input_typeid_<?=$item->id;?>" class="select2me allowance form-control " data-placeholder="<?=getLanguage('chon-trang-thai')?>">
								 <option <?php if($typeid == 1){?> selected <?php }?> value="1"><?=getLanguage('cong')?></option>
								 <option <?php if($typeid == -1){?> selected <?php }?> value="-1"><?=getLanguage('tru')?></option>
							</select>
						</div>
						<div class="col-md-3" style="padding-left:0;">
							<select id="input_isinsurance_<?=$item->id;?>" name="input_isinsurance_<?=$item->id;?>" class="select2me allowance form-control " data-placeholder="<?=getLanguage('tinh-bao-hiem');?>">
								 <option <?php if($typeid == 1){?> selected <?php }?> value="1"><?=getLanguage('co')?></option>
								 <option <?php if($typeid == 0){?> selected <?php }?> value="-1"><?=getLanguage('khong')?></option>
							</select>
						</div>
						<div class="col-md-3" style="padding-left:0;">
							<select id="input_istax_<?=$item->id;?>" name="input_istax_<?=$item->id;?>" class="select2me allowance form-control " data-placeholder="<?=getLanguage('tinh-thue-thu-nhap');?>">
								 <option <?php if($typeid == 1){?> selected <?php }?> value="1"><?=getLanguage('co')?></option>
								 <option <?php if($typeid == 0){?> selected <?php }?> value="0"><?=getLanguage('khong')?></option>
							</select>
						</div>
					 </div>
				</div>
			</div>
		</div>
	<?php }?>
	<div class="col-md-12 mtop10">
		<div class="form-group">
			<label class="control-label col-md-2"><?=getLanguage('loai-luong');?></label>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-3" style="padding-left:10px;">
						<select id="input_salary_status" name="input_salary_status" class="select2me form-input form-control " data-placeholder="<?=getLanguage('chon-loai-luong')?>">
							<option <?php if($finds->salary_status == 1){?> selected <?php }?> value="1"><?=getLanguage('net');?></option>
							<option <?php if($finds->salary_status == 2){?> selected <?php }?> value="2"><?=getLanguage('gross');?></option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 mtop10">
		<div class="col-md-12"><div style="border-top:1px dashed #999; height:1px; width:100%;"></div></div>
	</div>
</div>
<?php
	//print_r($finds);
?>
<script>
	$(function(){
		formatNumber('fm-number');
		formatNumberKeyUp('fm-number');
		handleSelect2();
		initForm();
	});
	function initForm(){
	}
	function getAllowance() {
	var objReq = {};
	$(".allowance").each(function(i) {
		var id = $(this).attr('id');
		var val = $(this).val();
		val = val.replace(/['"]/g, '');
		if(id != undefined){ // neu co dinh nghia id la gi
			var ids = id.replace('input_','');
			var res = id.substring(0, 4); 
			if(res != 's2id'){
				objReq[ids] = val;
			}
		}
	});
	return JSON.stringify(objReq);
}
</script>
