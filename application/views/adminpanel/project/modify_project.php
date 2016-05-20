<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading row'>
		<h4 class="col-sm-2 col-md-2">修改项目</h4>
		<div class="col-sm-7 col-md-7 ">
			<div class="btn-group btn-group-justified" role="group"
				aria-label="...">
				<div class="btn-group" role="group">
					<a type="button" class="btn btn-primary"
						href="<?php echo base_url($this->page_data['folder_name'].'/project/list_project')?>">项目列表</a>
				</div>
				<div class="btn-group" role="group">
					<a type="button" class="btn btn-success"
						href="<?php echo base_url($this->page_data['folder_name'].'/slop/index')?>">边坡列表</a>
				</div>
				<div class="btn-group" role="group">
					<a type="button" class="btn btn-info"
						href="<?php echo base_url($this->page_data['folder_name'].'/device/index')?>">设备列表</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="panel-body">
		<form class="form-horizontal" id="addform" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url($folder_name.'/project/modify_project_r/'.$data['project_id'])?>">
			<div class="form-group">
				<label for="project_name" class="col-sm-2 control-label">项目名称</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="project_name" name="project_name"
						placeholder="项目名称" value="<?php echo $data['project_name']?>">
				</div>
			</div>
			<div class="form-group">
				<label for="project_des" class="col-sm-2 control-label">项目描述</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="project_des" name="project_des"
						placeholder="项目描述" value="<?php echo $data['project_description']?>">
				</div>
			</div>
			<div class="form-group">
				<label for="start_time" class="col-sm-2 control-label">开始时间</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="start_time" name="start_time"
						placeholder="开始时间" value="<?php echo $data['start_time']?>">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">地理位置</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="address" name="address" 
					placeholder="地理位置" value="<?php echo $data['position_char']?>">
				</div>
			</div>
			<div class="form-group">
				<label for="pic" class="col-sm-2 control-label">上传项目图片</label>
				<div class="col-sm-7"> 
					<input type="file" class="form-control" id="pic" name="userfile[]" accept="image/*"
						placeholder="上传项目图片" value="<?php echo $data['picture_path']?>">
				</div>
			</div>
			<div class="form-group">
				<label for="construction" class="col-sm-2 control-label">建造情况</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="construction" name="construction"
						placeholder="建造情况" value="<?php echo $data['construction_char']?>">
				</div>
			</div>
			<div class="form-group">
				<label for="construct_pic" class="col-sm-2 control-label">上传建造图片</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="construct_pic" name="userfile[]" accept="image/*"
						placeholder="上传建造图片" value="<?php echo $data['construction_picture_path']?>">
				</div>
			</div>
			<div class="form-group">
				<label for="slop" class="col-sm-2 control-label">边坡概况</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="slop" name="slop" 
					placeholder="边坡概况" value="<?php echo $data['general_slop']?>">
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
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/modify_project.js']); </script>