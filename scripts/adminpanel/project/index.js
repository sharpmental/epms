requirejs(
		[ 'jquery', 'bootstrap' ],
		function($, aci) {

			initialize_baidumap();

			$("#search")
					.click(
							function(e) {
								var text = $("#search_text").val()
										.toLowerCase();
								$(".search-item").remove();

								if (text != "") {
									for (i = 0; i < map_json.length; i++) {
										if (map_json[i].slop_name.toLowerCase()
												.indexOf(text) > -1
												|| map_json[i].slop_description
														.toLowerCase().indexOf(
																text) > -1) {
											var item = '<li class="list-group-item search-item">'
													+ '<a class="btn btn-small btn-info" href="'
													+ project_link
													+ '/'
													+ map_json[i].project_id
													+ '"><span class="glyphicon glyphicon-tint"></span>项目:'
													+ map_json[i].project_id
													+ '</a>&nbsp'
													+ '<a class="btn btn-small btn-default" href="'
													+ slop_link
													+ '/'
													+ map_json[i].slop_id
													+ '"><span class="glyphicon glyphicon-chevron-right"></span>边坡:'
													+ map_json[i].slop_name
													+ '</a>' + '</li>';
											$("#list").after(item);
										}
									}
								} else {
									for (i = 0; i < map_json.length; i++) {
										var item = '<li class="list-group-item search-item">'
												+ '<a class="btn btn-small btn-info" href="'
												+ project_link
												+ '/'
												+ map_json[i].project_id
												+ '"><span class="glyphicon glyphicon-tint"></span>项目:'
												+ map_json[i].project_id
												+ '</a>&nbsp'
												+ '<a class="btn btn-small btn-default" href="'
												+ slop_link
												+ '/'
												+ map_json[i].slop_id
												+ '"><span class="glyphicon glyphicon-chevron-right"></span>边坡:'
												+ map_json[i].slop_name
												+ '</a>' + '</li>';
										$("#list").after(item);

									}

								}
							});
		});

var opts = {
	width : 250, // 信息窗口宽度
	height : 100, // 信息窗口高度
	title : "信息窗口", // 信息窗口标题
	enableMessage : true
// 设置允许信息窗发送短息
};
var map;

function initialize_baidumap() {
	marker_array = new Array();
	xmean = 0.0;
	ymean = 0.0;

	for (i = 0; i < map_json.length; i++) {
		xmean = xmean + parseFloat(map_json[i].position_x);
		ymean = ymean + parseFloat(map_json[i].position_y);
	}
	xmean = xmean / map_json.length;
	ymean = ymean / map_json.length

	map = new BMap.Map("pmap"); // 创建地图实例
	var point = new BMap.Point(xmean, ymean); // 创建点坐标
	map.centerAndZoom(point, 15); // 初始化地图，设置中心点坐标和地图级别

	map.addControl(new BMap.NavigationControl({
		anchor : BMAP_ANCHOR_TOP_RIGHT
	}));
	map.addControl(new BMap.ScaleControl());
	// map.addControl(new BMap.OverviewMapControl());

	for (i = 0; i < map_json.length; i++) {
		marker_array[i] = new BMap.Marker(new BMap.Point(
				map_json[i].position_x, map_json[i].position_y)); // 创建点

		var content = "<h4  class='bg-primary'>" + map_json[i].slop_name
				+ "</h4>" + "<p class='text-info'>"
				+ map_json[i].slop_description + "</p>" + "</div>";

		map.addOverlay(marker_array[i]); // 将标注添加到地图中
		addClickHandler(content, marker_array[i]);
	}

	map.enableScrollWheelZoom(true);
}

function addClickHandler(content, marker) {
	marker.addEventListener("click", function(e) {
		openInfo(content, e)
	});
}

function openInfo(content, e) {
	var p = e.target;
	var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
	var infoWindow = new BMap.InfoWindow(content, opts); // 创建信息窗口对象 
	map.openInfoWindow(infoWindow, point); //开启信息窗口
}