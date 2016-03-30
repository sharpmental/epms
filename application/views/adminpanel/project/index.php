<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<script type="text/javascript"
	src="http://api.map.baidu.com/api?v=2.0&ak=GeYl5tOEg0Xl4VzFwWxIGGq7WHtNWXMB">
//v2.0版本的引用方式：src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥"
//v1.4版本及以前版本的引用方式：src="http://api.map.baidu.com/api?v=1.4&key=您的密钥&callback=initialize"
</script>

<div class="panel panel-default grid">
	<div class='panel-heading'>
		<i class='glyphicon glyphicon-th-list'></i>Project Map
		<div class='panel-tools'>
			<div class='btn-group'>
			<?php aci_ui_a($folder_name,'manage','index','',' class="btn "','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
            <div class="btn" id="refreshBtnF"></div>
			</div>
		</div>
	</div>
		<div id="pmap"></div>
		<script type="text/javascript"> 
		var map = new BMap.Map("pmap");          // 创建地图实例  
		var point = new BMap.Point(116.404, 39.915);  // 创建点坐标  
		map.centerAndZoom(point, 15);                 // 初始化地图，设置中心点坐标和地图级别  
		</script>
	
</div>

