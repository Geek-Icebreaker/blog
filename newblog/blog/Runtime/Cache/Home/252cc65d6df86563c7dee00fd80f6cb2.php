<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="baidu-site-verification" content="PoHVQiNCP9" />
	<title>破冰者博客</title>
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/nprogress.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/ladda-themeless.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/prism.css">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/jquery.Jcrop.css">

		
	<link rel="apple-touch-icon-precomposed" href="/Public/Home/images/icon/icon.png">
	<link rel="shortcut icon" href="/Public/Home/images/icon/favicon.ico">
	<script src="/Public/Home/js/jquery-2.1.4.min.js"></script>
	<script src="/Public/Home/js/nprogress.js"></script>
	<script src="/Public/Home/js/jquery.lazyload.min.js"></script>
	<script src="/Public/Home/js/spin.js"></script>
	<script src="/Public/Home/js/ladda.min.js"></script>
		<!--[if gte IE 9]>
	  <script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
	  <script src="js/html5shiv.min.js" type="text/javascript"></script>
	  <script src="js/respond.min.js" type="text/javascript"></script>
	  <script src="js/selectivizr-min.js" type="text/javascript"></script>
	<![endif]-->
		<!--[if lt IE 9]>
	  <script>window.location.href='upgrade-browser.html';</script>
	<![endif]-->
</head>

<body class="user-select">
	<!-- 模态框（Modal） -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">
						请选择合适的区域作为头像
					</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" id="x" name="x" />
					<input type="hidden" id="y" name="y" />
					<input type="hidden" id="w" name="w" />
					<input type="hidden" id="h" name="h" />
					<img id="element_id" src="" width="120px" height="120px">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default cancel" data-dismiss="modal">取消</button>
					<button type="button" class="btn btn-primary upload">上传头像</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal -->
	</div>
	<header class="header">
  <nav class="navbar navbar-default" id="navbar">
    <div class="container">
      <div class="header-topbar hidden-xs link-border">
        <ul class="site-nav topmenu">
          <li><a href="http://www.ice-breaker.cn/tags.html">标签云</a></li>
          <li><a href="http://www.ice-breaker.cn/readers.html" rel="nofollow">读者墙</a></li>
          <li><a href="http://www.ice-breaker.cn/links.html" rel="nofollow">友情链接</a></li>
<!--
          <li><a href="<?php echo U('Tags/index','','');?>">标签云</a></li>
          <li><a href="<?php echo U('Readers/index','','');?>" rel="nofollow">读者墙</a></li>
          <li><a href="<?php echo U('Links/index','','');?>" rel="nofollow">友情链接</a></li>
-->          
          <li class="dropdown">
          	<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" rel="nofollow">关注本站 <span class="caret"></span></a>
            <ul class="dropdown-menu header-topbar-dropdown-menu">
              <li><a data-toggle="modal" data-target="#WeChat" rel="nofollow"><i class="fa fa-weixin"></i> 微信</a></li>
              <li><a href="#" rel="nofollow"><i class="fa fa-weibo"></i> 微博</a></li>
              <li><a data-toggle="modal" data-target="#areDeveloping" rel="nofollow"><i class="fa fa-rss"></i> RSS</a></li>
            </ul>
          </li>
        </ul>
			
			<?php if($name == '' ): ?><a href="javascript:void(0);"  "rel="nofollow" id="headLogin">请登录</a>&nbsp;&nbsp;
					<a href="javascript:void(0);"  "rel="nofollow" id="headReg">注册</a>&nbsp;&nbsp;
					<a href="" rel="nofollow"></a></div>
		    	<?php else: ?>
					<a href="javascript:void(0);"  "rel="nofollow">Hi,<?php echo ($name); ?></a>&nbsp;&nbsp;
					<a href="http://www.ice-breaker.cn/user/set.html"  "rel="nofollow">个人中心</a>&nbsp;&nbsp;
					<a href="<?php echo U('Base/logout','','');?>" rel="nofollow">退出</a></div><?php endif; ?>
      

      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar" aria-expanded="false"> <span class="sr-only"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <h1 class="logo hvr-bounce-in"><a href="index.html" title=""><img src="/Public/Home/images/logo.png" alt=""></a></h1>
      </div>
      <div class="collapse navbar-collapse" id="header-navbar">
        <ul class="nav navbar-nav navbar-right">
          <li class="hidden-index active"><a data-cont="破冰者首页" href="http://www.ice-breaker.cn/index.html">破冰者首页</a></li>
          <li><a href="http://www.ice-breaker.cn/front.html">前端技术</a></li>
          <li><a href="http://www.ice-breaker.cn/back.html">后端程序</a></li>
          <li><a href="http://www.ice-breaker.cn/safe.html">网络安全</a></li>
          <li><a href="http://www.ice-breaker.cn/category.html">系统运维</a></li>
          <li><a href="http://www.ice-breaker.cn/life.html">程序人生</a></li>
		<!--
		  <li class="hidden-index active"><a data-cont="破冰者首页" href="<?php echo U('Index/index','','');?>">破冰者首页</a></li>
          <li><a href="<?php echo U('Front/index','','');?>">前端技术</a></li>
          <li><a href="<?php echo U('Back/index','','');?>">后端程序</a></li>
          <li><a href="<?php echo U('Safe/index','','');?>">网络安全</a></li>
          <li><a href="<?php echo U('Category/index','','');?>">授人以渔</a></li>
          <li><a href="<?php echo U('Life/index','','');?>">程序人生</a></li>
		-->
        </ul>
        <form class="navbar-form visible-xs" action="/Search" method="post">
          <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="请输入关键字" maxlength="20" autocomplete="off">
            <span class="input-group-btn">
            <button class="btn btn-default btn-search" name="search" type="submit">搜索</button>
            </span> </div>
        </form>
      </div>
    </div>
  </nav>
