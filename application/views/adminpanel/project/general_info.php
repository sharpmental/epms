<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading'>
		<i class='glyphicon glyphicon-th-list'></i> 项目信息
		<div class='panel-tools'>
			<div class='btn-group'>
			<?php aci_ui_a($folder_name,'project','index','',' class="btn "','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
            </div>
		</div>
	</div>

	<div class="panel-body">
		<div class="row text-center">
			<h4>项目信息列表</h4>
		</div>
		<div class="row col-sm-9 col-md-9 col-sm-offset-1 col-md-offset-1">

			<div class="btn-group btn-group-justified" role="group"
				aria-label="...">
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-primary">项目概况</button>
				</div>
				
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-success">建设情况</button>
				</div>
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-info">边坡概况</button>
				</div>
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-warning">仪器数据</button>
				</div>
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-danger">预警信息</button>
				</div>
			</div>

		</div>
		<div class="row">
			<div class="col-sm-9 col-md-9 text-center">
				<h5>概况介绍</h5>
				<div style="width: 100%">
					<?php echo $table_data?>
					<?php echo $pageslink?>
				</div>
			</div>
			<div class="col-sm-3 col-md-3 text-center">
				<h5>工程概况图片</h5>
				<div style="width: 100%">
					<img src="" alt="A" style="height: 120px; width: 100%">
				</div>
			</div>
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