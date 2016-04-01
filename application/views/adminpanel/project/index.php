<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>
<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1" style="height:100%;">

<div style="position: absolute; top:70px; left:20px; z-index:100">
<form class="form-inline bg-info" style="padding:8px">
  <div class="form-group">
    <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
  </div>
  <button type="submit" class="btn btn-default">Search</button>
</form>
</div>

<div id="pmap" style="height:90%;top:60px;z-index=1">
</div>
</div>



<script type="text/javascript"
	src="http://api.map.baidu.com/api?v=2.0&ak=GeYl5tOEg0Xl4VzFwWxIGGq7WHtNWXMB">
//v2.0版本的引用方式：src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥"
//v1.4版本及以前版本的引用方式：src="http://api.map.baidu.com/api?v=1.4&key=您的密钥&callback=initialize"
</script>

<script language="javascript" type="text/javascript"> var folder_name = "<?php echo $folder_name?>";
    var controller_name = "<?php echo $controller_name?>";
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/index.js']); </script>

