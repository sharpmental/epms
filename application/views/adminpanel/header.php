<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>
<!DOCTYPE html>
<meta charset="UTF-8">
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="robots" content="noindex,nofollow" />
 
<title><?php echo SITE_NAME?></title>
<link href="<?php echo base_url('css/bootstrap.css')?>" rel="stylesheet">
<link type="text/css" href="<?php echo base_url('css/font-awesome.min.css')?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('css/jquery.dataTables.min.css')?>" rel="stylesheet" />

<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo base_url('css/font-awesome-ie7.min.css')?>">
<![endif]-->

<link type="text/css" href="<?php echo base_url('css/jquery-ui.css')?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url(ADMIN_CSS_PATH.'style.css')?>">

<?php if(isset($require_js)):?>
<script src="<?php echo base_url('/scripts/require.js')?>" data-main="/scripts/common"></script>
<?php else:?>
<script src="<?php echo base_url('/scripts/lib/jquery.js')?>" ></script>
<script src="<?php echo base_url('/scripts/lib/jquery-ui.js')?>"></script>
<script src="<?php echo base_url('/scripts/lib/jquery.datetimepicker.js')?>"></script>
<script src="<?php echo base_url('/scripts/lib/jquery.validationEngine-zh_CN.js')?>" ></script>
<script src="<?php echo base_url('/scripts/lib/jquery.validationEngine.js')?>" ></script>
<script src="<?php echo base_url('/scripts/lib/global.js')?>"></script>
<?php endif;?>

 <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="<?php echo base_url(ADMIN_CSS_PATH.'ie8-responsive-file-warning.js')?>"></script><![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
