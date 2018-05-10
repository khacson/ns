
<?php 	$i = $start;
foreach ($datas as $item){ 
	$id = $item->id;	
	$sex = '';
	if($item->sex == 1){
		$sex = getLanguage('nam');
	}
	elseif($item->sex == 2){
		$sex = getLanguage('nu');
	}
	elseif($item->sex == -1){
		$sex = getLanguage('gioi-tinh-khac');
	}
	$birthday = '';
	if(!empty($item->birthday) && $item->birthday != '0000-00-00'){
		$birthday = date(configs('cfdate'),strtotime($item->birthday));
	}
	$date_interview = '';
	if(!empty($item->date_interview) && $item->date_interview != '0000-00-00'){
		$date_interview = date(configs('cfdate'),strtotime($item->date_interview));
	}
	?>
	<tr class="content edit" id="<?=$id;?>" >
		<td class="text-center">
			<input id="<?=$id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="fullname"><?=$item->fullname;?></td>
		<td class="phone"><?=$item->phone;?></td>
		<td class="email"><?=$item->email;?></td>
		<td><?=$sex;?></td>
		<td><?=$birthday;?></td>
		<td><?=$item->recruitment_position;?></td>
		<td><?=$date_interview;?></td>
		<td><?=$item->academic_name;?></td>
		<td><?=$item->academic_skills;?></td>
		<td><?=$item->description;?></td>
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
