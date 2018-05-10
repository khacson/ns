	<!--header-->
	<div id="cHeader">
		<div id="tHeader">    	
			<table width="100%" cellspacing="0" border="1" >
				<?php for($i=1; $i< (7+$totalkpi); $i++){?>
					<col class="c<?=$i;?>">
				<?php }?>
				<col class="c<?=$i;?>">
				<tr>							
					<th ><input type="checkbox" name="checkAll" id="checkAll" /></th>
					<th ><?=getLanguage('stt')?></th>		
					<th  id="ord_s.fullname"><?=getLanguage('ma-nhan-vien')?></th>
					<th  id="ord_s.code"><?=getLanguage('ho-ten')?></th>
					<th  id="ord_s.departmentid"><?=getLanguage('bo-phan')?></th>
					<th><?=getLanguage('tong-diem')?></th>
					<?php foreach($kpis as $item){
						?>
						<th style="font-weight:300;">
							<div style="float:left; width:100%;"><?=$item->kpi_name;?></div>
							<div style="border-top:1px solid #d1dde2; float:left; width:100%;">Max: <?=$item->kpi_point_max;?></div>
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
				<?php for($i=1; $i< (7+$totalkpi); $i++){?>
					<col class="c<?=$i;?>">
				<?php }?>
				<col class="c<?=$i;?>">
				<tbody>
					<?php 	$i = $start;
					foreach ($datas as $key => $item) { 	
						?>
						<tr class="editss" id="<?=$item->id;?>" departmentid = "<?=$item->departmentid;?>" >
							
							<td style="text-align: center;">
								<input id="<?=$item->id;?>" class="check" type="checkbox" value="<?=$item->id; ?>" name="keys[]">
							</td>
							<td class="text-center"><?=$i;?></td>
							<td class="code"><?=$item->code;?></td>
							<td class="fullname"><?=$item->fullname;?></td>
							<td class="departmanet_name"><?=$item->departmanet_name;?></td>
							<?php 
								$total = 0;
								foreach($kpis as $items){
								$point = 0;
								if(isset($findKPI[$item->id][$items->id])){
									$point = $findKPI[$item->id][$items->id];
								}
								$total+= $point;
							?>
							
							<?php }?>
							<td class="text-center" ><?=$total;?></td>
							<?php foreach($kpis as $items){
								$point = 0;
								if(isset($findKPI[$item->id][$items->id])){
									$point = $findKPI[$item->id][$items->id];
								}
							?>
								<td class="text-center"><?=$point;?></td>
							<?php }?>
							<td ></td>
						</tr>

					<?php $i++;}?>
				</tbody>
			</table>
		</div>
	</div>
	<!--end body-->
