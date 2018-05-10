
<?php 	$i = $start;
foreach ($datas as $key => $item){
	if($item->sex == 1){
		$sex = 'Nam';
	}
	else if($item->sex == 2){
		$sex = 'Nữ';
	}
	else if($item->sex == -1){
		$sex = 'Giới tính khác';
	}
	else{
		$sex = '';
	}
	$birthday = (int)date('d',strtotime($item->birthday));
	$timenow = (int)gmdate("d", time() + 7 * 3600);
	$style = "";
	if($timenow > $birthday){
		$style = "style='color:#547f09;'";
		$sn = 'Đã qua <span class="red">'.($timenow - $birthday).'</span> ngày';
	}
	else if($timenow == $birthday){
		$style = "style='color:#fb8303;'";
		$sn = '<span class="red">Hôm nay</span>';
	}
	else{
		if($birthday - $timenow < 4){
			$style = "style='color:#fb8303;'";
		}
		$sn = 'Còn <span class="red">'.($birthday - $timenow).'</span> ngày';
	}
	?>
	<tr <?=$style;?> class="content edit" positionid="<?=$item->positionid;?>" departmentid="<?=$item->departmentid;?>" id="<?=$item->id;?>"  jobstatusid="<?=$item->jobstatusid;?>" academic_level="<?=$item->academic_level;?>" ethnicid="<?=$item->ethnicid;?>" religionid="<?=$item->religionid;?>" >
		<td style="text-align: center;">
			<input id="<?=$item->id;?>" class="check" type="checkbox" value="<?=$item->id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="departmentid"><?=$item->departmanet_name;?></td>
		<td class="code"><?=$item->code;?></td>
		<td class="fullname"><?=$item->fullname;?></td>
		<td class="sex" id='<?=$item->sex;?>'><?=$sex;?></td>
		<td class="phone"><?=$item->phone;?></td>
		<td class="birthday text-center"><?=date(configs('cfdate'),strtotime($item->birthday));?></td>
		<td class="birthday"><?=$sn;?></td>
		<td class="positionid"><?=$item->position_name;?></td>
		<td class="views text-center cursor blues"><a href="<?=base_url();?>employeefile?code=<?=$item->code;?>"><i class="fa fa-folder-open-o"></i></a></td>
	</tr>

<?php $i++;}?>
