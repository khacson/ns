/////////////////////// File view ///////////////////////

<div id="table" style="">
	<!-- hearder-->
	<div id="header">
		<div class="toptitle">
			<i>Total: </i><i id="total"></i>
		</div>
		<div>
			<table class="tbtop">
				<tr>
					<th width="40">No.</th>
					<th width="40" align="center"><input type="checkbox" id="checkall" /></th>
					<th width="200">Group name</th>
					<th width="70">Right</th>
					<th width="70">Delete</th>
					<th></th>
				</tr>
				  
			</table>
		 </div>
	</div>
	<div id="gridview" class="ccenter">
		<table class="tbcenter" id="grid"></table>          
	</div>
</div>

/////////////////////// File List ///////////////////////


<?php $i=1; foreach($datas as $item){?>
	<tr class="eidt listitem" >
		<td width="40" style="text-align:center"><?=$i;?></td>
		
		<td width="40" style="text-align:center">
			<input class="noClick" name="keys[]"  type="checkbox" />
		</td>
		
		<td width="200" >
			
		</td>
		<td width="70">
		
		</td>
		<td width="70" >
			
		</td>
		<td></td>
	</tr>
<?php $i++;}?>


 