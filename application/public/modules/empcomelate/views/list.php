
<?php 	$i = $start; 
foreach ($datas as $key => $item) { 	
	?>
	<tr class="edit" id="<?=$item->id;?>" absent_times="<?=$item->absent_times;?>" departmentid = "<?=$item->departmentid;?>" staffid = "<?=$item->staffid;?>">
		
		<td style="text-align: center;">
			<input id="<?=$item->id;?>" class="check" type="checkbox" value="<?=$item->id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="fullname"><?=$item->fullname;?></td>
		<td class="code"><?=$item->code;?></td>
		<td class="absent_date text-center"><?=date('d-m-Y',strtotime($item->absent_date));?></td>
		<td class="absent_times"></td>
		<td class="absent_content"><?=$item->absent_content;?></td>
		<td class="departmanet_name "><?=$item->departmanet_name;?></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>

<?php $i++;}?>
