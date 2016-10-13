<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_MODULE'        =>  'Home',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称
    'URL_ROUTER_ON'   => true, 
	
	//默认模块    
	'URL_MODEL'          => '1', 
	//URL模式   
	'SESSION_AUTO_START' => true, //是否开启session
	'URL_CASE_INSENSITIVE'  =>  false,
	'TMPL_CACHE_ON'=>false,   
	'SHOW_PAGE_TRACE' =>false,
	'DB_CHARSET'=> 'utf8', // 字符集
	'DB_TYPE'   => 'mysql', 
	'DB_HOST' => 'localhost',
	'DB_NAME' => '',
	'DB_USER'   => '', 
	'DB_PWD'    => '', 
	'DB_PREFIX' => 'blog_',
	'MODULE_ALLOW_LIST'    =>    array('Home','Admin'),
	'URL_HTML_SUFFIX'=>'html',
	
	define('ROOT_PATH','http://www.ice-breaker.cn'),
);