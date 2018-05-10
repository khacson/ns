
<?php 	$i = $start;
foreach ($datas as $item){
	$id = $item->id;
	
	$datecreate = gmdate("Y-m-d", time() + 7 * 3600);
	$contrac_date = '';
	
	$date_start = ''; 
	$timeYear = '';
	$time = '';
	if(!empty($item->date_start)){
		$date_start = date(configs('cfdate'),strtotime($item->date_start));
		$time = (int)((strtotime($datecreate) - strtotime($item->date_start))/86400);
		$years = ($time/365);
		if($years < 1){
			$month = (int)($time/30);
			$timeYear = $month.' '.getLanguage('thang');
			
		}
		else{
			$timeYear = round($years,1).' '.getLanguage('nam');
		}
		
	}
	$timeYears = 0;
	if(!empty($item->contrac_date) && $item->contrac_date != '1970-01-01' && $item->contrac_date !='0000-00-00'){
		$contrac_date = date(configs('cfdate'),strtotime($item->contrac_date));
		$times = (int)((strtotime($datecreate) - strtotime($item->contrac_date))/86400);
		$yearss = ($times/365);
		$timeYears = round($yearss,1);
	}
	$bonus_holiday = 0;
	if(!empty($item->bonus_holiday)){
		$bonus_holiday = $item->bonus_holiday;
	}
	$holidays_date = 0;
	if(!empty($timeYears)){
		foreach($holidays as $items){
			//Tim so ngay nghi dua vao nam hop dong
			if($timeYears >= $items->holidays_year_from && $timeYears < $items->holidays_year_to){
				$holidays_date = $items->holidays_date;
			}
		}
	}
	$total = $holidays_date + $bonus_holiday;
	?>
	<tr class="content edit" identity = "<?=$item->identity;?>" positionid="<?=$item->positionid;?>" departmentid="<?=$item->departmentid;?>" 
	id="<?=$item->id;?>">
		
		<td style="text-align: center;">
			<input id="<?=$item->id;?>" class="check" type="checkbox" value="<?=$item->id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="departmanet_name"><?=$item->departmanet_name;?></td>
		<td class="code"><?=$item->code;?></td>
		<td class="fullname"><?=$item->fullname;?></td>
		<td class="date_start text-center"><?=$date_start;?></td>
		<td class="contrac_date text-center"><?=$contrac_date;?></td>
		<td><?=$timeYear;?></td>
		<td class="text-center"><?=$total;?> <?=getLanguage('ngay');?></td>
		<td class="text-center"><?=$holidays_date;?></td>
		<td class="text-center"><?=$bonus_holiday;?> </td>
		<td class="text-center"><?=$item->bonus_holiday_note;?></td>
		<td class="text-center">
			<?php if(isset($permission['edit'])){?>
				<a id="<?=$id;?>" class="btn btn-info edititem" href="#" data-toggle="modal" data-target="#myModalFrom">
				<i class="fa fa-pencil" aria-hidden="true"></i>
				</a>
			<?php }?>
		</td>
		<td></td>
	</tr>

<?php $i++;}?>
