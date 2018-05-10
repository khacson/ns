
<?php 	$i = $start;
$arr = array();
$arr[-1] = 'Root';
$arr[0] = getLanguage('admin');;
$arr[1] = getLanguage('truong-phong-nhan-su');
$arr[2] = getLanguage('truong-phong-ban');
$arr[3] = getLanguage('to-truong-truong-nhom');
$arr[4] = getLanguage('nhan-vien');
foreach ($datas as $item) { 
	$id = $item->id;
	$grouptype = '';
	if(isset($arr[$item->grouptype])){
		$grouptype = $arr[$item->grouptype];
	}
	?>
	<tr class="content edit" 
	id="<?=$id;?>" 
	companyid ="<?=$item->companyid;?>" 
	grouptype = "<?=$item->grouptype;?>" >
		<td style="text-align: center;">
			<input id="<?=$item->id;?>" class="check noClick" type="checkbox" value="<?=$id; ?>" name="keys[]">
		</td>
		<td class="text-center"><?=$i;?></td>
		<td class="groupname"><?=$item->groupname?></td>
		<td class="grouptype"><?=$grouptype?></td>
		<td><?=$item->company_name;?></td>
		<td class="permission text-center" id="<?=$id;?>">
			<a href="#">
				<i class="fa fa-gears"></i>
				<span class="text-muted"></span>
			</a>
		</td>
		<td></td>
	</tr>

<?php $i++;}?>
