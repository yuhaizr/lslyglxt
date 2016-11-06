<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<!--Head-->
<head>
    <meta charset="utf-8" />
    <title><?php echo ($page_title); ?></title>

    <meta name="description" content="<?php echo ($page_description); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="/lslyglxt/Public/img/favicon.png" type="image/x-icon">

    <!--Basic Styles-->
    <link href="/lslyglxt/Public/css/bootstrap.min.css" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <link href="/lslyglxt/Public/css/font-awesome.min.css" rel="stylesheet" />

    <!--Beyond styles-->
    <link id="beyond-link" href="/lslyglxt/Public/css/beyond.min.css" rel="stylesheet" />
    <link href="/lslyglxt/Public/css/demo.min.css" rel="stylesheet" />
    <link href="/lslyglxt/Public/css/animate.min.css" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />

	<script type="text/javascript">
	var __URL = '/lslyglxt/index.php/Home/Login';
	var __APP = '/lslyglxt/index.php';
	var __PUBLIC = '/lslyglxt/Public';
	</script>
    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="/lslyglxt/Public/js/skins.min.js"></script>
</head>
<!--Head Ends-->
<!--Body-->
<body>
   <div class="register-container animated fadeInDown">
        <div class="registerbox bg-white" style="height: 400px!important;">
            <div class="registerbox-title">注册</div>

            <div class="registerbox-caption ">请填完整您的信息</div>
            <form action="/lslyglxt/index.php/Home/Login/register" method="post" id="loginform">
            <div class="registerbox-textbox">
                <input type="text" required="required" class="form-control" name='account' placeholder="账号" onkeyup="value=value.replace(/[\W]/g,'') "onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" />
            </div>
            <div class="registerbox-textbox">
                <input type="text" required="required" class="form-control" name='nickname' placeholder="昵称" />
            </div>
            <div class="registerbox-textbox">
                <input type="password" required="required" class="form-control" name='password' placeholder="密码" />
            </div>
            <div class="registerbox-textbox">
                <input type="password" required="required" class="form-control " name='repassword' placeholder="确认密码" />
            </div>
            <hr class="wide" />
            

            <div class="registerbox-submit">
                <input type="submit" class="btn btn-primary pull-center" style="margin-left: 40%;" value="注册">
            </div>
            </form>
        </div>
        <div class="logobox">
        </div>
    </div>
	<!--Basic Scripts-->
    <script src="/lslyglxt/Public/js/jquery-2.0.3.min.js"></script>
    <script src="/lslyglxt/Public/js/bootstrap.min.js"></script>

    <!--Beyond Scripts-->
    <script src="/lslyglxt/Public/js/beyond.min.js"></script>
    <script>
    	function dologin(){
    		$("#loginform").submit();
		
    	}
    	function goregister(){
    		location.href = "/lslyglxt/index.php/Home/Login/register?type=show";
    	}
    </script>
</body>
<!--Body Ends-->
</html>