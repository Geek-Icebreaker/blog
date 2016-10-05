$(function(){
	$('#login').dialog({
		title:'后台登陆',
		width:400,
		height:200,
		close:true,
		modal:true,
		resizable:false,
	});
	$('.loginBtn').linkbutton({
	    iconCls: 'icon-lock'
	});
	$('#loginName').validatebox({
		 required: true,
		 validType:'length[6,10]',
		 missingMessage:'用户名不能为空',
		 invalidMessage:'用户名或者密码输入错误',
	});
	$('#loginPass').validatebox({
		 required: true,
		 validType:'length[6,20]',
		 missingMessage:'密码不能为空',
		 invalidMessage:'用户名或密码输入错误',
	});
	
	//加载判断
	if(!$('#loginName').validatebox('isValid')){
			$('#loginName').focus();
	}else if(!$('#loginPass').validatebox('isValid')){
			$('#loginPass').focus();
	}
	//点击登录
	$('#btn').bind('click',function(){
		if(!$('#loginName').validatebox('isValid')){
			$('#loginName').focus();
		}else if(!$('#loginPass').validatebox('isValid')){
			$('#loginPass').focus();
		}else{
			$.ajax({
				type:'POST',
				url:'Login/login',
				dataType:'json',
				data:{
					loginName:$('#loginName').val(),
					loginPass:$('#loginPass').val(),
				},
				beforeSend:function(){
					$.messager.progress({
						title:'友情提醒',
						msg:'正在登录中...',
					})
				},
				success:function(resp){
					if(resp.status == 1){
						location.href = resp.url;
					}else if(resp.status == 0){
						$.messager.alert({
							title:'警告',
							msg:'用户名或密码错误',
						});
						$.messager.progress('close');
					}
				}
			})
		}
	})
});
