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
					name: '1 Ngày',
					y: 30
				}, {
					name: '2 Ngày',
					y: 20,
					sliced: true,
					selected: true
				},
				{
					name: '3 Ngày',
					y: 10
				},
				{
					name: 'Hơn 3 ngày',
					y: 50
				}
				]
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
					['1 Ngày', 30],
					['2 Ngày', 20],
					['3 Ngày', 10],
					['Hơn 3 ngày', 50],
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