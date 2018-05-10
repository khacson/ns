
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;
	?>
	<tr class="content edit" id="<?=$id;?>" >
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="manufacture_name"><?=$item->manufacture_name;?></td>
		<td class="text-center">
			<img width="60" height="40" src="<?=base_url();?>files/manufacture/<?=$item->image;?>" />
		</td>
		<td></td>
	</tr>

<?php $i++;}?>
