
<?php 	$i = $start;
foreach ($datas as $key => $item){
	$date_start = '';
	if(!empty($item->date_start) && $item->date_start != '0000-00-00'){
		$date_start = date(configs('cfdate',strtotime($item->date_start)));
	}
	$contrac_date = '';
	if(!empty($item->contrac_date) && $item->contrac_date != '0000-00-00'){
		$contrac_date = date(configs('cfdate',strtotime($item->contrac_date)));
	}
	$contac_expired_date = '';
	if(!empty($item->contac_expired_date) && $item->contac_expired_date != '0000-00-00'){
		$contac_expired_date = date(configs('cfdate',strtotime($item->contac_expired_date)));
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
		<td class="text-center"><?=$date_start;?></td>
		<td class="text-center"><?=$contrac_date;?></td>	
		<td class="text-center"><?=$contac_expired_date;?></td>
		<td class="position_name"><?=$item->position_name;?></td>
		<td></td>
	</tr>

<?php $i++;}?>
