<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<!--Head xmlns="http://www.w3.org/1999/xhtml"-->
<head>
    <meta charset="utf-8" />
    <title><?php echo ($page_title); ?></title>

    <meta name="description" content="<?php echo ($page_description); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="/Y2Game/Public/img/favicon.png" type="image/x-icon">

    <!--Basic Styles-->
    <link href="/Y2Game/Public/css/bootstrap.min.css" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <link href="/Y2Game/Public/css/font-awesome.min.css" rel="stylesheet" />

    <!--Beyond styles-->
    <link id="beyond-link" href="/Y2Game/Public/css/beyond.min.css" rel="stylesheet" />
    <link href="/Y2Game/Public/css/demo.min.css" rel="stylesheet" />
    <link href="/Y2Game/Public/css/animate.min.css" rel="stylesheet" />
    <link href="/Y2Game/Public/css/load.css" rel="stylesheet" />
    <link id="skin-link" href="" rel="stylesheet" type="text/css" />

	<script type="text/javascript">
	var __URL = '/Y2Game/index.php/WorkManage/Work';
	var __APP = '/Y2Game/index.php';
	var __PUBLIC = '/Y2Game/Public';

	</script>
    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="/Y2Game/Public/js/skins.min.js"></script>
    <script src="/Y2Game/Public/js/jquery-1.10.2.min.js"></script>
    
<style>
	.middleDiv{
		height: 34px;
		line-height: 34px;
		text-align: center;
	}
 	.form_datetime input{
		height: 34px;
		width:242.7px;
	} 
</style>

<link href="/Y2Game/Public/css/bootstrap-datetimepicker.css" rel="stylesheet" />

    <script type="text/javascript">
    
	/* 在ajax 请求返回结果之前做些处理判断用户是否有权访问  */
	$(function(){
		var ajax = $.ajax;
	    $.ajax = function (opt) {
	        //备份opt中error和success方法
	        var fn = {
	            success: function (data, textStatus, jqXHR) {
	            }
	        }
	        if (opt.success) {
	            fn.success = opt.success;
	        }
	        //扩展增强处理
	        var _opt = $.extend(opt, {
	            success: function (data, textStatus, jqXHR) {
	                //alert('重写success事件');
	                $('.sk-circle').hide();
	                $('.mask').hide();
	                if (data.info) {
	                    alert(data.info);
	                    return;
	                }
	                fn.success(data, textStatus, jqXHR);
	            },
	        	beforeSend:function(){
	        		$('.sk-circle').show();
	        		$('.mask').show();
	        	}
	        });
	        var def = ajax.call($, _opt);                                                                                                                             // 兼容不支持异步回调的版本
	        if('done' in def){
	            var done = def.done;
	            def.done = function (func) {
	                function _done(data) {
		                $('.sk-circle').hide();
		                $('.mask').hide();
	                    if (data.info) {
	                        alert(data.info);
	                        return;
	                    }
	                    func(data);
	                }
	                done.call(def, _done);
	                return def;
	            };
	        }
	        return def;
	    };
	}); 
    </script>    
    
    
</head>
<!--Head Ends-->
<!--Body-->
<body>
<!-- ajax loading -->
	<div class='mask opacity'></div>
    <div class="sk-circle">
      <div class="sk-circle1 sk-child"></div>
      <div class="sk-circle2 sk-child"></div>
      <div class="sk-circle3 sk-child"></div>
      <div class="sk-circle4 sk-child"></div>
      <div class="sk-circle5 sk-child"></div>
      <div class="sk-circle6 sk-child"></div>
      <div class="sk-circle7 sk-child"></div>
      <div class="sk-circle8 sk-child"></div>
      <div class="sk-circle9 sk-child"></div>
      <div class="sk-circle10 sk-child"></div>
      <div class="sk-circle11 sk-child"></div>
      <div class="sk-circle12 sk-child"></div>
    </div>
<!-- ajax loading -->

