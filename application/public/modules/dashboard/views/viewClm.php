<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-aqua" style="background:#79c447 !important;">
	<div class="inner">
		<div class="t1">0</div>
		<div class="t2">Tổng nhân viên</div>
	</div>
	<div class="icon">
	 <i class="fa fa-mobile" aria-hidden="true"></i>
	</div>
	<a id="tongbiennhan" titles="Tổng nhân viên" href="#" class="small-box-footer clickView">Xem <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-green">
	<div class="inner">
	  <div class="t1">0</div>
	  <div class="t2">Nhân viên nữ</div>
	</div>
	<div class="icon">
	  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
	</div>
	<a id="doanhthu" titles="Nhân viên nữ" href="#" data-toggle="modal" data-target="#myModal" class="small-box-footer clickView" class="small-box-footer">Xem <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-aqua">
	<div class="inner">
	  <div class="t1">0</div>
	  <div class="t2">Nhân viên nam</div>
	</div>
	<div class="icon">
	  <i class="fa fa-folder-open-o" aria-hidden="true"></i>
	</div>
	<a id="khkhonghailong" titles="Nhân viên nam" href="#" class="small-box-footer clickView" class="small-box-footer">Xem <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-yellow">
	<div class="inner">
	  <div class="t1"><?=number_format($accepts);?></div>
	  <div class="t2">Nhân viên nghỉ phép</div>
	</div>
	<div class="icon">
	  <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
	</div>
	<a id="khchuachamsoc" titles="Nhân viên nghỉ phép" href="#" data-toggle="modal" data-target="#myModal" class="small-box-footer clickView" href="#" class="small-box-footer">Xem <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div id="loadContent" class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?=getLanguage('dong');?></button>
      </div>
    </div>

  </div>
</div>
<!-- ./col -->
<script type="text/javascript">
	$(function(){
		$('.clickView').each(function(){
			$(this).click(function(){
				var title = $(this).attr('titles');  
				var id =  $(this).attr('id'); 
				$('.modal-title').html(title);
				$.ajax({
					url : controller + 'viewDetail',
					type: 'POST',
					async: false,
					data:{id:id},
					success:function(datas){
						var obj = $.evalJSON(datas); 
						
						$('#loadContent').html(obj.content);		
					}
				});
			});
		});
	});
	$('#salesrevenueshistory').click(function(){
		var fromdate = $('#fromdate').val();
		var todate = $('#todate').val();
		window.location = '<?=base_url();?>salesrevenueshistory?fromdate='+fromdate+'&todate='+todate;
	});
	$('#historyinput').click(function(){
		var fromdate = $('#fromdate').val();
		var todate = $('#todate').val();
		window.location = '<?=base_url();?>historyinput?fromdate='+fromdate+'&todate='+todate;
	});
	$('#accept').click(function(){
		var fromdate = $('#fromdate').val();
		var todate = $('#todate').val();
		window.location = '<?=base_url();?>accept?fromdate='+fromdate+'&todate='+todate;
	});
	$('#onhold').click(function(){
		var fromdate = $('#fromdate').val();
		var todate = $('#todate').val();
		window.location = '<?=base_url();?>onhold?fromdate='+fromdate+'&todate='+todate;
	}); 
	$('#transfer').click(function(){
		var fromdate = $('#fromdate').val();
		var todate = $('#todate').val();
		window.location = '<?=base_url();?>transfer?fromdate='+fromdate+'&todate='+todate;
	});
	$('#shipped').click(function(){
		var fromdate = $('#fromdate').val();
		var todate = $('#todate').val();
		window.location = '<?=base_url();?>shipped?fromdate='+fromdate+'&todate='+todate;
	});
</script>




