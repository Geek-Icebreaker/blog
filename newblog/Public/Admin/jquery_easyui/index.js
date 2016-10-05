$(function(){
	/*
	$('#tabs').tabs('add',{
		title:'后台首页',
		content:'后台首页内容',
		closeble:false,
		fit:true,
		tools:[{
			iconCls:'icon-mini-refresh',
				handler:function(){
				alert('refresh');
			}
		}],
	
	});	*/
	

	$('#logout').bind('click',function(){
		$.ajax({
			type:'POST',
			url:thinkphp.url + 'Index/logout',
			data:'logout=1',
			dataType:'json',
			beforeSend:function(){
				$.messager.progress({
						title:'友情提醒',
						msg:'正在退出处理中...',
				})
			},
			success:function(resp){
				if(resp.status == 1){
					$.messager.alert({
						title:'警告',
						msg:'成功退出后台管理系统'
					});
					location.href = resp.url;
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.status);
                alert(XMLHttpRequest.readyState);
                alert(textStatus);
            },
		});
	});
	$('#system').tree({
    	url: thinkphp.url + 'Index/showNav',
    	lines:true,
    	onLoadSuccess:function(node,data){
    		var ul_this = this;
    		if(data){
    			$(data).each(function(index,value){
    				if(this.state == 'closed'){
    					$(ul_this).tree('expandAll');
    				}
    			})
    		}
    	},
    	onClick:function(node){
    		if($('#tabs').tabs('exists',node.text)){
    			$('#tabs').tabs('select',node.text);
    		}else{
    			
	    		$('#tabs').tabs('add',{
	    			title:node.text,
					closable:true,
					iconCls:node.iconCls,
					href:thinkphp.url + node.url,
				});
			}
		}
    });
    
	$('#tabs').tabs({
		
	})
})


