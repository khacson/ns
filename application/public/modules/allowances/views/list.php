
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;	
	$allowance_type = '';
	if(isset($types[$item->allowance_type])){
		$allowance_type = $types[$item->allowance_type];
	}
	?>
	<tr class="content edit" id="<?=$id;?>" allowance_type="<?=$item->allowance_type;?>">
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="allowance_name"><?=$item->allowance_name;?></td>
		<td class="allowance_money text-right"><?=number_format($item->allowance_money);?></td>
		<td class="allowance_type"><?=$allowance_type;?></td>
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
