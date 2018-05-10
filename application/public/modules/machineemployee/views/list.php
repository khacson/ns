
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;	
	?>
	<tr class="content edit" id="<?=$id;?>" >
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="employee_code"><?=$item->employee_code;?></td>
		<td class="fullname"><?=$item->fullname;?></td>
		<td class="password"><?=$item->password;?></td>
		<td class="privilege"><?=$item->privilege;?></td>
		<td class="enabled"><?=$item->enabled;?></td>
		<td class="version"><?=$item->version;?></td>
		<td class="Flag1"><?=$item->Flag1;?></td>
		<td class="TmpData1"><?=$item->TmpData1;?></td>
		<td class="TmpLength1"><?=$item->TmpLength1;?></td>
		<td class="Flag2"><?=$item->Flag2;?></td>
		<td class="TmpData2"><?=$item->TmpData2;?></td>
		<td class="TmpLength2"><?=$item->TmpLength2;?></td>
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
