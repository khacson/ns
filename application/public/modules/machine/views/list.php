
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;	
	$shutdown_date_sync = '';
	if(!empty($item->shutdown_date_sync)){
		$shutdown_date_sync = date(configs('cfdate').' H:i:s',strtotime($item->shutdown_date_sync));
	}
	$restart_date_sync = '';
	if(!empty($item->restart_date_sync)){
		$restart_date_sync = date(configs('cfdate').' H:i:s',strtotime($item->restart_date_sync));
	}
	$upload_date_sync = '';
	if(!empty($item->upload_date_sync)){
		$upload_date_sync = date(configs('cfdate').' H:i:s',strtotime($item->upload_date_sync));
	}
	$download_date_sync = '';
	if(!empty($item->download_date_sync)){
		$download_date_sync = date(configs('cfdate').' H:i:s',strtotime($item->download_date_sync));
	}
	$delete_date_sync = '';
	if(!empty($item->delete_date_sync)){
		$delete_date_sync = date(configs('cfdate').' H:i:s',strtotime($item->delete_date_sync));
	}
	$delete_file_date_sync = '';
	if(!empty($item->delete_file_date_sync)){
		$delete_file_date_sync = date(configs('cfdate').' H:i:s',strtotime($item->delete_file_date_sync));
	}
	$fingerprint_date_sync = '';
	if(!empty($item->fingerprint_date_sync)){
		$fingerprint_date_sync = date(configs('cfdate').' H:i:s',strtotime($item->fingerprint_date_sync));
	}
	$fingerprint_date_to = '';
	if(!empty($item->fingerprint_date_to)){
		$fingerprint_date_to = date(configs('cfdate'),strtotime($item->fingerprint_date_to));
	}
	$fingerprint_date_from = '';
	if(!empty($item->fingerprint_date_from)){
		$fingerprint_date_from = date(configs('cfdate'),strtotime($item->fingerprint_date_from));
	}
	?>
	<tr class="content edit" id="<?=$id;?>" >
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="machine_sn"><?=$item->machine_sn;?></td>
		<td class="text-center">
			<?php if($item->shutdown == 1){?>
				<a class="btn btn-warning" style="border-radius:3; padding:1px 3px;">
					Syncing
				</a>
			<?php }elseif($item->shutdown == 2){?>
				<a id="viewtotal2" class="btn btn-info" style="border-radius:3; padding:1px 3px;">
					Updated
				</a>
			<?php }else{?>
				
			<?php }?>
		</td>
		<td class="text-center">
			<?=$shutdown_date_sync;?>
		</td>
		<!--shutdown-->
		<td class="text-center">
			<?php if($item->restart == 1){?>
				<a class="btn btn-warning" style="border-radius:3; padding:1px 3px;">
					Syncing
				</a>
			<?php }elseif($item->restart == 2){?>
				<a id="viewtotal2" class="btn btn-info" style="border-radius:3; padding:1px 3px;">
					Updated
				</a>
			<?php }else{?>
				
			<?php }?>
		</td>
		<td class="text-center">
			<?=$restart_date_sync;?>
		</td>
		<!--restart-->
		<!--uploademployee-->
		<td class="text-center">
			<?php if($item->uploademployee == 1){?>
				<a class="btn btn-warning" style="border-radius:3; padding:1px 3px;">
					Syncing
				</a>
			<?php }elseif($item->uploademployee == 2){?>
				<a id="viewtotal2" class="btn btn-info" style="border-radius:3; padding:1px 3px;">
					Updated
				</a>
			<?php }else{?>
				
			<?php }?>
		</td>
		<td class="text-center">
			<?=$upload_date_sync;?>
		</td>
		<!--S downloademployee-->
		<td class="text-center">
			<?php if($item->downloademployee == 1){?>
				<a class="btn btn-warning" style="border-radius:3; padding:1px 3px;">
					Syncing
				</a>
			<?php }elseif($item->downloademployee == 2){?>
				<a id="viewtotal2" class="btn btn-info" style="border-radius:3; padding:1px 3px;">
					Updated
				</a>
			<?php }else{?>
				
			<?php }?>
		</td>
		<td class="text-center">
			<?=$download_date_sync;?>
		</td>
		<!--E downloademployee-->
		<!--S deleteemployee-->
		<td class="text-center">
			<?php if($item->deleteemployee == 1){?>
				<a class="btn btn-warning" style="border-radius:3; padding:1px 3px;">
					Syncing
				</a>
			<?php }elseif($item->deleteemployee == 2){?>
				<a id="viewtotal2" class="btn btn-info" style="border-radius:3; padding:1px 3px;">
					Updated
				</a>
			<?php }else{?>
				
			<?php }?>
		</td>
		<td class="text-center">
			<?=$delete_date_sync;?>
		</td>
		<!--E deleteemployee-->
		<!--S Delete file-->
		<td class="text-center">
			<?php if($item->delete_file == 1){?>
				<a class="btn btn-warning" style="border-radius:3; padding:1px 3px;">
					Syncing
				</a>
			<?php }elseif($item->delete_file == 2){?>
				<a id="viewtotal2" class="btn btn-info" style="border-radius:3; padding:1px 3px;">
					Updated
				</a>
			<?php }else{?>
				
			<?php }?>
		</td>
		<td class="text-center">
			<?=$delete_file_date_sync;?>
		</td>
		<!--E Delete file-->
		<!--S fingerprint-->
		<td class="text-center">
			<?php if($item->fingerprint == 1){?>
				<a class="btn btn-warning" style="border-radius:3; padding:1px 3px;">
					Syncing
				</a>
			<?php }elseif($item->fingerprint == 2){?>
				<a id="viewtotal2" class="btn btn-info" style="border-radius:3; padding:1px 3px;">
					Updated
				</a>
			<?php }else{?>
				
			<?php }?>
		</td>
		<td class="text-center">
			<?=$fingerprint_date_from;?>
		</td>
		<td class="text-center">
			<?=$fingerprint_date_to;?>
		</td>
		<td class="text-center">
			<?=$fingerprint_date_sync;?>
		</td>
		<!--E fingerprint-->
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
