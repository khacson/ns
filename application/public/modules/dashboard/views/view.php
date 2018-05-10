<style title="" type="text/css">
	table col.c1 { width: 45px; }
	table col.c2 { width: 45px; }
	table col.c3 { width: 180px; }
	table col.c4 { width: 100px; }
	table col.c5 { width: auto;}
</style>
<link href="<?=url_tmpl();?>css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<!-- Small boxes (Stat box) -->
<div class="row" style="margin-top:-5px;">
	<div class="col-lg-12 text-right">
	    <ul class="ulsearch">
			<li style="width:125px;">
				<div class="col-md-12 date date-picker" >
					<div class="input-group date" data-provide="datepicker">
						<input id="fromdate" type="text" class="searchs form-control" placeholder="Chọn từ ngày" value="<?=$fromdate;?>">
						<div class="input-group-addon">
							<i class="fa fa-calendar "></i>
						</div>
					</div>
				</div>
			</li>
			<li style="width:125px;">
				<div class="col-md-12 date date-picker" >
					<div class="input-group date" data-provide="datepicker">
						<input id="todate" type="text" class="searchs form-control" placeholder="Chọn đến ngày" value="<?=$toate;?>">
						<div class="input-group-addon">
							<i class="fa fa-calendar "></i>
						</div>
					</div>
				</div>
			</li>
			<li style="width:180px;">
				<div class="col-md-12" >
					<select name="branchid" id="branchid" class="combos tab-event" >
						<?php foreach ($branchs as $item) { ?>
							<option value="<?=$item->id;?>"><?=$item->branch_name?></option>
						<?php } ?>
					</select>
				</div>
			</li>
			<li>
				<button id="searchs" class="btn btn-info pull-left" type="submit">Tìm kiếm</button>
			</li>
		</ul>
	</div>
</div>
<div class="row mtop10" id="viewClm"></div>
<div class="box" id="viewChart"></div>
<!-- END grid-->
<div class="loading" style="display: none;">
	<div class="blockUI blockOverlay" style="width: 100%;height: 100%;top:0px;left:0px;position: absolute;background-color: rgb(0,0,0);opacity: 0.1;z-index: 1000;">
	</div>
	<div class="blockUI blockMsg blockElement" style="width: 30%;position: absolute;top: 15%;left:35%;text-align: center;">
		<img src="<?=url_tmpl()?>img/preloader.gif" style="z-index: 2;position: absolute;"/>
	</div>
</div> 
<script type="text/javascript">
var controller = '<?=base_url().$routes;?>/';
$(function () {
	loadData();
	$('#searchs').click(function(){
		loadData();
	});
	$('#branchid').multipleSelect({
		filter: true,
		placeholder:'<?=getLanguage('chon-chi-nhanh');?>',
		single: false
	});
	var branchid = '<?=$branchid;?>';
	$('#branchid').multipleSelect('setSelects', branchid.split(','));
});
function loadData(){
	var fromdate = $('#fromdate').val();
	var todate = $('#todate').val();
	$('.loading').show();
	$.ajax({
		url : controller + 'loadData',
		type: 'POST',
		async: false,
		data:{fromdate:fromdate,todate:todate},
		success:function(datas){
			var obj = $.evalJSON(datas); 
			$('.modal-body').html();
			$('#viewClm').html(obj.viewClm);
			$('#viewChart').html(obj.viewChart);
			$('.loading').hide();
		}
	});
}
</script>
<script src="<?=url_tmpl();?>highcharts/js/highcharts.js" type="text/javascript"></script>