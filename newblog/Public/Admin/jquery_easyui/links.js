$(function(){
	$('#linkList').datagrid({
		url:thinkphp.url + 'Links/getLinks',
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
		sortName:'time', //排序字段
		sortOrder:'DESC',    //排序方式
		columns:[[
			{
				field:'id',
				title:'编号',
				width:50,
				checkbox:true
			},
			{
				field:'name',
				title:'名称',
				width:50
			},
			{
				field:'url',
				title:'地址',
				width:100
			},
			{
				field:'time',
				title:'添加时间',
				width:100
			},
			{
			field:'status',
				title:'显示状态',
				width:100,
				sortable:true
			}
		]],
	});
	$('#editLinks').dialog({
		title: '修改友链',
		width: 400,
		height: 300,
		closed: true,
		cache: false,
		modal: true,
		buttons:[{
			text:'提交',
			handler:function(){
				if ($('#editLinks').form('validate')) {
					//alert($('#e_date').datetimebox('getValue'));
					$.ajax({
						type:'POST',
						url:thinkphp.url + 'Links/updateLink',
						data:{
							id:$.trim($('#e_id').val()),
							name:$.trim($('#e_name').val()),
							url:$.trim($('#e_url').val()),
							date:$.trim($('#e_date').datetimebox('getValue')),
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
								$('#linkList').datagrid('reload');
								$.messager.progress('close');
								$('#editLinks').dialog('close');
							}
						}
					})
				}
			}
		},{
			text:'取消',
			handler:function(){
				alert('cancel');
			}
		}],
	});
	tools = {
		delete:function(){
			var rows = $('#linkList').datagrid('getSelections');
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
							url:thinkphp.url + 'Links/remove',
							data:{
								ids:ids.join(),
							},
							beforeSend:function(){
								$('#linkList').datagrid('loading');
							},
							success:function(resp){
								if(resp){
									$('#linkList').datagrid('loaded');
									$('#linkList').datagrid('reload');
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
			$("#linkList").datagrid('uncheckAll');
		},
		checkAll:function(){
			$('#linkList').datagrid('checkAll');
		},
		search:function(){
			$('#linkList').datagrid('load',{
				username:$.trim($('input[name="username"]').val()),
				timeFrom:$.trim($('input[name="timeFrom"]').val()),
				timeTo:$.trim($('input[name="timeTo"]').val())
			});
		},
		reload:function(){
			$('#linkList').datagrid('reload');
		},
		add:function(){
			$('#a_name').validatebox({
				required: true,
                missingMessage: "请输入链接名称",
            });
			$('#a_url').validatebox({
                required: true,
                missingMessage: '请输入链接url'
            });
			$('#a_date').datetimebox({
                required: true,
                showSeconds: true,
                missingMessage: '请输入添加日期'
            });
			$('#addLinks').dialog({
				title:'添加友链',
				width:400,
				height:300,
				modal:true,
				buttons:[
				{
					text:'提交',
					iconCls:'icon-edit_add',
					handler:function(){
						if ($('#addLinks').form('validate')) {
							$.ajax({
								type:'POST',
								url:thinkphp.url + 'Links/add',
								data:{
									name:$.trim($('input[name="a_name"]').val()),
									url:$.trim($('input[name="a_url"]').val()),
									date:$.trim($('input[name="a_date"]').val()),
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
										$('#linkList').datagrid('reload');
										$.messager.progress('close');
										$('#addLinks').dialog('close');
									}else{
										/*
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
										}*/
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
						$('#addLinks').window('close');
					}
				}
				],
			});
		},
		edit:function(){
			$('#e_name').validatebox({
				required: true,
                missingMessage: "请输入链接名称",
            });
			$('#e_url').validatebox({
                required: true,
                missingMessage: '请输入链接url'
            });
			$('#e_date').datetimebox({
                required: true,
                showSeconds: true,
                missingMessage: '请输入添加日期'
            });
			var rows = $('#linkList').datagrid('getSelections');
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
					url:thinkphp.url + 'Links/getOneLink',
					data:{
						id:rows[0].id
					},
					beforeSend:function(){
						$.messager.progress({
							title:'友情提醒',
							msg:'正在获取数据中...',
						})
					},
					success:function(resp){
						$.messager.progress('close');
						if(resp){
							$('#editLinks').form('load',{
								e_id:resp.id,
								e_name:resp.name,
								e_url:resp.url,
								e_date:resp.time
							}).dialog('open');				
						}
					}
				})
			}
		},
	}
	

});
