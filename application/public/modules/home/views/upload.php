
<form id="frmForm" target="upload_target" action="<?=base_url()?>home/readexcel<?=url_suffix()?>" method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<td><input  name="myfile" id="myfile" type="file"/></td>
			<td><input type="submit" /></td>
		</tr>
	</table>
</form>