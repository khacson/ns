<!--S content-->
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Biên nhận đã trả </a></li>
  <li><a data-toggle="tab" href="#menu1">Biên nhận chưa trả </a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
		<div class="row">
			<div  id="tongbiennhan1" style="width:360px; height: 360;margin: 0 auto; float:left;"></div>
			<div  id="tongbiennhan2" style="width: 360px; height: 360;margin: 0 auto;  float:right;"></div>
		</div>
  </div>
  <div id="menu1" class="tab-pane fade">	
		<div class="row">
			<div  id="tongbiennhan3" style="width:360px; height: 360;margin: 0 auto; float:left;"></div>
			<div  id="tongbiennhan4" style="width: 360px; height: 360;margin: 0 auto;  float:right;"></div>
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
					name: 'Đã thu',
					y: 85
				}, {
					name: 'Không thu',
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
					['Đã thu', 85],
					['Không thu', 15]
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