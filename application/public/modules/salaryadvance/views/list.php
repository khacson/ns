
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;	
	?>
	<tr class="content edit" id="<?=$id;?>" departmentid="<?=$item->departmentid;?>" employeeid="<?=$item->employeeid;?>">
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="departmanet_name"><?=$item->departmanet_name;?></td>
		<td class="code"><?=$item->code;?></td>
		<td class="fullname"><?=$item->fullname;?></td>
		<td class="salaryadvance_money text-right"><?=number_format($item->salaryadvance_money);?></td>
		<td class="salaryadvance_date text-center"><?=date(configs('cfdate'),strtotime($item->salaryadvance_date));?></td>
		<td class="salaryadvance_content"><?=$item->salaryadvance_content;?></td>
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