<!-- Loading Container -->
    <div class="loading-container">
        <div class="loading-progress">
            <div class="rotator">
                <div class="rotator">
                    <div class="rotator colored">
                        <div class="rotator">
                            <div class="rotator colored">
                                <div class="rotator colored"></div>
                                <div class="rotator"></div>
                            </div>
                            <div class="rotator colored"></div>
                        </div>
                        <div class="rotator"></div>
                    </div>
                    <div class="rotator"></div>
                </div>
                <div class="rotator"></div>
            </div>
            <div class="rotator"></div>
        </div>
    </div>
    <!--  /Loading Container -->
    <!-- Navbar -->
    <div class="navbar">
        <div class="navbar-inner">
            <div class="navbar-container">
                <!-- Navbar Barnd -->
                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand" id="nav-title">
                        <small>
                            <!-- <img src="/Y2Game/Public/img/logo.png" alt="" /> -->
                            <font size ='2'>
                           		 Y2Game
                            </font>
                        </small>
                    </a>
                </div>
                <!-- /Navbar Barnd -->

                <!-- Sidebar Collapse -->
                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="collapse-icon fa fa-bars"></i>
                </div>
                <!-- /Sidebar Collapse -->
                <!-- Account Area and Settings --->
                <div class="navbar-header pull-right">
                    <div class="navbar-account">
                        <ul class="account-area">
							<li>
                                <a class="wave in dropdown-toggle" data-toggle="dropdown" title="Help" href="#">
                                    <i class="icon fa fa-envelope"></i>
                                    <span class="badge"><?php echo ($task_num); ?></span>
                                </a>

                                <!--Messages Dropdown-->
                                <ul class="pull-right dropdown-menu dropdown-arrow dropdown-messages">
	                           
	                                <?php if($task_num == 0): ?><li>
	                                			<a href="#" >
	                                				<span >
	                                					没有未读消息
	                                				</span>
	                                			</a>
	                                	  </li><?php endif; ?>                                
                                	<?php if(is_array($taskList)): foreach($taskList as $key=>$vo): ?><li data-url="<?php echo ($vo["url"]); ?>" data-id="<?php echo ($vo["id"]); ?>" class='read_message'>
	                                        <a >
	                                          
	                                            <div class="message">
	                                                <span class="message-sender">
	                                                   <?php echo ($vo["from_nickname"]); ?>
	                                                </span>
	                                                <span class="message-time">
	                                                   <?php echo ($vo["ctime"]); ?>
	                                                </span>
	                          	                	<span class="message-subject">
	                                                   <!-- <?php echo ($vo["message"]); ?>  -->
	                                                </span>
	                                                <span class="message-body">
	                                                   <?php echo ($vo["message"]); ?> 
	                                                </span>
	                                            </div>
	                                        </a>
	                                    </li><?php endforeach; endif; ?>
                                   		<li style="font-size: 0.2em;text-align: right;">
                                			<a href="/Y2Game/index.php/Home/Task/taskList" >
                                				<span >
                                					显示所有消息
                                				</span>
                                			</a>
                                		</li>                                   
                               </ul>     
             				</li>      

             
                            <li>
                                <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                    <div class="avatar" title="View your public profile">
                                        <img src="">
                                    </div>
                                    <section>
                                        <h2><span class="profile"><span><?php echo ($_SESSION['loginUserName']); ?></span></span></h2>
                                    </section>
                                </a>
                                <!--Login Area Dropdown-->
                                <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                        
                                    <!--Theme Selector Area-->
                                    <li class="theme-area">
                                        <ul class="colorpicker" id="skin-changer">
                                            <li><a class="colorpick-btn" href="#" style="background-color:#5DB2FF;" rel="/Y2Game/Public/css/skins/blue.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#2dc3e8;" rel="/Y2Game/Public/css/skins/azure.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#03B3B2;" rel="/Y2Game/Public/css/skins/teal.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#53a93f;" rel="/Y2Game/Public/css/skins/green.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#FF8F32;" rel="/Y2Game/Public/css/skins/orange.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#cc324b;" rel="/Y2Game/Public/css/skins/pink.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#AC193D;" rel="/Y2Game/Public/css/skins/darkred.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#8C0095;" rel="/Y2Game/Public/css/skins/purple.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#0072C6;" rel="/Y2Game/Public/css/skins/darkblue.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#585858;" rel="/Y2Game/Public/css/skins/gray.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#474544;" rel="/Y2Game/Public/css/skins/black.min.css"></a></li>
                                            <li><a class="colorpick-btn" href="#" style="background-color:#001940;" rel="/Y2Game/Public/css/skins/deepblue.min.css"></a></li>
                                        </ul>
                                    </li>
                                    <!--/Theme Selector Area-->
                                    <li class="dropdown-footer">
                                        <a href="/Y2Game/index.php/Home/login/logout">
                                            Sign out
                                        </a>
                                    </li>
                                </ul>
                                <!--/Login Area Dropdown-->
                            </li>
                            <!-- /Account Area -->
                            <!--Note: notice that setting div must start right after account area list.
                            no space must be between these elements-->
                            <!-- Settings -->
                        </ul><div class="setting">
                            <a id="btn-setting" title="Setting" href="#">
                                <i class="icon glyphicon glyphicon-cog"></i>
                            </a>
                        </div><div class="setting-container">
                            <label>
                                <input type="checkbox" id="checkbox_fixednavbar">
                                <span class="text">Fixed Navbar</span>
                            </label>
                            <label>
                                <input type="checkbox" id="checkbox_fixedsidebar">
                                <span class="text">Fixed SideBar</span>
                            </label>
                            <label>
                                <input type="checkbox" id="checkbox_fixedbreadcrumbs">
                                <span class="text">Fixed BreadCrumbs</span>
                            </label>
                            <label>
                                <input type="checkbox" id="checkbox_fixedheader">
                                <span class="text">Fixed Header</span>
                            </label>
                        </div>
                        <!-- Settings -->
                    </div>
                </div>
                <!-- /Account Area and Settings -->
            </div>
        </div>
    </div>
    <!-- /Navbar -->
    <!-- Main Container -->
    <div class="main-container container-fluid">
        <!-- Page Container -->
        <div class="page-container">
            <!-- Page Sidebar -->
            <div class="page-sidebar" id="sidebar">
                <!-- Page Sidebar Header-->
                <div class="sidebar-header-wrapper">
                    <input type="text" class="searchinput" />
                    <i class="searchicon fa fa-search"></i>
                    <div class="searchhelper">Search Reports, Charts, Emails or Notifications</div>
                </div>
                <!-- /Page Sidebar Header -->
                <!-- Sidebar Menu -->
                 <ul class="nav sidebar-menu">
                    <!--Dashboard-->
                    <li class="active">
                        <a href="index.html">
                            <i class="menu-icon glyphicon glyphicon-home"></i>
                            <span class="menu-text"> Dashboard </span>
                        </a>
                    </li>
                    <!--Tables-->
                    <?php if(is_array($menu)): foreach($menu as $key=>$value): ?><li  <?php if($value["link"] == $NOW_MENU): ?>class='open'<?php endif; ?>  >
                   			 <a href= "#" class="menu-dropdown">
	                            <i class="menu-icon fa fa-table"></i>
	                            <span class="menu-text"> <?php echo ($value["title"]); ?> </span>
	                            <i class="menu-expand"></i>
                        	</a>
                        	<ul class="submenu">
                        		<?php if(is_array($value["childs"])): foreach($value["childs"] as $key=>$v): ?><li   <?php if($v["link"] == $SECOND_NOW_MENU): ?>class='open'<?php endif; ?> >
                        				<?php if(empty($v["childs"])): ?><a href="/Y2Game/index.php<?php echo ($v["link"]); ?>" >
			                                    <span class="menu-text"><?php echo ($v["title"]); ?></span>
			                               
			                                </a> 
		                               	<?php else: ?>
		                               		<a href="#" class="menu-dropdown">
			                                    <span class="menu-text"><?php echo ($v["title"]); ?></span>
			                                    <i class="menu-expand"></i>
				                            </a> 
				                            <ul class="submenu">
				                                <?php if(is_array($v["childs"])): foreach($v["childs"] as $key=>$cv): ?><li>
						                                	  <a href="/Y2Game/index.php<?php echo ($cv["link"]); ?>" >
							                                      <span class="menu-text"><?php echo ($cv["title"]); ?></span>
							                      
						                              		  </a>
					                                	</li><?php endforeach; endif; ?> 
				                            </ul><?php endif; ?>
		                            </li><?php endforeach; endif; ?>
                        	</ul>
                    	</li><?php endforeach; endif; ?>
                </ul>
                <!-- /Sidebar Menu -->
            </div>
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                           <!--  <a href="#">Home</a> -->
                            <?php echo ($NOW_PATH); ?>
                        </li>
                      <!--   <li class="active">Dashboard</li> -->
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                <div class="page-header position-relative">
                    <div class="header-title">
                 <!--        <h1>
                            Dashboard
                        </h1> -->
                    </div>
                    <!--Header Buttons-->
                    <div class="header-buttons">
                        <a class="sidebar-toggler" href="#">
                            <i class="fa fa-arrows-h"></i>
                        </a>
                        <a class="refresh" id="refresh-toggler" href="">
                            <i class="glyphicon glyphicon-refresh"></i>
                        </a>
                        <a class="fullscreen" id="fullscreen-toggler" href="#">
                            <i class="glyphicon glyphicon-fullscreen"></i>
                        </a>
                    </div>
                    <!--Header Buttons End-->
                </div>
                <!-- /Page Header -->
        		<!-- Page Body -->
        		<div class="page-body">
        		<?php if(!empty($_SESSION['__SYS_MESSAGE__'])): ?><div class="row">
        			<div class="col-xs-12 col-md-12">
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
                 </div></div>
                 </div><?php endif; ?>
        		

