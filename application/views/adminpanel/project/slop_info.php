<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading row'>
		<h4 class="col-sm-2 col-md-2">边坡概况</h4>
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

	<div class="panel-body text-center">
		<div class="text-left">
			<h5>
				<span class="glyphicon glyphicon-info-sign"></span>&nbsp边坡ID：<?php echo $slop['slop_id']?></h5>
		</div>
		<div class="row">
			<div class="col-sm-3 col-md-3 btn text-center">
				<h4>边坡概况</h4>
				<div class="list-group text-left">
					<a href="" class="list-group-item active"><?php echo "边坡名称:&nbsp" . $slop ['slop_name']?></a>
			<?php echo $table_data?>
			</div>
			</div>
			<div class="col-sm-4 col-md-4 btn text-center">
				<h4>边坡图片</h4>
				<div style="width: 100%">
					<img src="<?php echo $slop['design_picture_path']?>"
						alt="Picture Lost? Check directory: <?php echo $slop['design_picture_path']?>"
						style="height: 220px; width: 100%">
				</div>
			</div>
			<div class="col-sm-4 col-md-4 btn text-center">
				<h4>边坡图片</h4>
				<div style="width: 100%">
					<img src="<?php echo $slop['3d_picture_path']?>"
						alt="Picture Lost? Check directory: <?php echo $slop['3d_picture_path']?>"
						style="height: 220px; width: 100%">
				</div>
			</div>
		</div>
	</div>

	<div class="panel-footer">
		<div class="pull-left">
			<div class='btn-group' role="group">
				<?php aci_ui_a($folder_name,'slop','modify_slop/'.$slop['slop_id'],'',' class="btn btn-default"','<span class="glyphicon glyphicon-pencil"></span> 修改边坡')?>
            	<!-- <?php aci_ui_a($folder_name,'slop','delete_slop/'.$slop['slop_id'],'',' class="btn btn-default"','<span class="glyphicon glyphicon-remove"></span> 删除边坡')?> -->
            	</div>
			<div class='btn-group' role="group"><?php aci_ui_a($folder_name,'project','construct_info/'.$slop['project_id'],'',' class="btn btn-default"','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
            	</div>
		</div>
	</div>
</div>

<script language="javascript" type="text/javascript"> var folder_name = "<?php echo $folder_name?>";
    var controller_name = "<?php echo $controller_name?>";
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/slop_info.js']); </script>