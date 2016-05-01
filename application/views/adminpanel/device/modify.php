<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading row'>
		<h4 class="col-sm-2 col-md-2">设备信息</h4>
		<div class="col-sm-8 col-md-8 ">
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
		<
		<form class="form-horizontal" id="addform" role="form" method="post"
			enctype="multipart/form-data"
			action="<?php echo base_url($folder_name.'/device/modify_r/'.$device['device_id'])?>">
			<div class="form-group">
				<label for="device_name" class="col-sm-2 control-label">设备名称</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="device_name"
						name="device_name" value="<?php echo $device['device_name']?>"
						placeholder="设备名称">
				</div>
			</div>
			<div class="form-group">
				<label for="device_des" class="col-sm-2 control-label">设备描述</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="device_des"
						name="device_des"
						value="<?php echo $device['device_description']?>"
						placeholder="设备描述">
				</div>
			</div>
			<div class="form-group">
				<label for="device_type" class="col-sm-2 control-label">设备类型</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="device_type"
						value="<?php echo $device['device_type']?>" name="device_type"
						placeholder="设备类型">
				</div>
			</div>

			<div class="form-group">
				<label for="devicepic" class="col-sm-2 control-label">设备图片</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="device-pic"
						name="userfile[]" accept="image/*" placeholder="上传项目图片">
				</div>
			</div>
			<div class="form-group">
				<label for="install-pic" class="col-sm-2 control-label">安装图片</label>
				<div class="col-sm-7">
					<input type="file" class="form-control" id="install-pic"
						name="userfile[]" accept="image/*" placeholder="上传项目图片">
				</div>
			</div>

			<div class="form-group">
				<label for="formular" class="col-sm-2 control-label">计算公式</label>
				<div class="col-sm-7">
					<input type="" class="form-control" id="formular"
						value="<?php echo $device['formular']?>" name="formular"
						placeholder="计算公式">
				</div>
			</div>
			<div class="form-group">
				<label for="slop_id" class="col-sm-2 control-label">边坡号码</label>
				<div class="col-sm-7">
					<select class="form-control validate[required]" name="slop_id">
							  <?php echo $slop_list?>
							</select>
				</div>
			</div>

			<div class="form-group">
				<label for="device" class="col-sm-2 control-label"></label>
				<div class="col-sm-7">
					<div class='btn-group' role="group">
						<button type="submit" class="btn btn-default" id="dosubmit">
							<span class="glyphicon glyphicon-ok"></span>&nbsp确定
						</button>
					</div>
					<div class='btn-group' role="group">
					<?php aci_ui_a($folder_name,'device','index','',' class="btn btn-default"','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
            		</div>
				</div>
			</div>
		</form>
	</div>

	<div class="panel-footer">
		<div class="pull-left">
			<div class="btn-group"></div>
		</div>
	</div>
</div>

<script language="javascript" type="text/javascript"> var folder_name = "<?php echo $folder_name?>";
    var controller_name = "<?php echo $controller_name?>";
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/modify.js']); </script>