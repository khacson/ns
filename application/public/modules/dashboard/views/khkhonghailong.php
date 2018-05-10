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
					name: 'Cơ sở vật chất không tốt',
					y: 10
				}, {
					name: 'Hàng không tốt',
					y: 15,
					sliced: true,
					selected: true
				},
				{
					name: 'Kỹ thuật không tốt',
					y: 20
				}
				,
				{
					name: 'Nhân viên không tốt',
					y: 25
				}
				,
				{
					name: 'Lý do khác',
					y: 60
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
					['Cơ sở vật chất không tốt', 10],
					['Hàng không tốt', 15],
					['Kỹ thuật không tốt', 20],
					['Nhân viên không tốt', 25],
					['Lý do khác', 40]
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
		//Chua thu
		$('#tongbiennhan3').highcharts({
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
					name: 'Chờ thu',
					y: 90
				}, {
					name: 'Không thu',
					y: 10,
					sliced: true,
					selected: true
				}]
			}]
		});
		//2
		$('#tongbiennhan4').highcharts({
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
					['Chờ thu thu', 90],
					['Không thu', 10]
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