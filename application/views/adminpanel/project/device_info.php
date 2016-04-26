<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>
<script type="text/javascript" src="/scripts/pano/pano2vr_player.js"></script>

<div class="panel panel-default grid">
	<div class='panel-heading row'>
		<h4 class="col-sm-2 col-md-2">仪器数据</h4>
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
		<div class="text-left">
			<h5>
				<span class="glyphicon glyphicon-info-sign"></span>&nbsp仪器ID：<?php echo $device_id?></h5>
		</div>
		<div class="row">
			<div class="col-sm-3 col-md-3 text-center">
				<h4>仪器列表</h4>
				<div class="list-group text-left">
					<a href="" class="list-group-item active"> <?php if (!$idel) echo '边坡ID:'.$slop['slop_id']; else echo $note ?> </a> 
					<?php
					
					if (! $idel) {
						foreach ( $device_list as $k => $v ) {
							echo '<a href="' . base_url ( $this->page_data ['folder_name'] . '/project/device_info/' . $v ['device_id'] ) . '" class="list-group-item"> 设备名称:&nbsp&nbsp&nbsp&nbsp&nbsp' . $v ['device_name'] . '</a> ';
						}
					} else {
						echo '<a href="' . base_url ( $this->page_data ['folder_name'] . '/project/device_info/' . $device_list ['device_id'] ) . '" class="list-group-item"> 设备名称:&nbsp&nbsp&nbsp&nbsp&nbsp' . $device_list ['device_name'] . '</a>';
					}
					?>
				</div>
			</div>
			<div class="col-sm-4 col-md-4 text-center">
				<h4>仪器图片</h4>
				<div class="thumbnail">
					<img src="<?php echo $d_pic?>"
						alt="Picture Lost? Check directory: <?php echo $d_pic ?>"
						style="height: 150px; width: 100%">
				</div>
				<p></p>
				<div class="thumbnail">
					<img src="<?php  echo $i_pic?>"
						alt="Picture Lost? Check directory: <?php echo $i_pic ?>"
						style="height: 150px; width: 100%">
				</div>
			</div>
			<div class="col-sm-4 col-md-4 text-center">
				<h4>全景图</h4>
				<div class="thumbnail">
				<div id="container" style="width:100%;height:180px;">This content requires HTML5/CSS3, WebGL, or Adobe Flash Player Version 9 or higher.</div>
				</div>
			</div>
		</div>
	</div>

	<div class="panel-footer">
		<div class="pull-left">
		<div class="btn-group">
				<?php aci_ui_a($folder_name,'project','data_display/'.$device_id,'',' class="btn btn-default"','<span class="glyphicon glyphicon-zoom-in"></span> 查看数据')?>
			</div>
			<div class="btn-group">
				<?php aci_ui_a($folder_name,'project','slop_info/'.isset($slop['slop_id'])?$slop['slop_id']:'0' ,'',' class="btn btn-default"','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
			</div>
		</div>
	</div>
</div>

<script language="javascript" type="text/javascript"> 
	var folder_name = "<?php echo $folder_name?>";
    var controller_name = "<?php echo $controller_name?>";
    var id = "<?php echo $device_id?>";
    pano = new pano2vrPlayer("container");
    pano.readConfigUrl("/upload/device_info/"+id+"/thumb_out.xml");
    
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/device_info.js']);  
</script>