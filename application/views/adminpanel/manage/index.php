<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading'>
		<i class='glyphicon glyphicon-th-list'></i>Function List
		<div class='panel-tools'>
			<div class='btn-group'>
			<?php aci_ui_a($folder_name,'manage','index','',' class="btn "','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
            <div class="btn" id="refreshBtnF"></div>
			</div>
		</div>
	</div>

	<div class="panel-body">
		<div class="row ">
	            <?php if ($menu_data) foreach ($menu_data as $k => $v): ?>
	            <div class="col-xs-4 col-md-2" style="text-align:center">
				<a class="thumbnail" href="<?php echo $v['url'] ?>"> 
				<img src=""	alt="150px 170px" data-holder-rendered="true"
					style="height: 150px; width: 170px; display: block;"> 
					<span ><?php echo $v['menu_name'] ?></span>
				</a>
			</div>
                <?php endforeach; ?>
	</div>
	</div>
	<div class="panel-footer">
		<div class="pull-left">
			<div class="btn-group"></div>
		</div>
	</div>
</div>

<script language="javascript" type="text/javascript"> var folder_name = "<?php echo $folder_name?>";
    var controller_name = "<?php echo $controller_name?>";
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/index.js']); </script>