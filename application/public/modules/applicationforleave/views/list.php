
<?php 	$i = $start; 
foreach ($datas as $key => $item) { 
	$id = $item->id;
	$approved = '<a approved="1" id="'.$id.'" href="#" data-toggle="modal"  class="btn btn-warning edititem" style="padding:0 3px;"> 
 '.getLanguage('cho-duyet').'</a>';
	if($item->approved == 1){
		$approved = '<a class="btn btn-info" style="padding:0 3px;">'.getLanguage('da-duyet').'</a>';
	}
	elseif($item->approved == 0){
		$approved = '<a class="btn btn-danger" style="padding:0 3px;">'.getLanguage('khong-duyet').'</a>';
	}
	$total =  '<a class="btn btn-warning" style="padding:0 3px;">'.getLanguage('con').' '.$item->total .' '.getLanguage('ngay').'</a>';
	
	$approved_date = '';
	if(!empty($item->approved_date) && $item->approved_date != '0000-00-00 00:00:00'){
		$approved_date = date(configs('cfdate').' H:i:s',strtotime($item->approved_date));
	}
	
	?>
	
	<tr <?php if($item->approved != 1){?> class="edit" <?php }?> id="<?=$item->id;?>" group_work_id="<?=$item->group_work_id;?>" departmentid = "<?=$item->departmentid;?>" identity = "<?=$item->identity;?>">
		
		<td style="text-align: center;">
			<?php if($item->approved != 1){?>
				<input id="<?=$item->id;?>" class="check noClick" type="checkbox" value="<?=$item->id; ?>" name="keys[]">
			<?php }?>
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="code"><?=$item->code;?></td>
		<td class="fullname"><?=$item->fullname;?></td>
		<td class="time_end text-center">
			<?=date(configs('cfdate').' H:i:s',strtotime($item->time_start));?><br>
			<?=date(configs('cfdate').' H:i:s',strtotime($item->time_end));?>
		</td>
		<td class="text-center"><?=$item->numberof;?></td>
		<td class="description">
			<?=$item->description;?>
		</td>
		<td class="text-center"><?=$total;?></td>
		<td class="text-center">
			<?=$approved;?>
		</td>
		<td class="text-center">
			<?=$approved_date;?>
		</td>
		<td>
			<?=$item->fullnameapproved;?>
		</td>
		<td><?=$item->approved_description;?></td>
		<td class="departmanet_name "><?=$item->departmanet_name;?></td>
		<td class="text-center">
			<?php if(isset($permission['edit'])){?>
				<a id="<?=$id;?>" approved="0" class="btn btn-info edititem" href="#" data-toggle="modal" data-target="#myModalFrom">
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
