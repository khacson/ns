
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;
	$birthday = '';
	if(!empty($item->birthday) && $item->birthday != '0000-00-00'){
		$birthday = date(configs('cfdate'),strtotime($item->birthday));
	}
	?>
	<tr birthday="<?=$birthday;?>" class="content edit" id="<?=$id;?>" >
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="customer_code"><?=$item->customer_code;?></td>
		<td class="customer_name"><?=$item->customer_name;?></td>
		<td class="phone"><?=$item->phone;?></td>
		<td class="email"><?=$item->email;?></td>
		<td class="address"><?=$item->address;?></td>
		<td class="birthday text-center"><?=$birthday;?></td>
		<td class="mst text-center"><?=$item->mst;?></td>
		<td></td>
	</tr>

<?php $i++;}?>