<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="widget">
            <div class="widget-header ">
                <span class="widget-caption">部门日志列表</span>
                <div class="widget-buttons">
                    <a href="#" data-toggle="maximize">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a href="#" data-toggle="collapse">
                        <i class="fa fa-minus"></i>
                    </a>
                    <a href="#" data-toggle="dispose">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
            	
            	<div class="table-toolbar ">
            		<div class="row">
            			<div class="col-sm-12">
	            			<div class="row">
		            
			     <!--        		<div class = "col-sm-2">
			     	   	            <div class="search-box" >
				                		<div style="display: inline;">        			
				                			<span class="input-icon">
				                				<input type="text" value="<?php echo ($synopsis); ?>" class="form-control" id="synopsis" placeholder="请输入摘要">
				                				<i class="glyphicon glyphicon-search circular blue"></i>
				                			</span>
				                		</div>
				                	</div>	
			            		</div> -->
					   	          <div class="search-box col-sm-3" >
				                    <div class="form-group">
				                        <div class="controls">
				                            <div class="input-group">
				                                <span class="input-group-addon">
				                                    <i class="fa fa-calendar"></i>
				                                </span>
				                                <input readonly="readonly" type="text" value="<?php echo ($searchTime); ?>" class="form-control" id="searchTime" placeholder="请选择时间区间" />
				                            </div>
				                        </div>
				                    </div> 
			                	</div>	
					   	          <div class="search-box col-sm-2" >
				                    <div class="form-group">
				                        <div class="controls">
				                        
				                   			 <select style="width:100%;" name="workType" id="workType" >
				                   			 		<option value=""  />全部
					                      		 <?php if(is_array($workTypeList)): foreach($workTypeList as $k=>$value): ?><option value="<?php echo ($k); ?>" <?php echo ($workTypeSelect[$k]); ?>  /><?php echo ($value); endforeach; endif; ?>
					                 		</select>
				                        </div>
				                    </div> 
			                	</div>	
			                	<div class="col-sm-1">
	          						<a class="btn default-btn" id="search" >查询</a>
			            		</div>
			                	<div class="col-sm-2">
	          						<!-- <a class="btn default-btn" id="showAddWork" >创建日志</a> -->
			            		</div>
		            		</div>
		        
		            	</div>
          	
		            </div>
            	</div>
            
          		<table class="table table-striped table-hover table-bordered" id="editabledatatable">
                    <thead>
                        <tr role="row">
     
                            <th>序号 </th>
                            <th>姓名 </th>
                            <th>部门 </th>
                            <th>提交时间</th>
                            <th>日期</th>
                            <th>日报类别</th>
                          <!--   <th>摘要</th> -->
                            <th>得分</th>
                            <th>操作</th>

                        </tr>
                    </thead>

                    <tbody id="worklistTable">
                    	<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr work-id='<?php echo ($vo["id"]); ?>' class='showEditWork' dname='<?php echo ($vo["dname"]); ?>' nickname='<?php echo ($vo["nickname"]); ?>'>
            
                            <td><?php echo ($key+1); ?></td>
                            <td><?php echo ($vo["nickname"]); ?></td>
                            <td><?php echo ($vo["dname"]); ?></td>
                            <td><?php echo ($vo["ctime"]); ?></td>
                            <td><?php echo ($vo["date"]); ?></td>
                            <td><?php echo ($vo["type_name"]); ?></td>
                     <!--        <td><?php echo ($vo["synopsis"]); ?></td> -->
                            <td><?php echo ($vo["score"]); ?></td>
                            <td>
                      			
                            	<?php if(($vo["is_have_score"] == 0) && ($vo["worktype"] == 1)): ?><a href="#" dname='<?php echo ($vo["dname"]); ?>' nickname='<?php echo ($vo["nickname"]); ?>'  work-id='<?php echo ($vo["id"]); ?>' class="btn btn-info btn-xs edit show_set_score"><i class="fa fa-edit"></i>打分</a>
                            		<?php else: endif; ?>
                               <!--  <a href="#"  work-id='<?php echo ($vo["id"]); ?>' class="btn btn-info btn-xs edit showEditWork"><i class="fa fa-edit"></i>编辑</a>
      					        <a href="#"  work-id='<?php echo ($vo["id"]); ?>' class="btn btn-danger btn-xs delete delWork"><i class="fa fa-trash-o"></i>删除</a>   -->     	
                            </td>
         
                        </tr><?php endforeach; endif; ?>                        
                    </tbody>
                </table><br/>
                <div class="row DTTTFooter">
					<div class="col-sm-6">
						<div class="dataTables_info" id="simpledatatable_info" role="alert" aria-live="polite" aria-relevant="all"></div>
					</div>
					<div class="col-sm-8 pull-right">
						<div class="dataTables_paginate paging_bootstrap" id="simpledatatable_paginate">
							<ul class="pagination" id="pageUl">
								<?php echo ($page); ?>
							</ul>
						</div>
					</div>				
            	</div>
            </div>   	
        </div>
    </div>
