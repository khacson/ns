<!--S content-->
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Tỉ trọng theo hãng </a></li>
  <li><a data-toggle="tab" href="#menu1">Tỉ trọng theo model</a></li>
  <li><a data-toggle="tab" href="#menu2">Tỉ trọng theo dịch vụ</a></li>
  <li><a data-toggle="tab" href="#menu3">Khách hàng mới</a></li>
  <li><a data-toggle="tab" href="#menu4">Khách hàng cũ</a></li>
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
  <div id="menu2" class="tab-pane fade">	
		<div class="row">
			<div  id="tongbiennhan5" style="width:360px; height: 360;margin: 0 auto; float:left;"></div>
			<div  id="tongbiennhan6" style="width: 360px; height: 360;margin: 0 auto;  float:right;"></div>
		</div>
  </div>
  <div id="menu3" class="tab-pane fade">
		<div  id="tongbiennhan7" style="width:360px; height: 360;margin: 0 auto; float:left;"></div>
		<div  id="tongbiennhan8" style="width: 360px; height: 360;margin: 0 auto;  float:right;"></div>
  </div>
  <div id="menu4" class="tab-pane fade">
		<div  id="tongbiennhan9" style="width:360px; height: 360;margin: 0 auto; float:left;"></div>
		<div  id="tongbiennhan10" style="width: 360px; height: 360;margin: 0 auto;  float:right;"></div>
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
					name: 'Apple',
					y: 50
				}, {
					name: 'Samsung',
					y: 30,
					sliced: true,
					selected: true
				},
				{
					name: 'Oppo',
					y: 10
				},
				{
					name: 'LG',
					y: 5
				},
				{
					name: 'Khác',
					y: 5
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
					['Apple', 50],
					['Samsung', 30],
					['Oppo', 10],
					['LG', 5],
					['Khác', 5]
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
					name: 'iPhone 7',
					y: 10
				}, {
					name: 'iPhone 6s',
					y: 20,
					sliced: true,
					selected: true
				}
				, {
					name: 'iPhone 6',
					y: 30
				}
				, {
					name: 'iPhone 5s',
					y: 30
				}
				, {
					name: 'iPhone 5',
					y: 10
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
					['iPhone 7', 10],
					['iPhone 6s', 10],
					['iPhone 6', 30],
					['iPhone 5s', 40],
					['iPhone 5', 10]
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
		//Dich vu
		$('#tongbiennhan5').highcharts({
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
					name: 'Bán lẽ',
					y: 10
				}, {
					name: 'Bảo hành',
					y: 20,
					sliced: true,
					selected: true
				}
				, {
					name: 'Dịch vụ (Hỗ trợ)',
					y: 30
				}
				, {
					name: 'Sửa chữa',
					y: 30
				}
				, {
					name: 'Khác',
					y: 10
				}]
			}]
		});
		//2
		$('#tongbiennhan6').highcharts({
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
					['Bán lẽ', 10],
					['Bảo hành', 10],
					['Dịch vụ (Hỗ trợ)', 30],
					['Sửa chữa', 40],
					['Khác', 10]
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
		//kh moi
		$('#tongbiennhan7').highcharts({
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
					name: 'iPhone 7',
					y: 10
				}, {
					name: 'iPhone 6s',
					y: 20,
					sliced: true,
					selected: true
				}
				, {
					name: 'iPhone 6',
					y: 30
				}
				, {
					name: 'iPhone 5s',
					y: 30
				}
				, {
					name: 'iPhone 5',
					y: 10
				}]
			}]
		});
		//2
		$('#tongbiennhan8').highcharts({
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
					['iPhone 7', 10],
					['iPhone 6s', 10],
					['iPhone 6', 30],
					['iPhone 5s', 40],
					['iPhone 5', 10]
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
		//kh cu
		$('#tongbiennhan9').highcharts({
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
					name: 'iPhone 7',
					y: 10
				}, {
					name: 'iPhone 6s',
					y: 20,
					sliced: true,
					selected: true
				}
				, {
					name: 'iPhone 6',
					y: 30
				}
				, {
					name: 'iPhone 5s',
					y: 30
				}
				, {
					name: 'iPhone 5',
					y: 10
				}]
			}]
		});
		//2
		$('#tongbiennhan10').highcharts({
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
					['iPhone 7', 10],
					['iPhone 6s', 10],
					['iPhone 6', 30],
					['iPhone 5s', 40],
					['iPhone 5', 10]
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