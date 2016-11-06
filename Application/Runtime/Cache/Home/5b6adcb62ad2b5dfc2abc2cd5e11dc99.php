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
	<div class="login-container animated fadeInDown">
	    <div class="loginbox bg-white">
	        <div class="loginbox-title">SIGN IN</div>
	        <form action="/lslyglxt/index.php/Home/Login/checkLogin" method="post" id="loginform">
	        <div class="loginbox-textbox">
	            <input type="text" class="form-control" name="account" placeholder="Username" id="username"/>
	        </div>
	        <div class="loginbox-textbox">
	            <input type="password" class="form-control" name="password" placeholder="Password" id="password"/>
	        </div>
	        <div class="loginbox-forgot">
	            <a href=""></a>
	        </div>
	        <div class="loginbox-submit">
	            <input type="button" class="btn btn-primary btn-block" onclick="dologin()" value="登入">
	        </div>  
	        </form>   
	        
	        <div class="loginbox-submit">
	            <input type="button" class="btn btn-primary btn-block" onclick="goregister()" value="注册">
	        </div>  
	        
	        <?php if(!empty($_SESSION['__SYS_MESSAGE__'])): ?><div class="row">
       			<div class="loginbox-textbox">
	        		<?php if($_SESSION['__SYS_MESSAGE_TYPE__'] == 'error'): ?><div class="alert alert-danger fade in">
	        		<?php else: ?>
	        		<div class="alert alert-<?php echo (strtolower($_SESSION['__SYS_MESSAGE_TYPE__'])); ?> fade in"><?php endif; ?>
                     <button class="close" data-dismiss="alert">
                         ×
                     </button>
                     <?php if($_SESSION['__SYS_MESSAGE_TYPE__'] == 'success'): ?><i class="fa-fw fa fa-check"></i>
                     <?php elseif($_SESSION['__SYS_MESSAGE_TYPE__'] == 'error'): ?>
                     <i class="fa-fw fa fa-times"></i>
                     <?php else: ?>
                     <i class="fa-fw fa fa-<?php echo (strtolower($_SESSION['__SYS_MESSAGE_TYPE__'])); ?>"></i><?php endif; ?>
                     <strong><?php echo (ucfirst($_SESSION['__SYS_MESSAGE_TYPE__'])); ?></strong> <?php echo ($_SESSION['__SYS_MESSAGE__']); ?>
                	</div>
                </div>
           </div><?php endif; ?>
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