</div>


    <!--  给日志打分  -->
    <div id="set_score_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">

               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                   <h4 class="modal-title" id="mySmallModalLabel">工作日志打分</h4>
               </div>
               <div class="modal-body"> 
                  <!--未开户成功用户接单记录表开始  -->
              	   <div class="widget">
			       <div class="widget-header ">
			           <span class="widget-caption" id='title'></span>
		               <div class="widget-buttons">
		                    <a href="#" data-toggle="maximize">
		                        <i class="fa fa-expand"></i>
		                    </a>
		                    <a href="#" data-toggle="collapse">
		                        <i class="fa fa-minus"></i>
		                    </a>
		                    <a href="#" data-toggle="dispose">
		                        <i class="fa fa-times"></i>
		                    </a>
		                </div>
			       </div>
		           <div class="widget-body">
						<div id='dimension_table'>
						</div>
	
               		</div>
		           <div class="widget-body">
						<div class='row'>
							<div class='col-sm-2' style="line-height: 82px;height: 82px;">
								评语
							</div>
							<div class='col-sm-8'>
								<textarea id='pingyu' rows="4" cols="80"></textarea>
							</div>
						</div>
	
               		</div>
               	</div>

               	<!--未开户成功用户接单记录表结束  -->
                  
               	<div class="row" id="reply_record_div">
					<div class="col-sm-2 col-sm-offset-5">
						
						<a href="#"   id='save_set_score' class="btn btn-info edit ">保存</a>
						<span></span>
					</div>
				</div>
               </div>
			<div class="modal-footer">

			</div>			                
           </div>
       </div>
   </div>
  	<!--  给日志打分  -->
 

  <!--编辑工作日志  -->
    <div id="editWorkModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">

               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                   <h4 class="modal-title" id="mySmallModalLabel">工作日志修改</h4>
               </div>
               <div class="modal-body"> 
             
              	   <div class="widget">
			       <div class="widget-header ">
			           <span class="widget-caption" id='title'></span>
		               <div class="widget-buttons">
		                    <a href="#" data-toggle="maximize">
		                        <i class="fa fa-expand"></i>
		                    </a>
		                    <a href="#" data-toggle="collapse">
		                        <i class="fa fa-minus"></i>
		                    </a>
		                    <a href="#" data-toggle="dispose">
		                        <i class="fa fa-times"></i>
		                    </a>
		                </div>
			       </div>
		           <div class="widget-body">
	        				<div class='row' style="margin-top: 20px;">
	        					<div class='col-sm-3'>提交时间</div>
	        					<div class="search-box col-sm-4" >
									  <span id='work_ctime'></span>
			                	</div>	
	        				</div>
	        				<div class='row' style="margin-top: 20px;">
	        					<div class='col-sm-3'>日期</div>
	        					<div class="search-box col-sm-4" >
									  <span id='editWorkModal_date'></span>
			                	</div>	
	        				</div>
	        				<div class='row' style="margin-top: 20px;">
	        					<div class='col-sm-3'>日志类别</div>
	        					<div class="search-box col-sm-4" >
									  <span id='work_worktype'></span>
			                	</div>	
	        				</div>
	      <!--   				<div class='row' style="margin-top: 20px;">
	        					<div class='col-sm-3'>摘要</div>
	        					<div class="search-box col-sm-4" >
									  <textarea rows="8" cols="40" id='work_synopsis'></textarea>
			                	</div>	
	        				</div> -->
	        			
	 
	        				<div class='row' style="margin-top: 20px;">
	        					<div class='col-sm-2 col-sm-offset-4'>
		        					<!-- <button id="editwork_btn" data-bb-handler="confirm" type="button" class="btn btn-primary">保存</button> -->
		        				</div>
		        				<div class='col-sm-4'>
		        					<!-- <button id='show_addworkdetailmodal' type="button" class="btn btn-primary ">新增工作内容</button> -->
		        				</div>
	        				</div>
               		</div>
               	</div>
      
	        		<table class="table table-striped table-hover table-bordered" id="editabledatatable">
	                    <thead>
	                        <tr role="row">
	     
	                            <th>序号 </th>
	                            <th>工作内容 </th>
	                            <th>工作时长</th>
	                        <!--     <th>操作</th> -->

	
	                        </tr>
	                    </thead>
	
	                    <tbody id="workdetaillistTable">
	                           
	                    </tbody>
                	</table>
               	<div class="row" id="reply_record_div">
					<div class="col-sm-2">
						
						<span></span>
					</div>
				</div>
               </div>
			<div class="modal-footer">

			</div>			                
           </div>
       </div>
   </div>
    <!--编辑工作日志  -->



        		</div>
				<!-- /Page Body -->
			</div>
            <!-- /Page Content -->
        </div>
        <!-- /Page Container -->
        <!-- Main Container -->

    </div>
 
     <script type="text/javascript">
	    $(function(){
	    	$(".read_message").click(function(){
	    		
	    		var url = $(this).attr('data-url');
	    		var id = $(this).attr('data-id');
	    		var random = Math.random();
	    		var data = {'url':url,'id':id,'random':random};
	    		$.ajax({
					url:"/Y2Game/index.php/Home/Task/read_task_message",
					type:"POST",
					data:data,
					dataType:'json',
					success:function(data){
						
						var random = Math.random();
						location.href = "/Y2Game/index.php"+data.url + '&random=' + random;
						
					}
				});   
	    		
	    	});    	
	    	
	    });

    </script>   
    
    
