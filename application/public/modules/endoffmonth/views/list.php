
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;	
	$date_start = '';
	if(!empty($item->date_start)){
		$date_start = date(configs('cfdate'),strtotime($item->date_start));
	}
	$date_end = '';
	if(!empty($item->date_end)){
		$date_end = date(configs('cfdate'),strtotime($item->date_end));
	}
	?>
	<tr class="content edit" id="<?=$id;?>" >
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="monthyear"><?=$item->monthyear;?></td>
		<td class="date_start text-center"><?=$date_start;?></td>
		<td class="date_end text-center"><?=$date_end;?></td>
		<td class="number_days text-center"><?=$item->number_days;?></td>
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
