<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>后台管理</title>
	<link rel="stylesheet" type="text/css" href="/Public/Admin/jquery_easyui/themes//default/easyui.css">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/jquery_easyui/themes//icon.css">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/jquery_easyui/themes//demo.css">
	
	<script type="text/javascript" src="/Public/Admin/jquery_easyui//jquery.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/jquery_easyui//jquery.easyui.min.js"></script>

	<link rel="stylesheet" href="/Public/Admin/ckeditor//samples/css/samples.css">
	<link rel="stylesheet" href="/Public/Admin/ckeditor//samples/toolbarconfigurator/lib/codemirror/neo.css">
</head>
<body class="easyui-layout">
		<div data-options="region:'north'" class="header">
			<h1>后台管理系统</h1>
			<span>【<?php echo ($name); ?>】, 欢迎您, 登陆时间 : <?php echo ($lastLoginTime); ?>   <a href="#" id="logout">退出</a></span>
		
		</div>
		<div data-options="region:'south',split:true" style="height:50px;"></div>
		<div data-options="region:'west',split:true,iconCls:'icon-redo'" title="导航菜单" style="width:180px;">
			<ul id="system"></ul>
		</div>
		<div data-options="region:'center',iconCls:'icon-ok'">
			<div id="tabs">
				<div title="起始页"></div>
			</div>

		</div>
		
	<script type="text/javascript">
		var thinkphp = {
			'url':'/admin.php/',
			'uploads':'/Uploads',
			'public':'/Public',
		}
	</script>
	<script type="text/javascript" src="/Public/Admin/jquery_easyui//index.js"></script>
	<script type="text/javascript" src="/Public/Admin/ckeditor//ckeditor.js"></script>

	

</body>

</html>