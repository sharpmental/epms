<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>
<?php if (!isset($hidden_menu)): ?>
<style type="text/css">
.objbody {
	overflow: hidden
}
</style>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
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
                	<li class="dropdown">
                		<a href="<?php echo $v['url'] ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
                	    <i class="fa fa-<?php echo $v['css_icon'] ?>"></i> 
                	    <span><?php echo $v['menu_name'] ?></span>
						</a>
				   <?php if(isset($v['sub_menu'])) {
				    echo "<ul class='dropdown-menu'>";
				    foreach ($v['sub_menu'] as $kk=>$vv) {?>
				   		<li><a href="<?php echo $vv['url']?>"><?php echo $vv['menu_name']?></a></li>
				   <?php }?>
				   </ul>
				   <?php }?>
				   </li>
                <?php } ?>
                </ul>
                <ul class="nav navbar-nav navbar-right" >
                <li>
                	<a href="<?php echo base_url('adminpanel/manage/logout')?>"><i class="fa fa-user"></i> <?php echo $this->user_name?> [ <?php echo group_name($this->group_id)?>], 注销</a>
                </li>
				</ul>
		</div>
		</div>
	</nav>
	
    <?php echo $sub_page?>
            

<?php else: ?>

<?php echo $sub_page?>
<?php endif; ?>
