
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;	
	$overtime_pay_type = '%';
	if($item->overtime_pay_type == 2){
		$overtime_pay_type = getLanguage('tien');;
	}
	$overtime_pay_by = getLanguage('theo-gio');
	if($item->overtime_pay_by == 2){
		$overtime_pay_by = getLanguage('theo-san-pham');
	}
	?>
	<tr class="content edit" id="<?=$id;?>" >
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="overtime_name"><?=$item->overtime_name;?></td>
		<td class="overtime_pay text-right"><?=fmNumber($item->overtime_pay);?></td>
		<td class="overtime_pay"><?=$overtime_pay_type;?></td>
		<td class="overtime_pay_by"><?=$overtime_pay_by;?></td>
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
