<?php 	$i = $start;
foreach ($datas as $key => $item){
	if($item->sex == 1){
		$sex = 'Nam';
	}
	else if($item->sex == 2){
		$sex = 'Nữ';
	}
	else if($item->sex == -1){
		$sex = 'Giới tính khác';
	}
	else{
		$sex = '';
	}
	$marriage = '';
	if($item->marriage == 1){
		$marriage = 'Đã có gia đình';
	}
	else if($item->sex == 2){
		$marriage = 'Độc thân';
	}
	else if($item->marriage == -1){
		$marriage = 'Khác';
	}
	$birthday = '';
	if(!empty($item->birthday) && $item->birthday != '0000-00-00'){
		$birthday = date(configs('cfdate',strtotime($item->birthday)));
	}
	$nationality = '';
	if($item->nationality == 1){
		$nationality = 'Việt Nam';
	}
	elseif($item->nationality == -1){
		$nationality = 'Khác';
	}
	$ethnics = '';
	if(!empty($arrEthnics[$item->ethnicid])){
		$ethnics = $arrEthnics[$item->ethnicid];
	}
	//
	$religions = '';
	if(!empty($arrReligions[$item->religionid])){
		$religions = $arrReligions[$item->religionid];
	}
	$identityfrom = '';
	if(!empty($arrProvinces[$item->identity_from])){
		$identityfrom = $arrProvinces[$item->identity_from];
	}
	//arrAcademics
	$academiclevel = '';
	if(!empty($arrAcademics[$item->academic_level])){
		$academiclevel = $arrAcademics[$item->academic_level];
	}
	//arrJobstatus jobstatusid
	$jobstatus = '';
	if(!empty($arrJobstatus[$item->jobstatusid])){
		$jobstatus = $arrJobstatus[$item->jobstatusid];
	}
	
	?>
	<tr class="content edit" positionid="<?=$item->positionid;?>" departmentid="<?=$item->departmentid;?>" 
	id="<?=$item->id;?>"  jobstatusid="<?=$item->jobstatusid;?>" academic_level="<?=$item->academic_level;?>" ethnicid="<?=$item->ethnicid;?>" religionid="<?=$item->religionid;?>" group_work_id = "<?=$item->group_work_id;?>"  
	>
		
		<td style="text-align: center;">
			<input id="<?=$item->id;?>" class="check" type="checkbox" value="<?=$item->id; ?>" name="keys[]">
		</td>
		<td class="text-center">
		<a  class="btn btn-success" href="<?=base_url();?>employeefile?code=<?=$item->code;?>"><?=$i;?></a></td>
		<td class="code"><?=$item->code;?></td>
		<td class="fullname"><?=$item->fullname;?></td>
		<td class="sex" ><?=$sex;?></td>
		<td class="birthday"><?=$birthday;?></td>
		<td class="place_of_birth"><?=$item->place_of_birth;?></td>
		<td class="marriage"><?=$marriage;?></td>
		<td class="email"><?=$nationality;?></td>
		<td class="ethnicid"><?=$ethnics;?></td>
		<td class="religionid"><?=$religions;?></td>
		<td class="identity"><?=$item->identity;?></td>
		<td class="identity_date"><?=date(configs('cfdate',strtotime($item->identity_date)));?></td>
		<td class="identityfrom"><?=$identityfrom;?></td>		
		<td class="academiclevel"><?=$academiclevel;?></td>
		<td class="academic_skills"><?=$item->academic_skills;?></td>
		<td class="position_name"><?=$item->position_name;?></td>
		<td class="departmanet_name"><?=$item->departmanet_name;?></td>
		<td class="departmentgroup_name"><?=$item->departmentgroup_name;?></td>
		<td class="date_start text-center"><?=date(configs('cfdate',strtotime($item->date_start)));?></td>
		<td class="contrac_date text-center"><?=date(configs('cfdate',strtotime($item->contrac_date)));?></td>
		<td class="contrac_code"><?=$item->contrac_code;?></td>
		<td class="contac_expired_date text-center"><?=date(configs('cfdate',strtotime($item->contac_expired_date)));?></td>
		<td class="insurance_code"><?=$item->insurance_code;?></td>
		<td class="insurance_hospital"><?=$item->insurance_hospital;?></td>
		<td class="tax_code"><?=$item->tax_code;?></td>
		<td class="bank_accout"><?=$item->bank_accout;?></td>
		<td class="bank_name"><?=$item->bank_name;?></td>
		<td class="jobstatus"><?=$jobstatus;?></td>
		<td class="family_name"><?=$item->family_name;?></td>
		<td class="family_phone"><?=$item->family_phone;?></td>
		<td class="family_relation"><?=$item->family_relation;?></td>
	</tr>

<?php $i++;}?>
