
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;
	$dateoff = '';
	if(!empty($item->dateoff) && $item->dateoff != '0000-00-00'){
		$dateoff = $item->dateoff;
	}
	$datework = '';
	if(!empty($item->datework) && $item->datework != '0000-00-00'){
		$datework = $item->datework;
	}	
	$typeid = '';
	if($item->typeid == 1){
		$typeid = getLanguage('nghi-co-luong');
	}
	elseif($item->typeid == 2){
		$typeid = getLanguage('nghi-khong-luong');
	}
	?>
	<tr class="content edit" id="<?=$id;?>" >
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="dateoff text-center"><?=$dateoff;?></td>
		<td class="datework text-center"><?=$datework;?></td>
		<td class="typeid"><?=$typeid;?></td>
		<td class="description"><?=$item->description;?></td>
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
