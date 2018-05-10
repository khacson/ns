
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;	
	$time_start = '';
	if(!empty($item->time_start) && $item->time_start != '0000-00-00'){
		$time_start = date(configs('cfdate'),strtotime($item->time_start));
	}
	$time_end = '';
	if(!empty($item->time_end) && $item->time_end != '0000-00-00'){
		$time_end = date(configs('cfdate'),strtotime($item->time_end));
	}
	?>
	<tr class="content edit" id="<?=$id;?>" >
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="trainingcourse_name"><?=$item->trainingcourse_name;?></td>
		<td class="text-center"><?=$time_start;?></td>
		<td class="text-center"><?=$time_end;?></td>
		<td><?=$item->description;?></td>
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
