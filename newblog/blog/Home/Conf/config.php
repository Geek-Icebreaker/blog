<?php
return array(
	//'配置项'=>'配置值'
	'TMPL_PARSE_STRING'  =>array(     
			'__JS__'     =>  __ROOT__.'/Public/Home/js', 
			'__CSS__'     =>  __ROOT__.'/Public/Home/css', 
			'__IMAGES__'     =>  __ROOT__.'/Public/Home/images', 
			'__UPLOAD__' =>  __ROOT__.'/Uploads',
		),
		'SHOW_PAGE_TRACE'=>false,
		'TMPL_CACHE_ON'=>false,   
		'URL_MODEL'          => '1',
		'URL_ROUTER_ON'   => true,
		'URL_ROUTE_RULES'=>array(    
			'article/:a_id\d'  => 'index.php/Article/index',
			'index.html' => 'index.php/Index/index',
			'front.html' => 'index.php/Front/index',
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
