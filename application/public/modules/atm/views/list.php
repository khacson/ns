
<?php 	$i = $start;
foreach ($datas as $key => $item){
	$identityfrom = '';
	if(!empty($arrProvinces[$item->identity_from])){
		$identityfrom = $arrProvinces[$item->identity_from];
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
		<td class="departmanet_name"><?=$item->departmanet_name;?></td>
		<td class="code"><?=$item->code;?></td>
		<td class="fullname"><?=$item->fullname;?></td>
		<td class="identity"><?=$item->identity;?></td>
		<td class="identity_date"><?=date(configs('cfdate',strtotime($item->identity_date)));?></td>
		<td class="identityfrom"><?=$identityfrom;?></td>	
		<td class="bank_accout"><?=$item->bank_accout;?></td>
		<td class="bank_name"><?=$item->bank_name;?></td>
		<td class="tax_code"><?=$item->tax_code;?></td>
		<td class="position_name"><?=$item->position_name;?></td>
		<td></td>
	</tr>

<?php $i++;}?>
