<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

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
		<div class="row">
			<div class="col-sm-3 col-md-3 text-center">
				<h4>仪器列表</h4>
				<div class="list-group text-left">
					<a href="" class="list-group-item active"> <?php if (!$idel) echo '边坡ID:'.$slop['slop_id']; else echo $note ?> </a> 
					<?php
					
if (! $idel) {
						foreach ( $device_list as $k => $v ) {
							echo '<a href="'.base_url($this->page_data['folder_name'].'/project/device_info/'.$v['device_id']).'" class="list-group-item"> 设备名称:&nbsp&nbsp&nbsp&nbsp&nbsp' . $v ['device_name'] . '</a> ';
						}
					} else {
						echo '<a href="'.base_url($this->page_data['folder_name'].'/project/device_info/'.$device_list['device_id']).'" class="list-group-item"> 设备名称:&nbsp&nbsp&nbsp&nbsp&nbsp' . $device_list ['device_name'] . '</a>';
					}
					?>
				</div>
			</div>
			<div class="col-sm-4 col-md-4 text-center">
				<h4>仪器图片</h4>
				<div style="width: 100%">
					<img src="<?php echo $d_pic?>" 
					alt="Picture Lost? Check directory: <?php echo $d_pic ?>"
					style="height: 120px; width: 100%">
				</div>
				<p></p>
				<div style="width: 100%">
					<img src="<?php  echo $i_pic?>" 
					alt="Picture Lost? Check directory: <?php echo $i_pic ?>" 
					style="height: 120px; width: 100%">
				</div>
			</div>
			<div class="col-sm-4 col-md-4 text-center">
				<h4>全景图</h4>
				<center>
					<div id="product"
						style="width: 640px; height: 480px; overflow: hidden;">
						<img src="/upload/device_info/1/01.jpg" /> <img
							src="/upload/device_info/1/02.jpg" /> <img
							src="/upload/device_info/1/03.jpg" /> <img
							src="/upload/device_info/1/04.jpg" /> <img
							src="/upload/device_info/1/05.jpg" /> <img
							src="/upload/device_info/1/06.jpg" /> <img
							src="/upload/device_info/1/07.jpg" /> <img
							src="/upload/device_info/1/08.jpg" /> <img
							src="/upload/device_info/1/09.jpg" /> <img
							src="/upload/device_info/1/10.jpg" /> <img
							src="/upload/device_info/1/11.jpg" /> <img
							src="/upload/device_info/1/12.jpg" /> <img
							src="/upload/device_info/1/13.jpg" /> <img
							src="/upload/device_info/1/14.jpg" /> <img
							src="/upload/device_info/1/15.jpg" /> <img
							src="/upload/device_info/1/16.jpg" /> <img
							src="/upload/device_info/1/17.jpg" /> <img
							src="/upload/device_info/1/18.jpg" /> <img
							src="/upload/device_info/1/19.jpg" /> <img
							src="/upload/device_info/1/20.jpg" /> <img
							src="/upload/device_info/1/21.jpg" /> <img
							src="/upload/device_info/1/22.jpg" /> <img
							src="/upload/device_info/1/23.jpg" /> <img
							src="/upload/device_info/1/24.jpg" /> <img
							src="/upload/device_info/1/25.jpg" /> <img
							src="/upload/device_info/1/26.jpg" /> <img
							src="/upload/device_info/1/27.jpg" /> <img
							src="/upload/device_info/1/28.jpg" /> <img
							src="/upload/device_info/1/29.jpg" /> <img
							src="/upload/device_info/1/30.jpg" /> <img
							src="/upload/device_info/1/31.jpg" /> <img
							src="/upload/device_info/1/32.jpg" /> <img
							src="/upload/device_info/1/33.jpg" /> <img
							src="/upload/device_info/1/34.jpg" /> <img
							src="/upload/device_info/1/35.jpg" /> <img
							src="/upload/device_info/1/36.jpg" />
					</div>
				</center>
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
    require(['/scripts/<?php echo $folder_name?>/<?php echo $controller_name?>/device_info.js']); </script>