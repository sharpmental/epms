<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading row'>
		<h4 class="col-sm-2 col-md-2">修改边坡</h4>
		<div class="col-sm-7 col-md-7 ">
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

	<div class="panel-body">
		<form class="form-horizontal" id="addform" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url($folder_name.'/slop/modify_slop_r/'.$slop['slop_id'])?>">
			<div class="form-group">
				<label for="slop_name" class="col-sm-2 control-label">边坡名称</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="slop_name" name="slop_name" value="<?php echo $slop['slop_name']?>"
						placeholder="边坡名称">
				</div>
			</div>
			<div class="form-group">
				<label for="slop_des" class="col-sm-2 control-label">边坡描述</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="slop_des" name="slop_des" value="<?php echo $slop['slop_description']?>"
						placeholder="边坡描述">
				</div>
			</div>
			<div class="form-group">
				<label for="start_time" class="col-sm-2 control-label">开始时间</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="start_time" name="start_time" value="<?php echo $slop['start_time']?>"
						placeholder="开始时间">
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">地理位置</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="address" name="address" placeholder="地理位置" value="<?php echo $slop['position_char']?>" >
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">地图X坐标值</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="cord-x" name="cord-x" placeholder="地图X坐标值" value="<?php echo $slop['position_x']?>" >
				</div>
			</div>
			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">地图Y坐标值</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="cord-y" name="cord-y" placeholder="地图Y坐标值" value="<?php echo $slop['position_y']?>" >
				</div>
			</div>
			<div class="form-group">
				<label for="alarm-model" class="col-sm-2 control-label">报警模型</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="alarm-model" name="alarm-model" placeholder="报警模型" value="<?php echo $slop['alarm_model']?>" >
				</div>
			</div>
			<div class="form-group">
				<label for="slop_type" class="col-sm-2 control-label">边坡类型</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="slop_type" name="slop_type" 
					value="<?php echo $slop['slop_type']?>" >
				</div>
			</div>
			<div class="form-group">
				<label for="env_id" class="col-sm-2 control-label">环境属性</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="env_id" name="env_id" value="<?php echo $slop['env_id']?>">
				</div>
			</div>
			<div class="form-group">
				<label for="disease_id" class="col-sm-2 control-label">疾病属性</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="disease_id" value="<?php echo $slop['disease_id']?>"
						name="disease_id" >
				</div>
			</div>
			<div class="form-group">
				<label for="sub_road_name" class="col-sm-2 control-label">所属路段</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="sub_road_name" value="<?php echo $slop['sub_road_name']?>"
						name="sub_road_name" placeholder="所属路段">
				</div>
			</div>
			<div class="form-group">
				<label for="stake_bg" class="col-sm-2 control-label">起始桩号</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="stake_bg" name="stake_bg" value="<?php echo $slop['stake_bg']?>"
						placeholder="起始桩号">
				</div>
			</div>
			<div class="form-group">
				<label for="stake_end" class="col-sm-2 control-label">终止桩号</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="stake_end" name="stake_end" value="<?php echo $slop['stake_end']?>"
						placeholder="终止桩号">
				</div>
			</div>

			<div class="form-group">
				<label for="longtitude" class="col-sm-2 control-label">纬度</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="longtitude" value="<?php echo $slop['longtitude']?>"
						name="longtitude" placeholder="纬度">
				</div>
			</div>
			<div class="form-group">
				<label for="latitude" class="col-sm-2 control-label">经度</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="latitude" name="latitude" value="<?php echo $slop['latitude']?>"
						placeholder="经度">
				</div>
			</div>
			<div class="form-group">
				<label for="altitude" class="col-sm-2 control-label">海拔高度</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="altitude" name="altitude" value="<?php echo $slop['altitude']?>"
						placeholder="海拔高度"> 
				</div>
			</div>
			<div class="form-group">
				<label for="strength_info" class="col-sm-2 control-label">加固描述</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="strength_info" value="<?php echo $slop['strength_info']?>"
						name="strength_info" placeholder="加固描述 ">
				</div>
			</div>
			
			
			<div class="form-group">
				<label for="pic" class="col-sm-2 control-label">设计图片</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="design-pic" name="userfile[]" accept="image/*"
						placeholder="上传项目图片">
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
					<select class="form-control validate[required]" name="project_id">
							  <?php echo $project_list?>
							</select>
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
     
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/modify_slop.js']); </script>