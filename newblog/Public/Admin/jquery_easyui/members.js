$.extend($.fn.validatebox.defaults.rules, {    
    email: {    
        validator: function(value, param){    
        	return /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);    
        },    
        message: '邮箱格式不正确'   
    }    
}); 
$(function(){
	$('#membersList').datagrid({
		url:thinkphp.url + 'Members/getmembers',
		fitColumns:true, //列自动扩充屏幕宽度
		toolbar: '#toolbar',
		striped:true, //设置基偶行背景色
		rownumbers:true, //设置为true 在列表钱显示行号 是jquery easyui自动排列的行号 非数据库ID号\
		selectOnCheck:true,  //当选中复选框才会选中当前行
		checkOnSelect:true,  //当选中当前行才会选中复选框
		border:false,
		pagination:true,
		pageNumber:1,
		pageSize:20,
		sortName:'reg_time', //排序字段
		sortOrder:'DESC',    //排序方式
		columns:[[
			{
				field:'id',
				title:'编码',
				width:50,
				checkbox:true
			},
			{
				field:'m_name',
				title:'昵称',
				width:50
			},
			{
				field:'email',
				title:'电子邮箱',
				width:100
			},
			{
				field:'qq',
				title:'QQ',
				width:100
			},
			{
			field:'reg_time',
				title:'注册时间',
				width:100,
				sortable:true
			},
			{
				field:'login_time',
				title:'最后登录时间',
				width:100,
				sortable:true
			},
			{
				field:'login_ip',
				title:'最后登录IP',
				width:100
			}
		]],
	});
	$('#editMember').dialog({
		width:400,
		height:300,
		title : '修改用户',
		iconCls : 'icon-user-add',
		modal : true,
		closed : true,
		buttons : [
		   {
			   text : '提交',
			   iconCls : 'icon-edit-new',
			   handler : function () {
				   	if ($('#editMember').form('validate')) {
						alert($('input[name="edit_password"]').val());
						$.ajax({
							type:'POST',
							url:thinkphp.url + 'Members/updateMember',
							data:{
								id:$.trim($('input[name="edit_id"]').val()),
								password:$.trim($('input[name="edit_password"]').val()),
								email:$.trim($('input[name="edit_email"]').val()),
								qq:$.trim($('input[name="edit_qq"]').val()),
							},
							beforeSend:function(){
								$.messager.progress({
									title:'友情提醒',
									msg:'正在修改中...',
								})
							},
							success:function(resp){
								console.log(resp);
								if(resp > 0 || resp == 0){
									$.messager.show({
										title:'友情提醒',
										msg:'修改成功',
									});
									$('#membersList').datagrid('reload');
									$.messager.progress('close');
									$('#editMember').dialog('close');
									
								}else{
									if(resp == -1){
										$.messager.progress('close');
										$.messager.alert({
												title:'友情提醒',
												msg:'用户名不能重复',
										});
										$.messager.progress('close');
									}else if(resp == -3){
										$.messager.progress('close');
										$.messager.alert({
												title:'友情提醒',
												msg:'请输入4-20位的密码',
										});
										$('input[name="edit_password"]').select();										
									}else if(resp == -4){
										$.messager.progress('close');
										$.messager.alert({
												title:'友情提醒',
												msg:'邮箱地址不符合要求',
										});
										$('input[name="edit_email"]').select();												
									}else if(resp == -5){
										$.messager.progress('close');
										$.messager.alert({
												title:'友情提醒',
												msg:'qq不符合要求',
										});
										$('input[name="edit_qq"]').select();											
									}
								}
							}
						})
					}
				   	console.log($('input[name="edit_username"]').val());
			   }
		   },
		   {
			   text : '取消',
			   iconCls : 'icon-redo',
			   handler : function () {
				   $('#editMember').dialog('close');
			   }
		   }
		],
		onClose : function () {
			$('#editMember').form('reset');
		},
	});
	tools = {
		delete:function(){
			var rows = $('#membersList').datagrid('getSelections');
			var ids = Array();
			if(rows.length == 0){
				$.messager.alert({
					'title':'友情提醒',
					'msg':'您没有选定要删除的数据'
				})
			}else{
				for(var i = 0;i < rows.length;i++){
					ids.push(rows[i].id);
				}
				$.messager.confirm('友情提醒','您确定要删除所选数据吗？',function(r){
					if(r){
						$.ajax({
							type:'POST',
							url:thinkphp.url + 'Members/remove',
							data:{
								ids:ids.join(),
							},
							beforeSend:function(){
								$('#membersList').datagrid('loading');
							},
							success:function(resp){
								if(resp){
									$('#membersList').datagrid('loaded');
									$('#membersList').datagrid('reload');
									$.messager.show({
										'title':'亲爱的管理员',
										'msg':'成功删除' + resp + '条数据',
									});
								}
							},
							error: function(XMLHttpRequest, textStatus, errorThrown) {
				                alert(XMLHttpRequest.status);
				                alert(XMLHttpRequest.readyState);
				                alert(textStatus);
				            },
						});						
					}
				});
	
			}
		},
		undo:function(){
			$("#membersList").datagrid('uncheckAll');
		},
		checkAll:function(){
			$('#membersList').datagrid('checkAll');
		},
		search:function(){
			$('#membersList').datagrid('load',{
				username:$.trim($('input[name="username"]').val()),
				timeFrom:$.trim($('input[name="timeFrom"]').val()),
				timeTo:$.trim($('input[name="timeTo"]').val())
			});
		},
		reload:function(){
			$('#membersList').datagrid('reload');
		},
		add:function(){
			$('#addMember').dialog({
				title:'添加会员',
				width:400,
				height:300,
				modal:true,
				buttons:[
				{
					text:'提交',
					iconCls:'icon-edit_add',
					handler:function(){
						if ($('#addMember').form('validate')) {
							$.ajax({
								type:'POST',
								url:thinkphp.url + 'Members/add',
								data:{
									name:$.trim($('input[name="name"]').val()),
									password:$.trim($('input[name="password"]').val()),
									email:$.trim($('input[name="email"]').val()),
									qq:$.trim($('input[name="qq"]').val()),
									faceSrc:$('#face').attr('src'),
								},
								beforeSend:function(){
									$.messager.progress({
										title:'友情提醒',
										msg:'正在添加中...',
									})
								},
								success:function(resp){
									console.log(resp);
									if(resp > 0){
										$.messager.show({
											title:'友情提醒',
											msg:'添加成功',
										});
										$('#membersList').datagrid('reload');
										$.messager.progress('close');
										$('#addMember').dialog('close');
										
									}else{
										if(resp == -1){
											$.messager.progress('close');
											$.messager.alert({
													title:'友情提醒',
													msg:'用户名不能重复',
											});
											$('input[name="name"]').select();
											$.messager.progress('close');
										}else if(resp == -2){
											$.messager.progress('close');
											$.messager.alert({
													title:'友情提醒',
													msg:'请输入4-20位的用户名',
											});
											$('input[name="name"]').select();
										}else if(resp == -3){
											$.messager.progress('close');
											$.messager.alert({
													title:'友情提醒',
													msg:'请输入4-20位的密码',
											});
											$('input[name="password"]').select();										
										}else if(resp == -4){
											$.messager.progress('close');
											$.messager.alert({
													title:'友情提醒',
													msg:'邮箱地址不符合要求',
											});
											$('input[name="email"]').select();												
										}else if(resp == -5){
											$.messager.progress('close');
											$.messager.alert({
													title:'友情提醒',
													msg:'qq不符合要求',
											});
											$('input[name="qq"]').select();											
										}
									}
								}
							})							
						}

					}
				},
				{
					text:'取消',
					iconCls:'icon-cancel',
					handler:function(){
						$('#addMember').window('close');
					}
				}
				],
			});
		},
		edit:function(){
			var rows = $('#membersList').datagrid('getSelections');
			if(rows.length > 1){
				$.messager.alert({
					title:'友情提醒',
					msg:'无法同时编辑多条数据',
				});
			}else if(rows.length == 0){
				$.messager.alert({
					title:'友情提醒',
					msg:'您还没有选择要编辑的数据',
				});				
			}else if(rows.length == 1){
				$.ajax({
					type:'POST',
					url:thinkphp.url + 'Members/getOneMember',
					data:{
						id:rows[0].id
					},
					beforeSend:function(){
						$.messager.progress({
							title:'友情提醒',
							msg:'正在获取会员信息中...',
						})
					},
					success:function(resp){
						console.log(resp);
						$.messager.progress('close');
						if(resp){
							console.log(resp);
							$('#editMember').form('load',{
								edit_id:resp.id,
								edit_pass:resp.password,
								edit_name:resp.m_name,
								edit_email:resp.email,
								edit_qq:resp.qq
							}).dialog('open');							
						}
					}
				})
			}
		},
	}
	
	/*前台修改验证*/
	$('input[name="edit_password"]').validatebox({
		 required: false,
		 validType:'length[4,20]',
		 missingMessage:'请输入4-到20位密码',
	});
	$('input[name="edit_email"]').validatebox({
		required: false,
		validType:'email',
		missingMessage : '请输入电子邮件',
	});
	$('input[name="edit_qq"]').validatebox({
		 required: false,
		 validType:'length[0,11]',
		 missingMessage:'请输入11位qq号码',
	});
	
	/*前台新增验证*/
	$('input[name="name"]').validatebox({
		 required: true,
		 validType:'length[4,20]',
		 missingMessage:'请输入4-20位用户名',
	});
	$('input[name="password"]').validatebox({
		 required: true,
		 validType:'length[4,20]',
		 missingMessage:'请输入4-到20位密码',
	});
	$('input[name="email"]').validatebox({
		required: false,
		validType:'email',
		missingMessage : '请输入电子邮件',
	});
	$('input[name="qq"]').validatebox({
		 required: false,
		 validType:'length[0,11]',
		 missingMessage:'请输入11位qq号码',
	});
});
