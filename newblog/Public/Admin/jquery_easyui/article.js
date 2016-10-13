$.extend($.fn.validatebox.defaults.rules, {
    email: {
        validator: function (value, param) {
            return /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
        },
        message: '邮箱格式不正确'
    }
});
//window.UEDITOR_HOME_URL = thinkphp.umedit;
//window.serverUrl = thinkphp.url + 'Umedit/um';
/*
 var ue = UE.getEditor('container',{
 initialFrameWidth:890,
 initialFrameHeight:320
 });*/
$(function () {

    $('#articleList').datagrid({
        url: thinkphp.url + 'Article/getarticles',
        fitColumns: true, //列自动扩充屏幕宽度
        toolbar: '#article-toolbar',
        striped: true, //设置基偶行背景色
        rownumbers: true, //设置为true 在列表钱显示行号 是jquery easyui自动排列的行号 非数据库ID号
        selectOnCheck: true,  //当选中复选框才会选中当前行
        checkOnSelect: true,  //当选中当前行才会选中复选框
        border: false,
        pagination: true,
        pageNumber: 1,
        pageSize: 20,
        sortName: 'create_time', //排序字段
        sortOrder: 'DESC',    //排序方式
        columns: [[
            {
                field: 'a_id',
                title: '编号',
                width: 50,
                checkbox: true
            },
            {
                field: 'a_title',
                title: '文章标题',
                width: 50
            },
            {
                field: 'name',
                title: '发布者',
                width: 100
            },
            {
                field: 'cate_name',
                title: '所属分类',
                width: 100
            },
            {
                field: 'create_time',
                title: '创建时间',
                width: 100,
                sortable: true
            },
            {
                field: 'a_views',
                title: '点击次数',
                width: 100,
                sortable: true
            }

        ]],
    });

    $('#editArticle').dialog({
        width: 960,
        height: 550,
        maximizable: true,  //是否使用放大按钮
        collapsible: true, //是否使用折叠按钮
        draggable: false, //是否可以拖拽  默认ture
        title: '编辑文章',
        iconCls: 'icon-user-add',
        modal: true,
        closed: true,
        buttons: [
            {
                text: '提交',
                iconCls: 'icon-edit-new',
                handler: function () {
                    if ($('#editArticle').form('validate')) {
						$.ajax({
                            type: 'POST',
                            url: thinkphp.url + 'Article/updateArticle',
                            data: {
                                id: $.trim($('input[name="e_id"]').val()),
                                title: $('input[name="e_title"]').val(),
								intro: $('input[name="e_intro"]').val(),
                                cate: $('#e-cate').combobox('getValue'),
                                author: $('#e-author').combobox('getValue'),
                                create_time: $('input[name="e_create_time"]').val(),
                                content: CKEDITOR.instances.e_editor.getData()
                            },
                            beforeSend: function () {
                                $.messager.progress({
                                    title: '友情提醒',
                                    msg: '正在修改中...',
                                })
                            },
                            success: function (resp) {
                                console.log(resp);
                                if (resp > 0) {
                                    $.messager.show({
                                        title: '友情提醒',
                                        msg: '修改成功',
                                    });
                                    $('#articleList').datagrid('reload');
                                    $.messager.progress('close');
                                    $('#editArticle').dialog('close');

                                } 
                            }
                        })
                    }
                    //console.log($('input[name="edit_username"]').val());
                }
            },
            {
                text: '取消',
                iconCls: 'icon-redo',
                handler: function () {
                    $('#editArticle').dialog('close');
                    $('#editArticle').form('clear');
                    $('#e_editor').empty();
                }
            }
        ],
        onClose: function () {
            $('#editArticle').form('clear');
            $('#e_editor').empty();
        },
    });
    tools = {
        delete: function () {
            var rows = $('#articleList').datagrid('getSelections');
            var ids = Array();
            if (rows.length == 0) {
                $.messager.alert({
                    'title': '友情提醒',
                    'msg': '您没有选定要删除的数据'
                })
            } else {
                for (var i = 0; i < rows.length; i++) {
                    ids.push(rows[i].a_id);
                }
                $.messager.confirm('友情提醒', '您确定要删除所选数据吗？', function (r) {
                    if (r) {
                        $.ajax({
                            type: 'POST',
                            url: thinkphp.url + 'Article/remove',
                            data: {
                                ids: ids.join(),
                            },
                            beforeSend: function () {
                                $('#articleList').datagrid('loading');
                            },
                            success: function (resp) {
                                if (resp) {
                                    $('#articleList').datagrid('loaded');
                                    $('#articleList').datagrid('reload');
                                    $.messager.show({
                                        'title': '亲爱的管理员',
                                        'msg': '成功删除' + resp + '条数据',
                                    });
                                }
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                alert(XMLHttpRequest.status);
                                alert(XMLHttpRequest.readyState);
                                alert(textStatus);
                            },
                        });
                    }
                });

            }
        },
        undo: function () {
            $("#articleList").datagrid('uncheckAll');
        },
        checkAll: function () {
            $('#articleList').datagrid('checkAll');
        },
        search: function () {
            $('#articleList').datagrid('load', {
                username: $.trim($('input[name="username"]').val()),
                timeFrom: $.trim($('input[name="timeFrom"]').val()),
                timeTo: $.trim($('input[name="timeTo"]').val())
            });
        },
        reload: function () {
            $('#articleList').datagrid('reload');
        },
        add: function () {
			$('input[name="file"]').filebox({
				buttonText: '选择上传图片',
				buttonAlign: 'right'
			})
			$('input[name="title"]').validatebox({
                required: true,
                missingMessage: "请输入文章标题",
            })
            $('#cate').combobox({
                required: true,
                url: thinkphp.url + 'Article/getcate',
                valueField: 'cate_id',
                textField: 'cate_name',
                missingMessage: '请选择文章分类'
            });
			$('input[name="intro"]').validatebox({
                required: true,
                missingMessage: "请输入文章简介",
            })
            $('#author').combobox({
                required: true,
                url: thinkphp.url + 'Admin/getAdmins',
                valueField: 'id',
                textField: 'name',
                missingMessage: '请选择文章发布者'
            });
            $('#dt').datetimebox({
                required: true,
                value: '3/4/2010 2:3',
                showSeconds: true,
                missingMessage: '请输入文章创建日期'
            });
            if (CKEDITOR.instances['editor']) {
                CKEDITOR.instances['editor'].destroy();
            }
			var editor = CKEDITOR.replace('editor', {
				filebrowserBrowseUrl: thinkphp.public + '/Admin/ckfinder/ckfinder.html',
				filebrowserImageBrowseUrl: thinkphp.public + '/Admin/ckfinder/ckfinder.html?type=Images',
				//  filebrowserFlashBrowseUrl: '__PUBLIC__/Admin/ckfinder/ckfinder.html?type=Flash',
				filebrowserUploadUrl: thinkphp.public + '/ckfinder/Admin/core/connector/php/connector.php?command=QuickUpload&type=Files',
				// filebrowserImageUploadUrl: '__PUBLIC__/Admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
				filebrowserImageUploadUrl: 'http://www.ice-breaker.cn/admin.php/Ckfinder/upload?action=uploadImg',
				filebrowserFlashUploadUrl: thinkphp.public + '/Admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
			});

            CKEDITOR.editorConfig = function (config) {
                config.language = 'zh-cn';
                config.uiColor = '#b6b6b6';
                config.height = 300;
                config.toolbarCanCollapse = true;
            }
			$('input[name="file"]').on('change',function(){
				var fileObj = $(this).filebox('getValue');
				console.log(fileObj);
				if (!fileObj) {
					alert('请选择文件');
					return;
				} else {
					var FileController = thinkphp.url + 'Base/upload';
					// FormData Object
					var form = new FormData();
					form.append("file", fileObj); // file obj
					// XMLHttpRequest object
					var xhr = new XMLHttpRequest();
					xhr.open("post", FileController, true);
					xhr.onload = function () {

					};
					xhr.onreadystatechange = function () {
						if (xhr.readyState == 4 && xhr.status == 200) {
							if (xhr.responseText == 1)
								alert('upload success');
							else if (xhr.responseText == 2)
								alert("Please replace the file suffix");
							else if (xhr.responseText == 3)
								alert('upload error,please again');
							else if (typeof xhr.responseText == 'string'){
								imgPath = xhr.responseText;
								alert(imgPath);
							}

						}
					}
					xhr.send(form);
				}			
			});
            $('#addArticle').dialog({
                maximizable: true,  //是否使用放大按钮
                collapsible: true, //是否使用折叠按钮
                draggable: true, //是否可以拖拽  默认ture
                title: '新建文章',
                width: 960,
                height: 550,
                modal: true,
                buttons: [
                    {
                        text: '提交',
                        iconCls: 'icon-ok',
                        handler: function () {
                            $.ajax({
                                type: "post",
                                url: thinkphp.url + "Article/addarticle",
                                data: {
                                    title: $('input[name="title"]').val(),
									intro: $('input[name="intro"]').val(),
                                    cate: $('#cate').combobox('getValue'),
                                    author: $('input[name="author"]').val(),
                                    create_time: $('input[name="create-time"]').val(),
                                    content: CKEDITOR.instances.editor.getData()
								},
                                success: function (resp) {
                                    if (resp) {
                                        //$('#articleList').datagrid('loaded');
										$('#articleList').datagrid('reload');
										$.messager.show({
											'title': '亲爱的管理员',
											'msg': '文章添加成功',
										});
										$('#addArticle').dialog('close');
									}
                                },
                                error: function () {

                                }
                            });
                        }
                    },
                    {
                        text: '取消',
                        iconCls: 'icon-cancel',
                        handler: function () {
                            $('#addArticle').window('close');
                        }
                    }
                ],
                close: function () {
                    alert(1);
                }
            });
        },

        edit: function () {
            $('input[name="e_title"]').validatebox({
                required: true,
                missingMessage: "请输入文章标题",
            })
            $('#e-cate').combobox({
                required: true,
                url: thinkphp.url + 'Article/getcate',
                valueField: 'cate_id',
                textField: 'cate_name',
                missingMessage: '请选择文章分类'
            });
            $('#e-author').combobox({
                required: true,
                url: thinkphp.url + 'Admin/getAdmins',
                valueField: 'id',
                textField: 'name',
                missingMessage: '请选择文章发布者'
            });
            $('#e-dt').datetimebox({
                required: true,
                value: '3/4/2010 2:3',
                showSeconds: true,
                missingMessage: '请输入文章创建日期'
            });
            var rows = $('#articleList').datagrid('getSelections');
            if (rows.length > 1) {
                $.messager.alert({
                    title: '友情提醒',
                    msg: '无法同时编辑多条数据',
                });
            } else if (rows.length == 0) {
                $.messager.alert({
                    title: '友情提醒',
                    msg: '您还没有选择要编辑的数据',
                });
            } else if (rows.length == 1) {
                $.ajax({
                    type: 'POST',
                    url: thinkphp.url + 'Article/getOnearticle',
                    data: {
                        a_id: rows[0].a_id
                    },
                    beforeSend: function () {
                        $.messager.progress({
                            title: '友情提醒',
                            msg: '正在获取文章信息中...',
                        })
                    },
                    success: function (resp) {
                        console.log(resp);
                        $('#e-cate').combobox({
                            required: true,
                            url: thinkphp.url + 'Article/getcate',
                            valueField: 'cate_id',
                            textField: 'cate_name',
                            missingMessage: '请选择文章分类'
                        });
                        $('#e-author').combobox({
                            required: true,
                            url: thinkphp.url + 'Admin/getAdmins',
                            valueField: 'id',
                            textField: 'name',
                            missingMessage: '请选择文章发布者'
                        });
                        $('#e-dt').datetimebox({
                            required: true,
                            value: '3/4/2010 2:3',
                            showSeconds: true,
                            missingMessage: '请输入文章创建日期'
                        });

                        if (CKEDITOR.instances['e_editor']) {
                            CKEDITOR.instances['e_editor'].destroy();

                        }
                        var editor = CKEDITOR.replace('e_editor', {
                            filebrowserBrowseUrl: thinkphp.public + '/Admin/ckfinder/ckfinder.html',
                            filebrowserImageBrowseUrl: thinkphp.public + '/Admin/ckfinder/ckfinder.html?type=Images',
                            //  filebrowserFlashBrowseUrl: '__PUBLIC__/Admin/ckfinder/ckfinder.html?type=Flash',
                            filebrowserUploadUrl: thinkphp.public + '/ckfinder/Admin/core/connector/php/connector.php?command=QuickUpload&type=Files',
                            // filebrowserImageUploadUrl: '__PUBLIC__/Admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                            filebrowserImageUploadUrl: 'http://www.ice-breaker.cn/admin.php/Ckfinder/upload?action=uploadImg',
                            filebrowserFlashUploadUrl: thinkphp.public + '/Admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                        });

                        CKEDITOR.editorConfig = function (config) {
                            config.language = 'zh-cn';
                            config.uiColor = '#b6b6b6';
                            config.height = 300;
                            config.toolbarCanCollapse = true;
                        }
                        $.messager.progress('close');
                        CKEDITOR.instances.e_editor.setData(resp.a_content);
                        if (resp) {
                            //$('#e_editor').text(resp.a_content);  //网上有很多人用text方法去设置值。其实会存在缓存问题。最好用富文本自带的函数设置
                            console.log(resp);
                           $('#editArticle').form('load', {
                                e_id:resp.a_id,
                                e_title: resp.a_title,
								e_intro:resp.a_intro,
                                e_cate: resp.cate_name,
                                e_author: resp.name,
                                e_create_time: resp.create_time,
                            }).dialog('open');
                        }
                    }
                })
            }
        },
    }


});
