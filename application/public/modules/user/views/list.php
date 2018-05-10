
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;
	if($item->activate == 1){
		$activate = 'Kích hoạt';
	}
	else{
		$activate = 'Vô hiệu';
	}
	?>
	<tr class="content edit" 
	id="<?=$item->id;?>" 
	activate="<?=$item->activate;?>" 
	groupid = "<?=$item->groupid;?>" 
	phone = "<?=$item->phone;?>"
	username = "<?=$item->username;?>"
	branchid = "<?=$item->branchid;?>"
	departmentid = "<?=$item->departmentid;?>"
	>
		<td class="text-center">
			<input id="<?=$item->id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="username"><?=$item->username;?></td>
		<td class="fullname"><?=$item->fullname;?></td>
		<td class="email"><?=$item->email;?></td>
		<td ><?=$item->phone;?></td>
		<td><?=$item->groupname;?></td>
		<td><?=$item->branch_name;?></td>
		<td><?=$item->departmanet_name;?></td>
		<td><?=$activate;?></td>
		<td class="text-center">
			<img width="60" height="40" src="<?=base_url();?>files/user/<?=$item->avatar;?>" />
		</td>
		<td class="text-center">
			<img width="60" height="40" src="<?=base_url();?>files/user/<?=$item->signatures;?>" />
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
