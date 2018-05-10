
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;	
	$approved = $item->approved;
	if($approved == -1){
		$status = '<a class="btn btn-warning" style="padding:0 3px;"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> '.getLanguage('cho-duyet').'</a>';
	}
	elseif($approved == 1){
		$status = '<a class="btn btn-info" style="padding:0 3px;">'.getLanguage('da-duyet').'</a>';
	}
	else{
		$status = '<a class="btn btn-danger" style="padding:0 3px;">'.getLanguage('khong-duyet').'</a>';
	}
	$fromdate = '';
	if(!empty($item->fromdate)){
		$fromdate = date(configs('cfdate'),strtotime($item->fromdate));
	}
	$todate = '';
	if(!empty($item->todate)){
		$todate = date(configs('cfdate'),strtotime($item->todate));
	}
	?>
	<tr class="content edit" id="<?=$id;?>" >
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="departmanet_name"><?=$item->departmanet_name;?></td>
		<td class="phone"><?=$item->academic_name;?></td>
		<td class="fax"><?=$item->request;?></td>
		<td class="quantity text-right"><?=$item->quantity;?></td>
		<td><?=$item->note;?></td>
		<td class="text-center" data-toggle="modal" data-target="#myModalFrom" id="<?=$id;?>">
			<?=$status;?>
		</td>
		<td class="text-center">
			<?=$fromdate;?>
		</td>
		<td class="text-center">
			<?=$todate;?>
		</td>
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
