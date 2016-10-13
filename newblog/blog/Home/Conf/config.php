
<?php
return array(
	//'配置项'=>'配置值'
	'TMPL_PARSE_STRING'  =>array(     
			'__JS__'     =>  __ROOT__.'/Public/Home/js', 
			'__CSS__'     =>  __ROOT__.'/Public/Home/css', 
			'__IMAGES__'     =>  __ROOT__.'/Public/Home/images', 
			'__UPLOAD__' =>  __ROOT__.'/Uploads',
		),
		'SHOW_PAGE_TRACE'	=>false,   //开启页面缓存
		'TMPL_CACHE_ON'		=>true,	   //开启模板缓存
		'DB_FIELDS_CACHE' 	=>  true,  //开启字段缓存
		'URL_MODEL'         => '1',
		'URL_ROUTER_ON'     => true,   //开启路由
		'URL_ROUTE_RULES'=>array(    
			'article/:a_id\d'  => 'index.php/Article/index',
			'article/s/:keyword' => 'index.php/Article/search',
			'index.html' => 'index.php/Index/index',
			'front.html' => 'index.php/Index/index',
			'back.html' => 'index.php/Back/index',
			'safe.html' => 'index.php/Safe/index',
			'category.html' => 'index.php/Category/index',
			'life.html' => 'index.php/Life/index',
			'tags.html' => 'index.php/Tags/index',
			'readers.html' => 'index.php/Readers/index',
			'links.html' => 'index.php/Links/index',
			'user/set.html' => 'index.php/User/set',
			'user/notice.html' => 'index.php/User/notice',
			//'article/:a_id\d'  => 'Article/test', //可执行
		),
);