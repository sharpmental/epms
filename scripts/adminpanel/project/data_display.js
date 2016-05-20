requirejs([ 'jquery', 'aci', 'bootstrap', 'bootstrapValidator', 'message',
		'highcharts', 'bootstrap-tree' ], function($, aci) {
	$('#datachart1').highcharts({
		title : {
			text : title1,
			x : -20
		},
		xAxis : {
			categories : x_axis
		},
		yAxis : {
			title : {
				text : '(unkonw)'
			},
			plotLines : [ {
				value : 0,
				width : 1,
				color : '#808080'
			} ]
		},
		legend : {
			layout : 'vertical',
			align : 'right',
			verticalAlign : 'middle',
			borderWidth : 0
		},
		series : [ {
			name : mark1,
			data : row1
		} ]
	});

	$('#datachart2').highcharts({
		title : {
			text : title2,
			x : -20
		},
		xAxis : {
			categories : x_axis
		},
		yAxis : {
			title : {
				text : '(unkonw)'
			},
			plotLines : [ {
				value : 0,
				width : 1,
				color : '#808080'
			} ]
		},
		legend : {
			layout : 'vertical',
			align : 'right',
			verticalAlign : 'middle',
			borderWidth : 0
		},
		series : [ {
			name : mark2,
			data : row2
		} ]
	});

	$('#treeview1').treeview({
		color : "#000000",
		enableLinks : true,
		data : defaultData
	});

});