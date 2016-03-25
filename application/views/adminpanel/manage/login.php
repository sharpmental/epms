<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header navbar-left">
                <p class="btn btn-info navbar-btn">LOGO</p>
            </div>
            <div class="navbar-header navbar-right">
                <p class="btn btn-info navbar-btn">下方输入用户名与密码，登录EPMS系统</p>
            </div>
        </div>
    </nav>

    <div class="container" style="height:100%; background: url(/images/login_back.png);">

        <form class="form-signin" role="form" action="<?php echo current_url()?>" method="post" id="validateform" name="validateform">
            <div class="form-signin-body">

                <div class="form-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" id="username" name="username" class="form-control" placeholder="请输入管理帐号" autofocus>
                </div>

                <div class="form-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" id="password" name="password" class="form-control" placeholder="请输入管理密码" autofocus>
                </div>

                <button class="btn btn-success btn-block" type="submit" id="dosubmit"> 登录</button>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="rmbUser" value="remember-me"> 在此设备上保存登录
                    </label>
                </div>
            </div>
            <div class="form-signin-footer"> <a><i class="glyphicon glyphicon-question-sign"></i> 忘记密码？</a></div>
        </form>
        <script language="javascript" type="text/javascript">
            require(['/scripts/<?php echo $folder_name?>/login.js']);
        </script>