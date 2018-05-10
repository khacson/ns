
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;	
	$date_finish = '';
	if(!empty($item->date_finish) && $item->date_finish != '0000-00-00'){
		$date_finish = date(configs('cfdate'),strtotime($item->date_finish));
	}
	?>
	<tr class="content edit" 
		id="<?=$id;?>" 
		departmentid="<?=$departmentid;?>" 
		catalogid="<?=$catalogid;?>" 
		>
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		
		<td class="code"><?=$item->code;?></td>
		<td class="fullname"><?=$item->fullname;?></td>
		<td class="trainingcourse_name"><?=$item->trainingcourse_name;?></td>
		<td class="result_status"><?=$item->result_status;?></td>
		<td class="date_finish text-center"><?=$date_finish;?></td>
		<td><?=$item->description;?></td>
		<td class="departmanet_name "><?=$item->departmanet_name;?></td>
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
