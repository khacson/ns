	<!--header-->
	<div id="cHeader">
		<div id="tHeader">    	
			<table width="100%" cellspacing="0" border="1" >
				<col class="c1">
				<col class="c2">
				<col class="c3">
				<col class="c4">
				<col class="c5">
				<col class="c6">
				<?php for($i=7; $i< (7+$total); $i++){?>
					<col class="c<?=$i;?>">
				<?php }?>
				<col class="gc">
				<tr>							
					<th ><input type="checkbox" name="checkAll" id="checkAll" /></th>
					<th ><?=getLanguage('stt')?></th>		
					<th  id="ord_s.fullname"><?=getLanguage('ma-nhan-vien')?></th>
					<th  id="ord_s.code"><?=getLanguage('ho-ten')?></th>
					<th  id="ord_s.departmentid"><?=getLanguage('bo-phan')?></th>
					<th><?=getLanguage('ket-qua')?></th>
					<?php foreach($criteriaProbationary as $item){
						?>
						<th style="font-weight:300;">
							<?=$item->aprobationary_name;?>
						</th>
					<?php }?>
					<th><?=getLanguage('ghi-chu')?></th>
					<th></th>
				</tr>
			</table>
		</div>
	</div>
	<!--end header-->
	<!--body-->
	<div id="data">
		<div id="gridView">
			<table  width="100%" cellspacing="0" border="1">
				<col class="c1">
				<col class="c2">
				<col class="c3">
				<col class="c4">
				<col class="c5">
				<col class="c6">
				<?php for($i=7; $i< (7+$total); $i++){?>
					<col class="c<?=$i;?>">
				<?php }?>
				<col class="gc">
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
							$statusid = ''; $description = '';
							foreach($criteriaProbationary as $items){
								if(isset($criterias[$item->id][$items->id]->statusid)){
									$status = $criterias[$item->id][$items->id]->statusid;
									if($status == 1){
										$statusid = getLanguage('dat');
									}
									elseif($status == 2){
										$statusid = getLanguage('tiep-tuc-dao-tao');
									}
									else{
										$statusid = getLanguage('khong-dat');
									}
									$description = $criterias[$item->id][$items->id]->description;
								}
								?>
								
							<?php }?>
							<td><?=$statusid;?></td>
							<?php 
							foreach($criteriaProbationary as $items){
								$point = '';
								if(isset($criterias[$item->id][$items->id])){
									$point = $criterias[$item->id][$items->id]->point;
								}
							?>
								<td class="text-center"><?=$point;?></td>
							<?php }?>
							<td ><?=$description;?></td>
						</tr>
					<?php $i++;}?>
					
				</tbody>
			</table>
		</div>
	</div>
	<!--end body-->
