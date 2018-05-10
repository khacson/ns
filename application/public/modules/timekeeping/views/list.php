	<!--header-->
	<div id="cHeader">
		<div id="tHeader">    	
			<table width="100%" cellspacing="0" border="1" >
				<?php for($i=2; $i< (6+count($arrayDate)); $i++){?>
					<col class="c<?=$i;?>">
				<?php }?>
				<col class="c<?=$i;?>">
				<col class="cc20">
				<tr>							
					<th ><?=getLanguage('stt')?></th>		
					<th  id="ord_s.fullname"><?=getLanguage('ma-nhan-vien')?></th>
					<th  id="ord_s.code"><?=getLanguage('ho-ten')?></th>
					<th  id="ord_s.departmentid"><?=getLanguage('bo-phan')?></th>
					<?php foreach($arrayDate as $key => $date){
						 $datetime = date('d',strtotime($date));
						 $month = date('m',strtotime($date));
						 $year = date('Y',strtotime($date));
						 $thoigian = mktime(0,0,0,$month,$datetime,$year);
						 $thu = strtolower(date("l", $thoigian));
						 if(isset($arr_thu[$thu])){
							 $thungay = $arr_thu[$thu];
						 }
						 else{
							 $thungay = "";
						 }
						?>
					<th style="font-weight:300;">
						<div style="float:left; width:100%;"><?=date('d/m/y',strtotime($date));?></div>
						<div style="border-top:1px solid #d1dde2; float:left; width:100%;"><?=$thungay;?></div>
					</th>
					<?php }?>
					<th ></th>
				</tr>
				<!--<tr>
					<th style="font-weight:300;"></th>
					<th ></th>
				</tr>-->
			</table>
		</div>
	</div>
	<!--end header-->
	<!--body-->
	<div id="data">
		<div id="gridView">
			<table  width="100%" cellspacing="0" border="1">
				<?php for($i=2; $i< (6+count($arrayDate)); $i++){?>
					<col class="c<?=$i;?>">
				<?php }?>
				<col class="c<?=$i;?>">
				<tbody>
					<?php 	$i = $start;
					foreach ($datas as $key => $item) { 	
						?>
						<tr class="editss" id="<?=$item->id;?>" departmentid = "<?=$item->departmentid;?>" >
							<td class="text-center"><?=$i;?></td>
							<td class="code"><?=$item->code;?></td>
							<td class="fullname"><?=$item->fullname;?></td>
							<td class="departmanet_name"><?=$item->departmanet_name;?></td>
							<?php foreach($arrayDate as $key => $date){
								$datetime = date('d',strtotime($date));
								$month = date('m',strtotime($date));
								$year = date('Y',strtotime($date));
								$thoigian = mktime(0,0,0,$month,$datetime,$year);
								$thus = strtolower(date("l", $thoigian));
								//Check vân tay
								$check = 0;
								if(isset($timesheets[$item->id][$date])){
									$check = 1;
								}
								elseif(isset($dicongtac[$item->id][$date])){//Đi công tác
									$check = 2;
								}
								elseif(isset($nghiphep[$item->id][$date])){//Nghỉ phép
									$check = 3;
								}
								elseif(isset($nghithaisan[$item->id][$date])){//Nghỉ thai sản
									$check = 4;
								}
								
								$viewCheck = '';
								if($check == 1){
									$viewCheck = '<i title="Check vân tay" class="fa fa-check" style="font-size:10px !important; color:#69F;"></i>';
								}
								if($check == 2){
									$viewCheck = '<i title="Đi công tác" class="fa fa-check" style="font-size:10px !important; color:#ecb305;"> - CT</i>';
								}
								if($check == 3){
									$viewCheck = '<i title="Nghỉ phép" class="fa fa-check" style="font-size:10px !important; color:#ec2b05;"> - NP</i> ';
								}
								if($check == 4){
									$viewCheck = '<i title="Nghỉ thai sản"  class="fa fa-check" style="font-size:10px !important; color:#b7fa02;">  - TS</i>';
								}
							?>
								<?php if($thus == 'sunday' || $thus == 'saturday'){?>
									<td style="background:#e3f5fd ;" class="text-center">
										<?=$viewCheck;?>
									</td>
								<?php }else{?>
									<td class="text-center" >
										<?=$viewCheck;?>
									</td>
								<?php }?>
								
							<?php }?>
							<td ></td>
						</tr>
					<?php $i++;}?>
				</tbody>
			</table>
		</div>
	</div>
	<!--end body-->
