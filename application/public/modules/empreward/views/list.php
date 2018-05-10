
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;	
	$isinsurrance = '';
	if($item->isinsurrance == 1){
		$isinsurrance = '<a class="btn btn-info" style="padding:0 3px;">'.getLanguage('co').'</a>';
	}
	elseif($item->isinsurrance == 0){
		$isinsurrance = '<a class="btn btn-warning" style="padding:0 3px;">'.getLanguage('khong').'</a>';
	}
	$statusid = '';
	if($item->statusid == 1){
		$statusid = '<a class="btn btn-info" style="padding:0 3px;">'.getLanguage('chuyen-tien-rieng').'</a>';
	}
	elseif($item->statusid == 2){
		$statusid = '<a class="btn btn-warning" style="padding:0 3px;">'.getLanguage('cong-luong-thang').'</a>';
	}
	$ispay = '';
	if($item->ispay == 1){
		$ispay = '<a class="btn btn-info" style="padding:0 3px;">'.getLanguage('da-thanh-toan').'</a>';
	}
	elseif($item->ispay == 0){
		$ispay = '<a class="btn btn-warning" style="padding:0 3px;">'.getLanguage('chua-thanh-toan').'</a>';
	}
	?>
	<tr class="content edit" id="<?=$id;?>" employeeid="<?=$item->employeeid;?>">
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="departmanet_name"><?=$item->departmanet_name;?></td>
		<td class="code"><?=$item->code;?></td>
		<td class="fullname"><?=$item->fullname;?></td>
		
		
		<td class="date_reward text-center"><?=date('d/m/Y',strtotime($item->date_reward));?></td>
		<td class="reward_content"><?=$item->reward_content;?></td>
		<td class="money text-right"><?=number_format($item->money);?></td>
		<td class="text-center"><?=$isinsurrance;?></td>
		<td class="text-center"><?=$statusid;?></td>
		<td class="text-center"><?=$ispay;?></td>
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
