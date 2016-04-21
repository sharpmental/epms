<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading row'>
		<h4 class="col-sm-2 col-md-2">修改边坡</h4>
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
				<label for="slop_name" class="col-sm-2 control-label">边坡名称</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="slop_name" name="slop_name" 
						placeholder="边坡名称">
				</div>
			</div>
			<div class="form-group">
				<label for="slop_des" class="col-sm-2 control-label">边坡描述</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="slop_des" name="slop_des"
						placeholder="边坡描述">
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
				<label for="address" class="col-sm-2 control-label">地图X坐标值</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="cord-x" name="cord-x" placeholder="地图X坐标值">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">地图Y坐标值</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="cord-y" name="cord-y" placeholder="地图Y坐标值">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">报警模型</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="alarm-model" name="alarm-model" placeholder="报警模型">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">属性1</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="property-1" name="property-1" placeholder="属性1">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">属性2</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="property-2" name="property-2" placeholder="属性2">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">属性3</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="property-3" name="property-3" placeholder="属性3">
				</div>
			</div>
			<div class="form-group">
				<label for="pic" class="col-sm-2 control-label">设计图片</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="design-pic" name="userfile[]" accept="image/*"
						placeholder="上传项目图片">
				</div>
			</div>
			<div class="form-group">
				<label for="pic" class="col-sm-2 control-label">加固图片</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="solidate-pic" name="userfile[]" accept="image/*"
						placeholder="上传项目图片">
				</div>
			</div>
			<div class="form-group">
				<label for="pic" class="col-sm-2 control-label">保护图片</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="conserve-pic" name="userfile[]" accept="image/*"
						placeholder="上传项目图片">
				</div>
			</div>
			<div class="form-group">
				<label for="pic" class="col-sm-2 control-label">全景图</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="panorama-pic" name="userfile[]" accept="image/*"
						placeholder="上传项目图片">
				</div>
			</div>
			<div class="form-group">
				<label for="pic" class="col-sm-2 control-label">安装图片</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="install-pic" name="userfile[]" accept="image/*"
						placeholder="上传项目图片">
				</div>
			</div>
			<div class="form-group">
				<label for="pic" class="col-sm-2 control-label">拆解图</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="decompose-pic" name="userfile[]" accept="image/*"
						placeholder="上传项目图片">
				</div>
			</div>
			<div class="form-group">
				<label for="pic" class="col-sm-2 control-label">3D展示图</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="3d-pic" name="userfile[]" accept="image/*"
						placeholder="上传项目图片">
				</div>
			</div>
			<div class="form-group">
				<label for="pic" class="col-sm-2 control-label">上传视频</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="video" name="userfile[]" accept="*"
						placeholder="上传项目图片">
				</div>
			</div>
			<div class="form-group">
				<label for="construction" class="col-sm-2 control-label">所属项目</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="project_id" name="project_id"
						value="0">
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
     
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/add_slop.js']); </script>