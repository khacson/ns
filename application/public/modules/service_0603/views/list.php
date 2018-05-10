<?php 
	$i= $start;
	foreach ($datas as $item) { 
		
	?>
		<tr class="content edit" id="<?=$item->id;?>" >
			<td style="text-align: center;">
			<input class="check" type="checkbox" name="keys[]" id="<?=$item->id; ?>"></td>
			<td class="center"><?=$i;?></td>
			<td class="customer_name"><?=$item->customer_name;?></td>
			<td class="customer_phone"><?=$item->customer_phone;?></td> 
			<td class="customer_email"><?=$item->customer_email;?></td> 
			<td class="customer_address"><?=$item->customer_address;?></td> 
			<td class="customer_contact"><?=$item->customer_contact;?></td> 
			<td></td>
		</tr>
	<?php	
	$i++;
	}

?>