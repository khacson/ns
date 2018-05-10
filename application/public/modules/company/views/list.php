
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;
	?>
	<tr class="content edit" 
		id="<?=$id;?>" 
		datestart="<?=$item->datestart;?>"
		dateend="<?=$item->dateend;?>"
		>
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="company_name"><?=$item->company_name;?></td>
		<td class="address"><?=$item->address;?></td>
		<td class="phone"><?=$item->phone;?></td>
		<td class="fax"><?=$item->fax;?></td>
		<td class="email"><?=$item->email;?></td>
		<td class="mst"><?=$item->mst;?></td>
		<td class="datestart"><?=date('d M Y',strtotime($item->datestart));?></td>
		<td class="dateend"><?=date('d M Y',strtotime($item->dateend));?></td>
		<td class="text-center">
			<img width="60" height="40" src="<?=base_url();?>files/company/<?=$item->logo;?>" />
		</td>
		<td></td>
	</tr>

<?php $i++;}?>
