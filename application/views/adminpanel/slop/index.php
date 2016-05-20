<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading row'>
		<h4 class="col-sm-2 col-md-2">边坡列表</h4>
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
		<div class="text-left">
		<?php  echo $table_data;?>
		</div>
	</div>

	<div class="panel-footer">
	<?php aci_ui_a($folder_name,'slop','add_slop','',' class="btn btn-default"','<span class="glyphicon glyphicon-plus"></span> 添加边坡')?>
		<?php aci_ui_a($folder_name,'project','list_project','',' class="btn btn-default"','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
	</div>
</div>

<script language="javascript" type="text/javascript"> 
	var folder_name = "<?php echo $folder_name?>";
    var controller_name = "<?php echo $controller_name?>";
     
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/index.js']); </script>