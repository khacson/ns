<div class="box">
	<div class="box-header with-border">
	  <h3 class="box-title"></h3>
	  <div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Đóng">
	  </div>
	</div>
	<div class="box-body" >
		<div class="row">
			<div class="col-md-6">
				<div id="container1" style="min-width: 100%; height: 400px; margin: 0 auto"></div>
			</div>
			<div class="col-md-6">
				<div id="container2" style="min-width: 100%; height: 400px; margin: 0 auto"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="container3" style="min-width: 100%; height: 400px; margin: 0 auto"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="container4" style="min-width: 100%; height: 400px; margin: 0 auto"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#container1').highcharts({
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Thống kê theo hợp đồng'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						format: '<b>{point.name}</b>: {point.percentage:.1f} %',
						style: {
							color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
						}
					}
				}
			},
			series: [{
				name: 'Brands',
				colorByPoint: true,
				data: [{
					name: 'HĐ vô thời hạng',
					y: 56.33
				}, {
					name: 'Chrome',
					y: 24.03,
					sliced: true,
					selected: true
				}, {
					name: 'HĐ dưới 1 năm',
					y: 10.38
				}, {
					name: '',
					y: 4.77
				}, {
					name: 'HĐ trên 1 năm',
					y: 0.91
				}, {
					name: 'Thử việc',
					y: 0.2
				}]
			}]
		});
	$('#container2').highcharts({
	chart: {
		plotBackgroundColor: null,
		plotBorderWidth: null,
		plotShadow: false,
		type: 'pie'
	},
	title: {
		text: 'Thống kê theo trình độ'
	},
	tooltip: {
		pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	},
	plotOptions: {
		pie: {
			allowPointSelect: true,
			cursor: 'pointer',
			dataLabels: {
				enabled: true,
				format: '<b>{point.name}</b>: {point.percentage:.1f} %',
				style: {
					color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
				}
			}
		}
	},
	series: [{
		name: 'Brands',
		colorByPoint: true,
		data: [{
			name: 'Trên đại học',
			y: 4.77
		}, {
			name: 'Chrome',
			y: 10.38,
			sliced: true,
			selected: true
		}, {
			name: 'Đại học',
			y: 24.03 
		}, {
			name: 'Cao đẳng',
			y: 56.33
		}, {
			name: 'Trung cấp',
			y: 0.91
		}, {
			name: 'Phổ thông',
			y: 0.2
		}]
	}]
});
$('#container3').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Thống kê theo lương'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Ngày 01',
                'Ngày 02',
                'Ngày 03',
                'Ngày 04',
                'Ngày 05',
                'Ngày 06',
                'Ngày 07',
                'Ngày 08',
                'Ngày 09',
                'Ngày 10',
                'Ngày 11',
                'Ngày 12'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Triệu đồng'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Năm nay',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        }, {
            name: 'Năm trước',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }/*, {
            name: 'iPhone 7',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }, {
            name: 'Galaxy S8',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }*/]
    });
$('#container4').highcharts({
        title: {
            text: 'Biến động nhân sự',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: ['Tháng 01', 'Tháng 02', 'Tháng 03', 'Tháng 04', 'Tháng 05', 'Tháng 06',
                'Tháng 07', 'Tháng 08', 'Tháng 09', 'Tháng 10', 'Tháng 11', 'Tháng 12']
        },
        yAxis: {
            title: {
                text: 'Nhân viên'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' Nhân viên'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: ' ',
            data: [17, 6, 9, 14, 18, 21, 25, 26, 23, 18, 13, 19]
        }]
    });
	</script>