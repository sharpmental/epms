<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>
<?php if (!isset($hidden_menu)): ?>
<style type="text/css">
.objbody {
	overflow: hidden
}
</style>
<div class="white-bg">
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header navbar-icon-menu">
				<button type="button" class="navbar-toggle collapsed " data-toggle="collapse" data-target="#navbar" aria-expanded="false" >
					<span class="sr-only">Toggle navigation</span> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Guest Access</a>
				<p></p>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-icon-menu ">
                <?php if ($menu_data) foreach ($menu_data as $k => $v): ?>
                	<li><a href="<?php echo $v['url'] ?>"> 
                		<i class="fa fa-<?php echo $v['css_icon'] ?>"></i>
                		<span><?php echo $v['menu_name'] ?></span>
                		</a>
					</li>
                <?php endforeach; ?>
                </ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
            <?php if ($sub_menu_data) foreach ($sub_menu_data as $k => $v): ?>
            	<div class="list-group">
					<a class="list-group-item active" href="<?php echo $v['url']?>"><?php echo $v['menu_name'] ?> </a>
                    <?php $sub_array = $v ['sub_array'];
						  if ($sub_array)
							foreach ( $sub_array as $key => $m ) {
							?>
                    <a href="<?php echo $m['url'] ?>"
					class="list-group-item"><?php echo $m['menu_name'] ?> <i class="fa fa-chevron-right"></i></a>
                    <?php }	?>
                    </div>
                    <?php endforeach; ?>
                    
                </div>
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2"
				style="padding: 0px; padding-top: 80px;">
				<div class="text-right pull-right" style="padding-right: 10px;">
					<i class="fa fa-user"></i> <?php echo $this->user_name?> [ <?php echo group_name($this->group_id)?>], <a
						href="<?php echo base_url('adminpanel/manage/logout')?>">注销</a>
				</div>

				<ul class='breadcrumb' id='breadcrumb'>
                         <?php echo $current_pos?>
                    </ul>

				<div style="padding: 0px 10px">
                        <?php echo $sub_page?>
                    </div>
			</div>
		</div>
	</div>
</div>
<?php else: ?>
<style type="text/css">
body {
	overflow: hidden;
}
</style>
<?php echo $sub_page?>
<?php endif; ?>
