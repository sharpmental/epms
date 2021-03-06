<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading row'>
		<h4 class="col-sm-2 col-md-2">项目信息列表</h4>
		<div class="col-sm-8 col-md-8 ">
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
	<div class="row">
		<div class="col-sm-3 col-md-3 text-center ">
			<h5>项目列表</h5>
			<!-- div class="list-group text-left">
					<?php echo $table_data?>
				</div -->
			<div id="treeview1" class="text-left"></div>
		</div>
		<div class="col-sm-4 col-md-4 text-center panel panel-default">
			<h5>项目信息</h5>
			<div class="text-left ">
				<?php echo $info_table?>
				</div>
		</div>
		<div class="col-sm-4 col-md-4 text-center ">
			<h5>工程概况图片</h5>
			<img src="<?php echo './upload/project_info/'.$project_id.'/project_pic.jpg'?>" 
				alt="Picture Lost? Check directory: <?php echo '/upload/project_info/'.$project_id.'/'?>" 
				style="height: 280px; width: 100%">
		</div>
	</div>
</div>

<div class="panel-footer">
	<div class="pull-left">
		<div class="btn-group">
			<a class="btn btn-default" href='<?php echo base_url($this->page_data['folder_name']."/project/add_project")?>'>新增项目</a>
			<a class="btn btn-default" href='<?php echo base_url($this->page_data['folder_name']."/project/modify_project/".$project_id)?>'>修改项目</a>
			<a class="btn btn-default" id="btn-delete" href='<?php echo base_url($this->page_data['folder_name']."/project/delete_project/".$project_id)?>'>删除项目</a>
		</div>
		
		<div class='btn-group' role="group">
			<?php aci_ui_a($folder_name,'project','list_project','',' class="btn btn-default"','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
        </div>
	</div>
</div>
</div>

<script language="javascript" type="text/javascript"> 
    var folder_name = "<?php echo $folder_name?>";
    var controller_name = "<?php echo $controller_name?>";
    var project_id = "<?php echo $project_id?>";
    var defaultData = '<?php echo $json_table ?>';
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/list_project.js']); </script>