<!--Basic Scripts-->
<script src="/Y2Game/Public/js/jquery-2.0.3.min.js"></script>
<script src="/Y2Game/Public/js/bootstrap.min.js"></script>
<script src="/Y2Game/Public/js/datetime/bootstrap-datepicker.js"></script>
<script src="/Y2Game/Public/js/datetime/bootstrap-timepicker.js"></script>
<script src="/Y2Game/Public/js/datetime/bootstrap-datetimepicker.js"></script>

<!--Beyond Scripts-->
<script src="/Y2Game/Public/js/beyond.min.js"></script>
<script src="/Y2Game/Public/js/datetime/moment.js"></script>
<script src="/Y2Game/Public/js/datetime/daterangepicker.js"></script>
<script src="/Y2Game/Public/js/select2/select2.js"></script>
<script type="text/javascript">
 
$(function(){
	//dimension
	
	var data = {'type':'getDimensionList'};
	//加载权重信息，在打分modal中添加每个权重的信息
	$.ajax({
		url:"/Y2Game/index.php/WorkManage/Work/getDimensionList",
		type:"GET",
		data:data,
		dataType:'json',
		success:function(data){
			data = data.data;
			var html = '';
			$.each(data,function(k,v){
				    var num = k + 1;
					html += "<div class='row'>";
					html += "<div class='col-sm-2'>";
					html += "<span>"+num+"、    </span>";
					html += "<span>"+v.name+"</span>";
					html += "</div>";
					html += "<div class='search-box col-sm-6'>";
			
		   	      
					html += '<div class="form-group">';
					html += '<div class="controls">';
				
					html += ' <input type="text"   class="form-control get_score" data-id='+v.id+' id="set_score_'+v.id+'" placeholder="请输入合适的分数(百分制)" />';
			
					html += ' </div>';
					html += '</div> ';
           
					html += "</div>";
					html += "</div>";
			});
			
			

			$("#dimension_table").html(html);
		}
	});
}); 

