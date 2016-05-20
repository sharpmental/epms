<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading row'>
		<h4 class="col-sm-2 col-md-2">新增边坡</h4>
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
		<form class="form-horizontal" id="addform" role="form" method="post"
			enctype="multipart/form-data"
			action="<?php echo current_url()."_r"?>">
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
					<input type="" class="form-control" id="start_time"
						name="start_time" placeholder="开始时间">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">地理位置</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="address" name="address"
						placeholder="地理位置">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">地图X坐标值</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="cord-x" name="cord-x"
						placeholder="地图X坐标值">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">地图Y坐标值</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="cord-y" name="cord-y"
						placeholder="地图Y坐标值">
				</div>
			</div>
			<div class="form-group">
				<label for="alarm_model" class="col-sm-2 control-label">报警模型</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="alarm-model"
						name="alarm-model" placeholder="报警模型">
				</div>
			</div>
			<div class="form-group">
				<label for="slop_type" class="col-sm-2 control-label">边坡类型</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="slop_type" name="slop_type"
						placeholder="边坡类型">
				</div>
			</div>
			<div class="form-group">
				<label for="env_id" class="col-sm-2 control-label">环境属性</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="env_id" name="env_id"
						placeholder="环境属性">
				</div>
			</div>
			<div class="form-group">
				<label for="disease_id" class="col-sm-2 control-label">疾病属性</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="disease_id"
						name="disease_id" placeholder="疾病属性">
				</div>
			</div>
			<div class="form-group">
				<label for="sub_road_name" class="col-sm-2 control-label">所属路段</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="sub_road_name"
						name="sub_road_name" placeholder="所属路段">
				</div>
			</div>
			<div class="form-group">
				<label for="stake_bg" class="col-sm-2 control-label">起始桩号</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="stake_bg" name="stake_bg"
						placeholder="起始桩号">
				</div>
			</div>
			<div class="form-group">
				<label for="stake_end" class="col-sm-2 control-label">终止桩号</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="stake_end" name="stake_end"
						placeholder="终止桩号">
				</div>
			</div>

			<div class="form-group">
				<label for="longtitude" class="col-sm-2 control-label">纬度</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="longtitude"
						name="longtitude" placeholder="纬度">
				</div>
			</div>
			<div class="form-group">
				<label for="latitude" class="col-sm-2 control-label">经度</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="latitude" name="latitude"
						placeholder="经度">
				</div>
			</div>
			<div class="form-group">
				<label for="altitude" class="col-sm-2 control-label">海拔高度</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="altitude" name="altitude"
						placeholder="海拔高度">
				</div>
			</div>
			<div class="form-group">
				<label for="strength_info" class="col-sm-2 control-label">加固描述</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="strength_info"
						name="strength_info" placeholder="加固描述 ">
				</div>
			</div>


			<div class="form-group">
				<label for="pic" class="col-sm-2 control-label">设计图片</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="design-pic"
						name="userfile[]" accept="image/*" placeholder="上传项目图片">
				</div>
			</div>
			<!--  div class="form-group">
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
			</div -->
			<div class="form-group">
				<label for="pic" class="col-sm-2 control-label">3D展示图</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="3d-pic"
						name="userfile[]" accept="image/*" placeholder="上传项目图片">
				</div>
			</div>
			<div class="form-group">
				<label for="pic" class="col-sm-2 control-label">上传视频</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="video"
						name="userfile[]" accept="*" placeholder="上传项目图片">
				</div>
			</div>
			<div class="form-group">
				<label for="construction" class="col-sm-2 control-label">所属项目</label>
				<div class="col-sm-7">
					<select class="form-control validate[required]" name="project_id">
							  <?php echo $project_list?>
							</select>
				</div>
			</div>

			<div class="form-group">
				<label for="slop" class="col-sm-2 control-label"></label>
				<div class="col-sm-7">
					<div class='btn-group' role="group">
						<button type="submit" class="btn btn-default" id="dosubmit">
							<span class="glyphicon glyphicon-ok"></span>&nbsp确定
						</button>
					</div>
					<div class='btn-group' role="group">
					<?php aci_ui_a($folder_name,'project','list_project','',' class="btn btn-default"','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
            		</div>
				</div>
			</div>
		</form>
	</div>

	<div class="panel-footer"></div>
</div>

<script language="javascript" type="text/javascript"> 
	var folder_name = "<?php echo $folder_name?>";
    var controller_name = "<?php echo $controller_name?>";
     
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/add_slop.js']); </script>