</header>
	<section class="container container-page">
		<div class="pageside">
			<div class="pagemenus">
				<ul class="pagemenu">
					<li><a href="http://www.ice-breaker.cn/user/set.html">个人设置</a></li>
					<li><a href="http://www.ice-breaker.cn/user/password.html">密码修改</a></li>
					<li><a href="http://www.ice-breaker.cn/user/notice.html">通知</a></li>
				</ul>
			</div>
		</div>
		<div class="alert user-alert" style="display:none">
			<button type="button" class="close">&times;</button>
			<span>个人资料修改成功</span>
		</div>
		<div class="content">
			<header class="user-header">
		      <h1 class="article-title">个人设置</h1>
		    </header>
			<div class="row">
				<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><div class="col-md-8">
						<form action="###" class="form-horizontal" role="form" id="user-form">
								<div class="form-group">
									<label for="name" class="col-sm-3 control-label">用户昵称</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="name" value="<?php echo ($user['m_name']); ?>" placeholder="支持中文、字母、数字、'_'的组合 , 4-20个字符">
										<span style="color:red;display:none">请输入中文、字母、数字、\'\_\'的组合 , 4-20个字符</span>
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-3 control-label">qq</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="qq" value="<?php echo ($user['qq']); ?>" placeholder="qq">
										<span style="color:red;display:none">请输入合法的qq</span>
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-3 control-label">邮箱</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="email" value="<?php echo ($user['email']); ?>" placeholder="邮箱">
										<span style="color:red;display:none">请输入合法的邮箱</span>
									</div>
								</div>							
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-9">
										<button type="button" class="btn btn-success info-btn">确认修改</button>
									</div>
								</div>
							
						</form>
					</div>
					<div class="col-md-4">
						<div class="col-sm-6">
							<?php if($user['facesrc'] == '' ): ?><img class="" height="128" width="128" src="/Public/Home/images/icon/icon.png" id="img" alt="Responsive image">
								<?php else: ?> 
									<img class="" height="128" width="128" src="<?php echo ($user['facesrc']); ?>" id="img" alt="Responsive image"><?php endif; ?>
							
						</div>
						<div class="col-sm-6 info">
							<input type="file" name="file" id="file" onchane="show();" value=""style="display:none"/>
							<button type="button" class="btn btn-default upload-btn">上传头像</button>
							<p>从电脑中选择图片上传, 图像大小不要超过 2 MB，长宽不要超过 3000 px</p>
						</div>
						<span class="status" style="display:none;">上传中...</span>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</section>
	<!--登录注册开始-->
		<!--登录模态框-->
<div class="modal fade user-select" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" id="login-form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="loginModalLabel">登录</h4>
                </div>
                <div class="modal-body">
                    <div class="alert login-alert alert-dismissable" style="display: none;">
                        <button type="button" class="close login-close" aria-hidden="true">
                            &times;
                        </button>
                        用户名或密码错误,请重新输入
                    </div>
                    <div class="form-group">
                        <div class="input-group">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-user"></i>
							</span>
                            <input type="text" class="form-control" id="loginModalUserName" placeholder="请输入用户名" autofocus maxlength="15" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
								  <span class="input-group-addon">
								  	<i class="glyphicon glyphicon-lock"></i>
								  </span>
                            <input type="password" class="form-control" id="loginModalUserPwd" placeholder="请输入密码" maxlength="18" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <!--<button type="button" class="btn btn-primary" id="login">登录</button>-->
                    <button class="btn btn-primary ladda-button login" data-style="zomm-out"><span class="ladda-label">登录</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--注册模态框-->
