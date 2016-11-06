<?php
return array(
	//'配置项'=>'配置值'
	//'URL_MODEL' => 2,//rewrite 模式
	//'LAYOUT_ON' => true,
    //'LAYOUT_NAME' => 'layout',

    /********mysql 设置 ******/
    'DB_TYPE' => 'mysql',
    'DB_USER' => 'root',
    'DB_PWD' => '123456',//'thsdx',
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'lslyglxt',
    'DB_PORT' => '3306',
    'DB_PREFIX' => 'oyyq_',
    'DB_CHARSET' => 'utf8',
    //'DB_DSN' => 'pgsql:host=10.0.2.17;dbname=thsdx_crm;port=61522',
    /*******mysql 设置*********/


        
    'APP_AUTOLOAD_PATH' => '@.TagLib',
    'SESSION_AUTO_START' => true,
    'TMPL_ACTION_ERROR' => 'Public:error', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS' => 'Public:success', // 默认成功跳转对应的模板文件
    'USER_AUTH_ON' => true,
    'USER_AUTH_TYPE' => 2, // 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY' => 'authId', // 用户认证SESSION标记
    'ADMIN_AUTH_KEY' => 'super_admin',
    'USER_AUTH_MODEL' => 'User', // 默认验证数据表模型
    'AUTH_PWD_ENCODER' => 'md5', // 用户认证密码加密方式
    'USER_AUTH_GATEWAY' => '/Home/Login/index', // 默认认证网关
    'NOT_AUTH_MODULE' => 'Login', // 默认无需认证模块
    'GUEST_AUTH_ON' => false,// 是否开启游客授权访问
    'RBAC_ROLE_TABLE' => 'oyyq_role',
    'RBAC_USER_TABLE' => 'oyyq_role_user',
    'RBAC_ACCESS_TABLE' => 'oyyq_access',
    'RBAC_NODE_TABLE' => 'oyyq_node', 
    'LOAD_EXT_CONFIG' => array(
        'MENU' => 'menu',
        'ACCESS' => 'access',
        
    ), // 扩展菜单配置
    


);