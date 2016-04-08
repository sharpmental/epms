<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading'>
		<i class='glyphicon glyphicon-th-list'></i>公司介绍
		<div class='panel-tools'>
			<div class='btn-group'>
			<?php aci_ui_a($folder_name,'manage','index','',' class="btn "','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
            <div class="btn" id="refreshBtnF"></div>
			</div>
		</div>
	</div>

	<div class="panel-body">
		<div class="jumbotron">
			<h1>公司介绍</h1>
			<p>公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍</p>
			<p>
				<img style="height: :100px;width:120px">图片图片</img>
				<img style="height: :100px;width:120px">图片图片</img>
				<img style="height: :100px;width:120px">图片图片</img>
			</p>
		</div>
	</div>
	<div class="panel-footer">
		<div class="pull-left">
			<div class="btn-group"></div>
		</div>
	</div>
</div>

<script language="javascript" type="text/javascript"> var folder_name = "<?php echo $folder_name?>";
    var controller_name = "<?php echo $controller_name?>";
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/index.js']); </script>