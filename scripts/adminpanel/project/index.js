requirejs([ 'jquery', 'bootstrap' ],
function($, aci) {
	var map = new BMap.Map("pmap");          // 创建地图实例
	var point = new BMap.Point(116.404, 39.915);  // 创建点坐标
	map.centerAndZoom(point, 15);                 // 初始化地图，设置中心点坐标和地图级别
	
	map.addControl(new BMap.NavigationControl());    
	map.addControl(new BMap.ScaleControl());    
	map.addControl(new BMap.OverviewMapControl());    
	
	var marker = new BMap.Marker(new BMap.Point(116.404, 39.915)); // 创建点	
	map.addOverlay(marker); 
});