//保存分数
$('#save_set_score').click(function(){
	var work_id = $(this).attr('work-id');
	var noparamer = false;
	var dimension_data = [];
	$.each($('.get_score'),function(k,v){
	
		var dimension_id = "" + $(v).attr('data-id') + "";
		var demension_value = $(v).val();
		if((!dimension_id)||(!demension_value)){
			noparamer = true;
			
		}
		dimension_data[k] = dimension_id + '__' +demension_value;
	});

	if(noparamer){
		alert('有没有打分的选项');
		return false;
	}
	
	var pingyu = $('#pingyu').html(); 
	
	var data = {'work_id':work_id,'dimension_data':dimension_data,'pingyu':pingyu,'type':'set_score'};
	console.log(data);
	$.ajax({
		url:"/Y2Game/index.php/WorkManage/Work/set_score",
		type:"GET",
		data:data,
		dataType:'json',
		success:function(data){
			alert(data.message);
			if('0' == data.status){
				$('#set_score_modal').modal('hide');
			}
		}
	});
	
	
});


$(function(){

	$(".form_datetime").datetimepicker({
	//	format:'yyyy-mm-dd-hh-ii-ss'
	});

	//$("#endTime").datetimepicker();	
	$("#searchTime").daterangepicker({
		format:"YYYY-MM-DD",
		separator : '__',
		locale:{
			applyLabel:"确定",
			cancelLabel:"取消",
			fromLabel:"从",
			toLabel:"到"
		}
	});
	
	$("#workType,#workType2").select2();
});

//搜索功能
$("#search").click(function(){

	var synopsis = $("#synopsis").val();
	var searchTime = $("#searchTime").val();
	var workType = $("#workType").val();
	
	var data = {"synopsis":synopsis
			,"searchTime":searchTime
			,"workType":workType
			,"type":'workList'
			,"show":'member'
		};
	
	$.ajax({
		url:"/Y2Game/index.php/WorkManage/Work/worklist",
		type:"GET",
		data:data,
		dataType:'json',
		success:function(data){
			var html = "";
			var show = data.show;
			$("#pageUl").html(show);
			$.each(data.list,function(k,v){
			
				var num = k+1;

				html += "<tr work-id='"+v.id+"' class='showEditWork'>";
				html += "<td>"+num+"</td>";
				html += "<td>"+v.ctime+"</td>";
				html += "<td>"+v.date+"</td>";
				html += "<td>"+v.type_name+"</td>";
			/* 	html += "<td>"+v.synopsis+"</td>"; */
				html += "<td>"+v.score+"</td>";
				html += "<td>";     
				if(('0' == v.is_have_score) && ('1' == v.worktype)){
					html += "<a href='#'  work-id='"+v.id+"' class='btn btn-info btn-xs edit show_set_score'><i class='fa fa-edit'></i>打分</a>";
				}else{
					//html += "已打分";
				}
				//html += "<a href='#'  work-id='"+v.id+"' class='btn btn-info btn-xs edit showEditWork'><i class='fa fa-edit'></i>编辑</a>";
				//html += "<a href='#'  work-id='"+v.id+"' class='btn btn-danger btn-xs delete delWork'><i class='fa fa-trash-o'></i>删除</a> ";
				html += "</td>";
				html += "</tr>";
						
			});
			
			$("#worklistTable").html(html);
		}
		
	});	
	
});



//显示打分窗口
$('body').on('click','.show_set_score',function(){

	var work_id = $(this).attr('work-id');
	var dname = $(this).attr('dname');
	var nickname = $(this).attr('nickname');
	if(!work_id){
		alert('参数缺失');
		return false;
	}
	$('#set_score_modal #title').html(dname +"  "+nickname);
	$('#save_set_score').attr('work-id',work_id);
	$('#set_score_modal').modal(true);

});




$('#add_reply_record_btn').click(function(){
	$('#editWorkDetailModal').modal(true);
});



//新增工作日志
$('#savework').click(function(){
	
	var workType2 = $('#workType2').val();
	var work_synopsis2 = $('#work_synopsis2').val();
	
	if(!workType2 || !work_synopsis2){
		alert('参数缺失');
		return false;
	}
	
	var data = {'workType':workType2,'synopsis':work_synopsis2,'type':'addwork'};
	$.ajax({
		url:"/Y2Game/index.php/WorkManage/Work/addwork",
		type:"GET",
		data:data,
		dataType:'json',
		success:function(data){
			alert(data.message);
			if('0' == data.status){
				var work_id = data.data;
				$('#savework_edit').attr('work_id',work_id);
				$('#add_workdetail').attr('work_id',work_id);
				$('#show_addworkmodal').attr('work_id',work_id);
				$('#savework').hide();
				$('#savework_edit').show();
			}
		},
		error:function(){
			alert('服务器忙,请稍后再试！');
		}
		
	}); 
	
});
//编辑工作日志
$('#savework_edit').click(function(){
	var workType2 = $('#workType2').val();
	var work_synopsis2 = $('#work_synopsis2').val();
	var work_id = $('#savework_edit').attr('work_id');
	if(!workType2 || !work_synopsis2 || !work_id){
		alert('参数缺失');
		return false;
	}
	var data = {'workType':workType2,'synopsis':work_synopsis2,'work_id':work_id,'type':'savework'};
	$.ajax({
		url:"/Y2Game/index.php/WorkManage/Work/savework",
		type:"GET",
		data:data,
		dataType:'json',
		success:function(data){
			alert(data.message);
		},
		error:function(){
			alert('服务器忙,请稍后再试！');
		}
		
	}); 	
	
});


