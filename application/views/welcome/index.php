<?php defined('BASEPATH') or exit('No direct script access allowed.'); ?>
    <!DOCTYPE html>
    <html lang="zh-CN">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title></title>

        <!-- Bootstrap core CSS -->
        <link href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/steup.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="http://v3.bootcss.com/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="http://v3.bootcss.com/assets/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

        <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    </head>

    <body>
        <div class="site-wrapper">
            <div class="site-wrapper-inner">
                <div class="cover-container">
                    <div class="masthead clearfix">
                        <div class="inner">
                            <h3 class="masthead-brand">工程项目管理系统</h3>
                        </div>
                    </div>

                    <div class="page-header">
                        <h3>欢迎使用本系统.请使用新版本的浏览器并不要关闭javascript，否则影响正常使用。</h3>
                        <h4>选择下方对应链接进入系统。默认管理帐号admin/0002</h4>
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="" alt="" style="height:100px;width:100%;display:block">
                                    <div class="caption">
                                        <h4>超级管理员</h4>
                                        <p>描述</p>
                                        <p><a href=<?php 
                                        if (isset($this->session->userdata['xurl']) && $this->session->userdata['xurl'])
                                        	echo site_url($this->session->userdata['xurl']);
                                        else 
                                        	echo site_url('adminpanel');?> class="btn btn-info btn-md" role="button">&nbsp;&nbsp;进入&nbsp;&nbsp;</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="" alt="" style="height:100px;width:100%;display:block">
                                    <div class="caption">
                                        <h4>项目管理员</h4>
                                        <p>描述</p>
                                        <p><a href="#" class="btn btn-info btn-md" role="button">&nbsp;&nbsp;进入&nbsp;&nbsp;</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="" alt="" style="height:100px;width:100%;display:block">
                                    <div class="caption">
                                        <h4>业务员</h4>
                                        <p>描述</p>
                                        <p><a href="#" class="btn btn-info btn-md" role="button">&nbsp;&nbsp;进入&nbsp;&nbsp;</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="" alt="" style="height:100px;width:100%;display:block">
                                    <div class="caption">
                                        <h4>用户管理员</h4>
                                        <p>描述</p>
                                        <p><a href="#" class="btn btn-info btn-md" role="button">&nbsp;&nbsp;进入&nbsp;&nbsp;</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="" alt="" style="height:100px;width:100%;display:block">
                                    <div class="caption">
                                        <h4>客户</h4>
                                        <p>描述</p>
                                        <p><a href="#" class="btn btn-info btn-md" role="button">&nbsp;&nbsp;进入&nbsp;&nbsp;</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <div class="thumbnail">
                                    <img src="" alt="" style="height:100px;width:100%;display:block">
                                    <div class="caption">
                                        <h4>访客</h4>
                                        <p>描述</p>
                                        <p><a href="#" class="btn btn-info btn-md" role="button">&nbsp;&nbsp;进入&nbsp;&nbsp;</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mastfoot">
                        <div class="inner">
                            <p>
                                Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="mailto:shunmin.wu@gmail.com">WSM</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="http://v3.bootcss.com/assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>

    </html>