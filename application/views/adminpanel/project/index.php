<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>
<div class="col-md-6" style="height:100%;">
<div id="pmap" style="height:100%"></div>
</div>
<script type="text/javascript"
	src="http://api.map.baidu.com/api?v=2.0&ak=GeYl5tOEg0Xl4VzFwWxIGGq7WHtNWXMB">
//v2.0版本的引用方式：src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥"
//v1.4版本及以前版本的引用方式：src="http://api.map.baidu.com/api?v=1.4&key=您的密钥&callback=initialize"
</script>

<script type="text/javascript"> 
var map = new BMap.Map("pmap");          // 创建地图实例  
var point = new BMap.Point(116.404, 39.915);  // 创建点坐标  
map.centerAndZoom(point, 15);                 // 初始化地图，设置中心点坐标和地图级别  
</script>

<script language="javascript" type="text/javascript"> var folder_name = "<?php echo $folder_name?>";
    var controller_name = "<?php echo $controller_name?>";
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/index.js']); </script>

