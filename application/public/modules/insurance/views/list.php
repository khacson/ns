
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;	
	$insurance_type = '';
	if(isset($types[$item->insurance_type])){
		$insurance_type = $types[$item->insurance_type];
	}
	?>
	<tr class="content edit" id="<?=$id;?>" insurance_type="<?=$item->insurance_type;?>">
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="insurance_name"><?=$item->insurance_name;?></td>
		<td class="insurance_value text-right"><?=number_format($item->insurance_value);?></td>
		<td class="insurance_type"><?=$insurance_type;?></td>
		<td class="text-center">
			<?php if(isset($permission['edit'])){?>
				<a id="<?=$id;?>" class="btn btn-info edititem" href="#" data-toggle="modal" data-target="#myModalFrom">
				<i class="fa fa-pencil" aria-hidden="true"></i>
				</a>
			<?php }?>
			<?php if(isset($permission['delete'])){?>
				<a id="<?=$id;?>" class="btn btn-danger deleteitem mleft10" href="#" data-toggle="modal" data-target="#myModal">
				<i class="fa fa-times" aria-hidden="true"></i>
				</a>
			<?php }?>
		</td>
		<td></td>
	</tr>

<?php $i++;}?>
