<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>后台管理</title>
	<link rel="stylesheet" type="text/css" href="/Public/Admin/jquery_easyui/themes//default/easyui.css">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/jquery_easyui/themes//icon.css">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/jquery_easyui/themes//login.css">
	<script type="text/javascript" src="/Public/Admin/jquery_easyui//jquery.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/jquery_easyui//jquery.easyui.min.js"></script>
</head>
<body class="easyui-layout">
	<div id="login" data-options="iconCls:'icon-lock2',plain:true">
		<p>
			<label>登录用户:</label>
			<input type="hidden" >
			<input type="text" name="loginName" id="loginName" class="easyui-validatebox" autocomplete="off">
		</p>
		<p>
			<label>登录密码:</label>
			<input type="hidden" >
			<input type="password" name="loginPass" id="loginPass" class="easyui-validatebox" autocomplete="off">
		</p>
		<p><a id="btn" href="#" class="easyui-linkbutton loginBtn" >登录</a></p>
	</div>

	<script type="text/javascript" src="/Public/Admin/jquery_easyui//login.js"></script>
</body>
</html>