//显示modal  工作日志详情
$('#show_addworkmodal').click(function(){
	var work_id = $('#savework_edit').attr('work_id');
	if(!work_id){
		alert('请确保您已经保存了工作日志');
		return false;
	}
	$('#addWorkDetailModal').modal(true);

});
//新增工作内容详情
$('#add_workdetail').click(function(){
	var workdetail_content = $('#workdetail_content').val();
	var workdetail_userDtm = $('#workdetail_userDtm').val();
	var work_id = $('#add_workdetail').attr('work-id');
	var data_type = $('#add_workdetail').attr('data-type');
	
	if(!workdetail_content || !workdetail_userDtm ){
		alert('参数缺失');
		return false;
	}
	window.num = 1;
	var data = {'workdetail_content':workdetail_content,'workdetail_userDtm':workdetail_userDtm,'work_id':work_id,'type':'add_workdetail'};
	$.ajax({
		url:"/Y2Game/index.php/WorkManage/Work/add_workdetail",
		type:"GET",
		data:data,
		dataType:'json',
		success:function(data){
			console.log(data);
			alert(data.message);
			if(data.status == '0'){

				var html = "";
				html += " <tr id ='work_detail_tr_"+data.data+"'> ";
				html += " <td>"+window.num+"</td> ";
				html += " <td>"+workdetail_content+"</td> ";
				html += " <td>"+workdetail_userDtm+"</td> ";
				html += " <td>";
				html += "<a href='#' num='"+window.num+"'  work-detail-id='"+data.data+"' workdetail_content='"+workdetail_content+"' workdetail_userDtm='"+workdetail_userDtm+"' class='btn btn-info btn-xs edit showEditWorkdetail'><i class='fa fa-edit'></i>编辑</a> ";
				html += "<a href='#'  work-detail-id='"+data.data+"' class='btn btn-danger btn-xs delete delWorkdetail'><i class='fa fa-trash-o'></i>删除</a> ";
				html += " </td>";
				html += " </tr> ";
				window.num ++;
				if('edit'== data_type){
					$('#editWorkModal #workdetaillistTable').append(html);
				}else{
					$('#workdetaillistTable').append(html);
				}
				
				$('#addWorkDetailModal').modal('hide');
			}
		},
		error:function(){
			alert('服务器忙,请稍后再试！');
		}
		
	}); 
	
	
	
});

//双击行打开日报详情
$('body').on("dblclick",".showEditWork",function(){
	var work_id = $(this).attr('work-id');
	var dname = $(this).attr('dname');
	var nickname = $(this).attr('nickname');
	if(!work_id){
		alert('work_id丢失');
		return false;
	}
	$('#editWorkModal #title').html(dname+"   "+nickname);
	var work_id =  $(this).attr('work-id');
	$('#show_addworkdetailmodal').attr('work_id',work_id);
	var data = {'work_id':work_id,'type':'workDetail'};
	$.ajax({
		url:"/Y2Game/index.php/WorkManage/Work/workDetail",
		type:"GET",
		data:data,
		dataType:'json',
		success:function(data){
			if('0' != data.status){
				alert(data.message);
			}
			
			console.log(data);
			
			data = data.data;
			
			
			$('#work_ctime').html(data.ctime);
			$('#work_worktype').html(data.worktype_name);
			$('#work_synopsis').html(data.synopsis);
			$('#editWorkModal #editwork_btn').attr('work_id',work_id);
			$('#editWorkModal').modal('show');
			$('#editWorkModal_date').html(data.date);

			
			var workDetailList = data.workDetailList;
			var html = "";
			if(workDetailList){
				$.each(workDetailList,function(k,v){
					var num = k + 1;
					html += " <tr id ='work_detail_tr_"+v.id+"'> ";
					html += " <td>"+num+"</td> ";
					html += " <td>"+v.content+"</td> ";
					html += " <td>"+v.userdtm+"</td> ";
		/* 			html += " <td>";
					html += "<a href='#' num='"+num+"'  work-detail-id='"+v.id+"' workdetail_content='"+v.content+"' workdetail_userDtm='"+v.userdtm+"' class='btn btn-info btn-xs edit showEditWorkdetail'><i class='fa fa-edit'></i>编辑</a> ";
					html += "<a href='#'  work-detail-id='"+v.id+"' class='btn btn-danger btn-xs delete delWorkdetail'><i class='fa fa-trash-o'></i>删除</a> ";
					html += " </td>"; */
					html += " </tr> ";
					
				});
			}
			
			
			$('#editWorkModal #workdetaillistTable').html(html);
		},
		error:function(){
			alert('服务器忙,请稍后再试！');
		}
		
	}); 
	
});