<div class="modal fade user-select" id="regModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" id="reg-form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="loginModalLabel">注册</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-dismissable reg-alert" style="display: none;">
                        <button type="button" class="close reg-close" 
                                aria-hidden="true">
                            &times;
                        </button>
                        <span>注册成功 到登录页面进行登录</span>
                    </div>
                    <div class="form-group">
                        <label for="loginModalUserNmae">用户名</label>
                        <input style="display:none">
                        <input type="text" class="form-control" id="regModalUserNmae" placeholder="支持中文、字母、数字、'_'的组合 , 4-20个字符" autofocus maxlength="20" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="loginModalUserPwd">密码</label>
                        <input style="display:none">
                        <input type="password" class="form-control" id="regModalUserPwd" placeholder="使用字母、数字、下划线4-20个字符" maxlength="20" autocomplete="off" required>
                    </div>
                    <!--
                    <div class="form-group">
                        <label for="">Email</label>
                        <input style="display:none">
                        <input type="text" class="form-control" id="regEmail" placeholder="请输入邮箱" maxlength="30" autocomplete="off" required>
                    </div>-->
                    <div class="form-group">
                        <label for="">QQ</label>
                        <input style="display:none">
                        <input type="text" class="form-control" id="regQq" placeholder="请输入qq号" maxlength="18" autocomplete="off" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <!--<button type="button" class="btn btn-primary" id="reg">注册</button>-->
                    <button class="btn btn-primary ladda-button reg" data-style="zomm-out"><span class="ladda-label">注册</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
	<!--登录注册结束-->
	<!--页脚部分开始-->
	<footer class="footer">
  <div class="container">
    <p>&copy; 2016 <a href="">ylsat.com</a> &nbsp; <a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow">苏公网安备 32061202001019号</a> &nbsp; <a href="sitemap.xml" target="_blank" class="sitemap">网站地图</a></p>
  </div>
  <div id="gotop"><a class="gotop"></a></div>
</footer>
	<!--页脚部分结束-->
	
	<!--about部分开始-->
	<!--微信二维码模态框-->
<div class="modal fade user-select" id="WeChat" tabindex="-1" role="dialog" aria-labelledby="WeChatModalLabel">
	<div class="modal-dialog" role="document" style="margin-top:120px;max-width:280px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="WeChatModalLabel" style="cursor:default;">微信扫一扫</h4>
			</div>
			<div class="modal-body" style="text-align:center"> <img src="/Public/Home/images/weixin.jpg" alt="" style="cursor:pointer" /> </div>
		</div>
	</div>
</div>
<!--该功能正在日以继夜的开发中-->
<div class="modal fade user-select" id="areDeveloping" tabindex="-1" role="dialog" aria-labelledby="areDevelopingModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="areDevelopingModalLabel" style="cursor:default;">该功能正在日以继夜的开发中…</h4>
			</div>
			<div class="modal-body"> <img src="/Public/Home/images/baoman/baoman_01.gif" alt="深思熟虑" />
				<p style="padding:15px 15px 15px 100px; position:absolute; top:15px; cursor:default;">很抱歉，程序猿正在日以继夜的开发此功能，本程序将会在以后的版本中持续完善！</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">朕已阅</button>
			</div>
		</div>
	</div>
</div>
	<!--about部分结束-->
	

	<script type="text/javascript">
		var thinkphp = {
			'url':'/index.php/'
		}
	</script>
<script src="/Public/Home/js/bootstrap.min.js"></script> 
<script src="/Public/Home/js/jquery.ias.js"></script> 
<script src="/Public/Home/js/scripts.js"></script>
<!--上传裁剪-->
<!--<script src="/Public/Home/js/jquery-1.5.1.min.js"></script>-->
<!--<script src="/Public/Home/js/jquery.min.js"></script>-->
<script src="/Public/Home/js/jquery.Jcrop.js"></script>
<!--上传裁剪-->

<script src="/Public/Home/js/index.js"></script>
<script src="/Public/Home/js/user.js"></script>



</body>
</html>