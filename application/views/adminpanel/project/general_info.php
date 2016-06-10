<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading row'>
		<h4 class="col-sm-2 col-md-2">项目概况</h4>
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
	<div class="panel-body text-center">
		<div class="text-left">
			<h5>
				<span class="glyphicon glyphicon-info-sign"></span>&nbsp项目ID：<?php echo $project_id?></h5>
		</div>
		<div class="col-sm-7 col-md-7 text-center">
			<div class="">
				<h4>概况介绍</h4>
				<pre class="text-left"><h4><?php echo $information?></h4></pre>
			</div>
			<div>
				<div class="list-group text-left">
					<li href="#" class="list-group-item active">边坡列表</li>
					<?php echo $table_data?>
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-md-4 btn text-center">
			<h4>建造状况图片</h4>
			<div class="thumbnail">
				<img src="<?php echo $pic_path?>"
					alt="Picture Lost? Check directory: <?php echo $pic_path?>"
					style="height: 320px; width: 100%">
			</div>
		</div>
	</div>
	
	<div class="panel-footer">
		<div class="pull-left">
			<div class="btn-group">
				<!-- <?php aci_ui_a($folder_name,'project','add_project/'.$project_id,'',' class="btn btn-default"','<span class="glyphicon glyphicon-plus"></span> 新增项目')?> -->
            	<!-- <?php aci_ui_a($folder_name,'project','modify_project/'.$project_id,'',' class="btn btn-default"','<span class="glyphicon glyphicon-pencil"></span> 修改项目')?> -->
            	<!-- <?php aci_ui_a($folder_name,'project','delete_project/'.$project_id,'',' class="btn btn-default"','<span class="glyphicon glyphicon-remove"></span> 删除项目')?> -->
            	
			</div>
			<div class='btn-group' role="group">
			<?php aci_ui_a($folder_name,'project','construct_info/'.$project_id,'',' class="btn btn-default"','<span class="glyphicon glyphicon-road"></span> 建造情况')?>
            <?php aci_ui_a($folder_name,'project','index','',' class="btn btn-default"','<span class="glyphicon glyphicon-map-marker"></span> 地图查询')?>
            </div>
            <div class='btn-group' role="group">
            <?php aci_ui_a($folder_name,'project','general_info','',' class="btn btn-default"','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
            </div>
		</div>
	</div>
</div>

<script language="javascript" type="text/javascript"> var folder_name = "<?php echo $folder_name?>";
    var controller_name = "<?php echo $controller_name?>";
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/general_info.js']); </script>