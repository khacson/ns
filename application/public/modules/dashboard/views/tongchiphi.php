<!--S content-->
<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
		<div class="row">
			<div  id="tongbiennhan1" style="width:360px; height: 360;margin: 0 auto; float:left;"></div>
			<div  id="tongbiennhan2" style="width: 360px; height: 360;margin: 0 auto;  float:right;"></div>
		</div>
  </div>
</div> 
<!--E content-->
<script>
	$(function(){
		$('#tongbiennhan1').highcharts({
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: ''
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						format: '<b>{point.name}</b>: {point.percentage:.0f} %',
						style: {
							color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
						}
					}
				}
			},
			series: [{
				name: 'Số lượng',
				colorByPoint: true,
				data: [{
					name: 'Chi cho nhân viên',
					y: 85
				}, {
					name: 'Chi khác',
					y: 15,
					sliced: true,
					selected: true
				}]
			}]
		});
		//2
		$('#tongbiennhan2').highcharts({
			chart: {
				type: 'column'
			},
			title: {
				text: ''
			},
			subtitle: {
				text: ''
			},
			xAxis: {
				type: 'category',
				labels: {
					rotation: -45,
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Số lượng (cái)'
				}
			},
			legend: {
				enabled: false
			},
			tooltip: {
				pointFormat: 'Số lượng: <b>{point.y:.0f} Cái</b>'
			},
			series: [{
				name: 'Số lượng',
				data: [
					['Chi cho nhân viên', 85],
					['Chi khác', 15]
				],
				dataLabels: {
					enabled: true,
					rotation: -90,
					color: '#FFFFFF',
					align: 'right',
					format: '{point.y:.0f}', // one decimal
					y: 10, // 10 pixels down from the top
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			}]
		});
		
	});
</script>