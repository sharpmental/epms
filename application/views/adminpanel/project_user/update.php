<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading row'>
		<h4 class="col-sm-2 col-md-2">项目关联</h4>
		<div class="col-sm-8 col-md-8 ">
			<div class="btn-group btn-group-justified" role="group"
				aria-label="...">
				<div class="btn-group" role="group">
					<a type="button" class="btn btn-primary"
						href="<?php echo base_url($this->page_data['folder_name'].'/project/general_info')?>">项目概况</a>
				</div>
				<div class="btn-group" role="group">
					<a type="button" class="btn btn-success"
						href="<?php echo base_url($this->page_data['folder_name'].'/project/construct_info')?>">建设情况</a>
				</div>
				<div class="btn-group" role="group">
					<a type="button" class="btn btn-info"
						href="<?php echo base_url($this->page_data['folder_name'].'/project/slop_info')?>">边坡概况</a>
				</div>
				<div class="btn-group" role="group">
					<a type="button" class="btn btn-warning"
						href="<?php echo base_url($this->page_data['folder_name'].'/project/device_info')?>">仪器数据</a>
				</div>
				<div class="btn-group" role="group">
					<a type="button" class="btn btn-danger"
						href="<?php echo base_url($this->page_data['folder_name'].'/project/alarm')?>">预警信息</a>
				</div>
			</div>
		</div>

	</div>
	<form class="form-horizontal" id="addform" role="form" method="post"
		enctype="multipart/form-data"
		action="<?php echo base_url($folder_name . '/project_user/update_r/' . $user_id)?>">
		<div class="panel-body">
			<div class="panel panel-default">
				<div class="panel-heading">
		用户姓名:<?php echo $user_name?>
		</div>
				<div class="panel-body"><?php echo $content?></div>
			</div>

		</div>


		<div class="panel-footer">
			<div class="pull-left">
				<div class="btn-group">
					<button type="submit" class="btn btn-default" id="dosubmit">
						<span class="glyphicon glyphicon-ok"></span>&nbsp确定
					</button>
			<?php aci_ui_a($folder_name,'project_user','index','',' class="btn btn-default"','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
			</div>
			</div>
		</div>
	</form>
</div>

<script language="javascript" type="text/javascript"> 
	var folder_name = "<?php echo $folder_name?>";
    var controller_name = "<?php echo $controller_name?>";
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/index.js']);  
    </script>