<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>
<?php if (!isset($hidden_menu)): ?>
<style type="text/css">
.objbody {
	overflow: hidden
}
</style>

<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header navbar-icon-menu">
			<button type="button" class="navbar-toggle collapsed "
				data-toggle="collapse" data-target="#navbar" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Admin Access</a>
			<p></p>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			    <ul class="nav navbar-nav ">
                <?php if ($menu_data) foreach ($menu_data as $k => $v){ ?>
                	<li class=<?php if(isset($v['sub_menu'])) echo 'dropdown'; ?> >
                		<a href="<?php echo $v['url'] ?>" class="dropdown-toggle" data-toggle="dropdown" > 
                	    <i class="fa fa-<?php echo $v['css_icon'] ?>"></i> 
                	    <span><?php echo $v['menu_name'] ?></span>
                	    <span class="glyphicon glyphicon-triangle-bottom"></span>
						</a>
					<ul class="dropdown-menu">
					<li><a href="<?php echo $v['url']?>"><?php echo $v['menu_name']?></a></li>
				   <?php if(isset($v['sub_menu'])) foreach ($v['sub_menu'] as $kk=>$vv) {?>
				   		<li><a href="<?php echo $vv['url']?>"><?php echo $vv['menu_name']?></a></li>
				   <?php }?>
				   </ul>
				   </li>
                <?php } ?>
                </ul>
                
                <ul class="nav navbar-nav navbar-right" >
                <li>
                	<a href="<?php echo base_url('adminpanel/manage/logout')?>"><i class="fa fa-user"></i> <?php echo $this->user_name?>(<?php echo group_name($this->group_id)?>), 注销</a>
                </li>
				</ul>
		</div>
	</div>
</nav>

<div class="container-fluid">
<?php echo $sub_page?>
</div>
<?php else: ?>
<style type="text/css">
body {
	overflow: hidden;
}
</style>
<?php echo $sub_page?>
<?php endif; ?>
