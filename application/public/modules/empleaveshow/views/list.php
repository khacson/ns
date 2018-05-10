
<?php 	$i = $start; 
foreach ($datas as $key => $item) { 
	$id = $item->id;
	?>
	<tr class="edit" id="<?=$item->id;?>" group_work_id="<?=$item->group_work_id;?>" departmentid = "<?=$item->departmentid;?>" identity = "<?=$item->identity;?>">
		
		<td style="text-align: center;">
			<input id="<?=$item->id;?>" class="check noClick" type="checkbox" value="<?=$item->id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		
		<td class="code"><?=$item->code;?></td>
		<td class="fullname"><?=$item->fullname;?></td>
		<td class="time_start text-center"><?=date(configs('cfdate').' H:i:s',strtotime($item->time_start));?></td>
		<td class="time_end text-center"><?=date(configs('cfdate').' H:i:s',strtotime($item->time_end));?></td>
		<td class="departmanet_name "><?=$item->departmanet_name;?></td>
		<td><?=$item->position_name;?></td>
		<td><?=$item->departmentgroup_name;?></td>
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
