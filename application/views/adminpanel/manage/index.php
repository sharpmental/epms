<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>

<div class="panel panel-default grid">
	<div class='panel-heading'>
		<i class='glyphicon glyphicon-th-list'></i>公司介绍
		<div class='panel-tools'>
			<div class='btn-group'>
			<?php aci_ui_a($folder_name,'manage','index','',' class="btn "','<span class="glyphicon glyphicon-arrow-left"></span> 返回')?>
            <div class="btn" id="refreshBtnF"></div>
			</div>
		</div>
	</div>

	<div class="panel-body">
		<div>
			<div class="jumbotron">
				<div class="pull-right">
					<img src="/images/company_logo.jpg" class="thumbnail"
						style="width: 200px; height: 200px;"></img>
				</div>
				<h2>公司介绍</h2>
				
				<p>中国公路工程咨询集团有限公司简介</p>
				<strong>中国公路工程咨询集团有限公司（简称中咨集团）成立于1992
					年，为国资委管理的大型中央企业中国交通建设股份有限公司全资子集团，注册资本金人民币6.5
					亿元。<br>中咨集团经营范围遍布全国各省、市、自治区，连续多年跻身全国勘察设计百强行列，在公路行业勘察设计单位中连续十几年排名第一。
					中咨集团现持有勘察综合甲级、公路行业、市政行业（道路、桥梁、隧道、公共交通）、建筑行业（建筑工程）、电子行业（电子系统工程）设计甲级，公路工程咨询甲级、公路工程施工总承包壹级、公路工程路面施工专业壹级、公路交通工程施工专项、工程监理（公路、特大桥专项、特长隧道专项、机电工程专项）甲级、公路工程试验检测（公路综合、桥梁隧道工程专项、交通工程专项）甲级，对外承包工程资格等多项专业资格证书。
				</strong>

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