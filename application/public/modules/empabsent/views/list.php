
<?php 	$i = $start; 
foreach ($datas as $key => $item) { 	
	?>
	<tr class="edit" id="<?=$item->id;?>" group_work_id="<?=$item->group_work_id;?>" departmentid = "<?=$item->departmentid;?>" identity = "<?=$item->identity;?>">
		
		<td style="text-align: center;">
			<input id="<?=$item->id;?>" class="check noClick" type="checkbox" value="<?=$item->id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="departmanet_name "><?=$item->departmanet_name;?></td>
		<td class="code"><?=$item->code;?></td>
		<td class="fullname"><?=$item->fullname;?></td>
		<td class="time_start text-center"><?=$datenow;?></td>
		<td><?=$item->position_name;?></td>
		<td><?=$item->departmentgroup_name;?></td>
		<td></td>
	</tr>

<?php $i++;}?>