//添加工作日志的显示编辑的功能
$('body').on('click','.showEditWorkdetail',function(){
	var work_detail_id = $(this).attr('work-detail-id');
	var num = $(this).attr('num');
	var workdetail_userDtm = $(this).attr('workdetail_userDtm');
	var workdetail_content = $(this).attr('workdetail_content');
	var a = $(this).parent().parent();
	
	if(!work_detail_id){
		alert('参数缺失');
		return false;
	}
	var data = {'work_detail_id':work_detail_id,'type':'get_workdetail'};
	$.ajax({
		url:"/Y2Game/index.php/WorkManage/Work/get_workdetail",
		type:"GET",
		data:data,
		dataType:'json',
		success:function(data){
			console.log(data);
			alert(data.message);
			
			if('0' == data.status){
				var data = data.data;
				$('#addWorkDetailDetailModal #workdetail_userDtm').val(data.userdtm);
				$('#addWorkDetailDetailModal #workdetail_content').val(data.content);
				$('#addWorkDetailDetailModal #save_workdetail').attr('work_detail_id',data.id);
				$('#addWorkDetailDetailModal #save_workdetail').attr('num',num);
	
				
			}
	
		},
		error:function(){
			alert('服务器忙,请稍后再试！');
		}
		
	}); 
	

	$('#addWorkDetailDetailModal').modal(true);
	
});
//添加工作日志中保存编辑的功能
$('#addWorkDetailDetailModal').on('click','#save_workdetail',function(){
	var work_detail_id = $(this).attr('work_detail_id');
	var num = $(this).attr('num');
	var workdetail_userDtm = $('#addWorkDetailDetailModal #workdetail_userDtm').val();
	var workdetail_content = $('#addWorkDetailDetailModal #workdetail_content').val();

	if(!work_detail_id||!workdetail_userDtm||!workdetail_content){
		alert('参数缺失');
		return false;
	}
	var data = {'work_detail_id':work_detail_id,'workdetail_userDtm':workdetail_userDtm,'workdetail_content':workdetail_content,'type':'save_workdetail'};
	$.ajax({
		url:"/Y2Game/index.php/WorkManage/Work/save_workdetail",
		type:"GET",
		data:data,
		dataType:'json',
		
		success:function(data){
			alert(data.message);
			var html = "";
			html += " <td>"+num+"</td> ";
			html += " <td>"+workdetail_content+"</td> ";
			html += " <td>"+workdetail_userDtm+"</td> ";
			html += " <td>";
			html += "<a href='#'  num='"+num+"' work-detail-id='"+work_detail_id+"' workdetail_content='"+workdetail_content+"' workdetail_userDtm='"+workdetail_userDtm+"' class='btn btn-info btn-xs edit showEditWorkdetail'><i class='fa fa-edit'></i>编辑</a> ";
			html += "<a href='#'  work-detail-id='"+data.data+"' class='btn btn-danger btn-xs delete delWorkdetail'><i class='fa fa-trash-o'></i>删除</a> ";
			html += " </td>";
			var dom = $('#work_detail_tr_'+work_detail_id);			
			dom.html(html);
		},
		error:function(){
			alert('服务器忙,请稍后再试！');
		}
		
	}); 
});

//删除工作内容
$('body').on('click','.delWorkdetail',function(){
	var work_detail_id = $(this).attr('work-detail-id');
	var a = $(this).parent().parent();

	
	if(!work_detail_id){
		alert('参数缺失');
		return false;
	}
	var data = {'work_detail_id':work_detail_id,'type':'delWorkdetail'};
	$.ajax({
		url:"/Y2Game/index.php/WorkManage/Work/delWorkdetail",
		type:"GET",
		data:data,
		dataType:'json',
		success:function(data){
			alert(data.message);
			a.remove();
		},
		error:function(){
			alert('服务器忙,请稍后再试！');
		}
		
	}); 	
	
	
})
//保存修改工作日志
$('#editwork_btn').click(function(){
	var synopsis = $('#editWorkModal #work_synopsis').val();
	var work_id = $(this).attr('work_id');

	if(!work_id || !synopsis){
		return false;
	}
	var data = {'work_id':work_id,'synopsis':synopsis,'type':'savework'};
	$.ajax({
		url:"/Y2Game/index.php/WorkManage/Work/savework",
		type:"GET",
		data:data,
		dataType:'json',
		success:function(data){
			alert(data.message);
		
		},
		error:function(){
			alert('服务器忙,请稍后再试！');
		}
		
	}); 	
	
});

$('#show_addworkdetailmodal').click(function(){
	$('#addWorkDetailModal').modal(true);
	var work_id =  $(this).attr('work_id');
	$('#add_workdetail').attr('work-id',work_id);
	$('#add_workdetail').attr('data-type','edit');

});

$('#addWorkModal,#editWorkModal').on('hide.bs.modal', function () {
    location.reload();
});
</script>



      <style type="text/css">
   		th,td{
   			text-align: center;
   		}
   </style>
</body>
<!--Body Ends-->
</html>