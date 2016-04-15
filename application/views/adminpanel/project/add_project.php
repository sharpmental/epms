<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading row'>
		<h4 class="col-sm-2 col-md-2">新增项目</h4>
		<div class="col-sm-7 col-md-7 ">
			<div class="btn-group btn-group-justified" role="group"
				aria-label="...">
				<div class="btn-group" role="group">
					<a type="button" class="btn btn-primary"
						href="<?php echo base_url($this->page_data['folder_name'].'/project/index')?>">项目概况</a>
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

	<div class="panel-body">
		<form class="form-horizontal" id="addform" role="form" method="post" enctype="multipart/form-data" action="<?php echo current_url()."_r"?>">
			<div class="form-group">
				<label for="project_name" class="col-sm-2 control-label">项目名称</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="project_name" name="project_name"
						placeholder="项目名称">
				</div>
			</div>
			<div class="form-group">
				<label for="project_des" class="col-sm-2 control-label">项目描述</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="project_des" name="project_des"
						placeholder="项目描述">
				</div>
			</div>
			<div class="form-group">
				<label for="start_time" class="col-sm-2 control-label">开始时间</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="start_time" name="start_time"
						placeholder="开始时间">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">地理位置</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="address" name="address" placeholder="地理位置">
				</div>
			</div>
			<div class="form-group">
				<label for="pic" class="col-sm-2 control-label">上传项目图片</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="pic" name="userfile[]"
						placeholder="上传项目图片">
				</div>
			</div>
			<div class="form-group">
				<label for="construction" class="col-sm-2 control-label">建造情况</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="construction" name="construction"
						placeholder="建造情况">
				</div>
			</div>
			<div class="form-group">
				<label for="construct_pic" class="col-sm-2 control-label">上传建造图片</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="construct_pic" name="userfile[]"
						placeholder="上传建造图片">
				</div>
			</div>
			<div class="form-group">
				<label for="slop" class="col-sm-2 control-label">边坡概况</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="slop" name="slop" placeholder="边坡概况">
				</div>
			</div>
			<div class="form-group">
				<label for="slop" class="col-sm-2 control-label"></label>
				<div class="col-sm-7">
					<div class='btn-group' role="group">
						<button type="submit" class="btn btn-default" id="dosubmit"><span class="glyphicon glyphicon-ok"></span>&nbsp确定</button>
					</div>
					<div class='btn-group' role="group">
					<?php aci_ui_a($folder_name,'project','list_project','',' class="btn btn-default"','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
            		</div>
				</div>
			</div>
		</form>
	</div>

	<div class="panel-footer">
	</div>
</div>

<script language="javascript" type="text/javascript"> 
	var folder_name = "<?php echo $folder_name?>";
    var controller_name = "<?php echo $controller_name?>";
     
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/add_project.js']); </script>