<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading'>
		<i class='glyphicon glyphicon-th-list'></i>Data Display
		<div class='panel-tools'>
			<div class='btn-group'>
			<?php aci_ui_a($folder_name,'project','index','',' class="btn "','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
            </div>
		</div>
	</div>

	<div class="panel-body">
		<div class="row text-center">Project detail information</div>
		<div class="row">
			<ul class="nav navbar-nav navbar-icon-menu ">
                <?php if ($menu_data) foreach ($menu_data as $k => $v): ?>
                	<li><a href="<?php echo $v['url'] ?>"> <i
						class="fa fa-<?php echo $v['css_icon'] ?>"></i> <span><?php echo $v['menu_name'] ?></span>
				</a></li>
                <?php endforeach; ?>
                </ul>
		</div>
		<div class="row">
			<div class="col-sm-4 col-md-4 btn text-center">
				Project general information
				<div class="list-group">
					<a href="#" class="list-group-item active"> Device install info </a>
					<a href="#" class="list-group-item">Device A</a> <a href="#"
						class="list-group-item">Device B</a> <a href="#"
						class="list-group-item">Device C</a> <a href="#"
						class="list-group-item">Device D</a>
				</div>
			</div>
			<div class="col-sm-7 col-md-7 text-center">
				Project picture
				<div class="row"> 
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>#</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Username</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">1</th>
							<td>Mark</td>
							<td>Otto</td>
							<td>@mdo</td>
						</tr>
						<tr>
							<th scope="row">2</th>
							<td>Jacob</td>
							<td>Thornton</td>
							<td>@fat</td>
						</tr>
					</tbody>
				</table>
				</div>
				<div class="row">
					Data Chart
				</div>
			</div>
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