$(document).ready(function () {
	$('.login-close').click(function(){
		$('.login-alert').hide();;
	});
	$('.reg-close').click(function(){
		$('.reg-alert').hide();
	});
    $('#login-form :input').blur(function () {
        if ($(this).is('#loginModalUserName')) {
            if (this.value == '') {
                $('#loginModalUserName').parent().addClass('has-error');
            } else {
                $('#loginModalUserName').parent().removeClass('has-error');
            }
        }
        if ($(this).is('#loginModalUserPwd')) {
            if (this.value == '') {
                $('#loginModalUserPwd').parent().addClass('has-error');
            } else {
                $('#loginModalUserPwd').parent().removeClass('has-error');
            }
        }
    });
    $('.login').click(function (e) {
        $('#login-form :input').trigger('blur');
        if ($('.has-error').length > 0) {
            return false;
        } else {
            e.preventDefault();
            var l = Ladda.create(this);
            l.start();
            l.setProgress(0.9);
            $.ajax({
                type: "POST",
                url: thinkphp.url + 'Index/login',
                data: {
                    name: $('#loginModalUserName').val(),
                    password: $('#loginModalUserPwd').val(),
                },
                beforeSend: function () {
                    $('.login').text('登录验证中...');
                },
                success: function (resp) {
                    console.log(resp);
                    if (resp == 1) {
                        $('.login').text('登录成功');
                        window.location.reload();
                    } else if (resp == 0) {
						$('.login-alert').addClass('alert-danger');
                        $('.login-alert').show();
                        l.stop();
                        $('.login').text('登录');
                    }
                }
            });
        }
    });
    $('#reg-form :input').blur(function () {
        if ($(this).is('#regModalUserNmae')) {
            if (this.value == '' || !/^([\w\_\u4e00-\u9fa5]){4,20}$/.test(this.value)) {
                $('#regModalUserNmae').parent().addClass('has-error');
            } else {
                $('#regModalUserNmae').parent().removeClass('has-error');
            }
        }
        if ($(this).is('#regModalUserPwd')) {
            if (this.value == '' || !/^(\w){4,20}$/.test(this.value)) {
                $('#regModalUserPwd').parent().addClass('has-error');
            } else {
                $('#regModalUserPwd').parent().removeClass('has-error');
            }
        }
        /*
         if($(this).is('#regEmail')){
         if(this.value == '' || ( this.value!="" && !/.+@.+\.[a-zA-Z]{2,4}$/.test(this.value) )){
         $('#regEmail').parent().addClass('has-error');
         }
         }*/
        if ($(this).is('#regQq')) {
            if (this.value == '' || (this.value != '' && !/^[1-9]\d{4,12}$/.test(this.value))) {
                $('#regQq').parent().addClass('has-error');
            } else {
                $('#regQq').parent().removeClass('has-error');
            }
        }
    });

    $('.reg').click(function (e) {
        $('#reg-form :input').trigger('blur');
        if ($('.has-error').length > 0) {
            return false;
        } else {
            e.preventDefault();
            var l = Ladda.create(this);
            l.start();
            l.setProgress(0.9);
            $.ajax({
                type: "POST",
                url: thinkphp.url + 'Index/reg',
                data: {
                    name: $('#regModalUserNmae').val(),
                    password: $('#regModalUserPwd').val(),
                    //email:regEmail,
                    qq: $('#regQq').val(),
                },
                beforeSend: function () {
                    $('.reg').text('注册验证中...');
                },
                success: function (resp) {
                    console.log(resp);
                    if (resp == 0) {
                        l.stop();
                        $('.reg-alert').children('span').text('此用户名已被占用');
                        $('.reg-alert').addClass('alert-danger');
                        $('.reg-alert').show();
						$('.reg').text('注册');
                        //window.location.reload();
                    } else if (resp == -1) {
                        l.stop();
                        $('.reg-alert').children('span').text('请输入4-20位用户名');
                        $('.reg-alert').addClass('alert-danger');
                        $('.reg-alert').show();
						$('.reg').text('注册');
                    } else if (resp == -2) {
                        l.stop();
                        $('.reg-alert').children('span').text('请输入4-20位字母或数字密码');
                        $('.reg-alert').addClass('alert-danger');
                        $('.reg-alert').show();
						$('.reg').text('注册');
                    } else if (resp == -3) {
                        l.stop();
                        $('.reg-alert').children('span').text('请输入合法的qq号');
                        $('.reg-alert').addClass('alert-danger');
                        $('.reg-alert').show();
						$('.reg').text('注册');
                    }else{
						$('.reg-alert').children('span').text('注册成功 跳转到登录页面中...');
                        $('.reg-alert').addClass('alert-success');
                        $('.reg-alert').show();
						$('.reg').text('注册');
						setTimeout(function(){
							$("#loginModal").modal('show');
							$('#regModal').modal('hide');
						},2000);
					}
                }
            })
        }

    });

    /**
     *
     * @param str  用户评论的内容
     * @returns {*} 替换表情 返回实际的内容
     */
    function replace_em(str){
        str = str.replace(/</g,'<;');
        str = str.replace(/>/g,'>;');
        str = str.replace(/ /g,'<;br/>;');
        str = str.replace(/\[em_([0-9]*)\]/g,'<img src="'+ thinkphp.publicUrl +'/Home/images/arclist/$1.gif" border="0" />');
        return str;
    }
    function comment(data) {
        $.ajax({
            type: "POST",
            data: data,
            url: thinkphp.url + 'Article/comment',
            beforeSend: function () {

            },
            success: function (resp) {

                if (resp) {
                    //alert('评论成功');
                    var username = $('.username').val();
                    var commentLi =  '<li class="comment-content">'
                        + '<span class="comment-f"><a href="###" draggable="false" id="' + resp + '"  onclick="delComment(this);">删除</a></span>'
                        + '<div class="comment-avatar">'
                        + '<img class="avatar" src="/thinkphp2/Public/Home/images/icon/icon.png" alt=""/>'
                        + '</div>'
                        + '<div class="comment-main">'
                        + '<p>来自<span class="address">'+ username +'</span>的用户<span class="time">(2016-01-06)</span><br/>'
                        +  replace_em(data.comment)
                        + '</p></div></li>';
                    $('.commentlist').prepend(commentLi);
                } else if (resp == 0) {
                    //alert('评论失败');
                }
            }
        });
    }

    $('#comment-submit').click(function () {
        $.ajax({
            type: "GET",
            url: thinkphp.url + 'Base/isOnline',
            beforeSend: function () {

            },
            success: function (resp) {
                if (resp == 1) {
                    var aid = $('.articleid').val();
                    var mid = $('.userid').val();
                    var neirong = $('#comment-textarea').val();
                    var data = {
                        'aid': aid,
                        'mid': mid,
                        'comment': neirong
                    };
                    if ($('#comment-textarea').val() != '') {
                        comment(data);
                    } else {
                        $('.comment-alert').show();
                        $('.close').click(function () {
                            $('.comment-alert').hide();
                        });
                    }
                } else if (resp == 0) {
                    $('#remind').modal('show');
                }
            }
        });
    });
    $('#goLogin').click(function () {
        $('#remind').modal('hide');
        $("#loginModal").modal('show');
    });
    $('#goReg').click(function () {
        $('#remind').modal('hide');
        $("#regModal").modal('show');
    });
    $('#headLogin').click(function () {
        $("#loginModal").modal('show');
    });
    $('#headReg').click(function () {
        $("#regModal").modal('show');
    });
	//搜索
	$('#search').click(function(){
		if($('#keyword').val() != ''){
			location.href = '/article/s/' + encodeURI(encodeURI($('#keyword').val()));
		}
	});
	
});

function delComment(obj){
    $.ajax({
        type: "POST",
        data: {
            id:obj.id
        },
        url: thinkphp.url + 'Article/delComment',
        beforeSend: function () {

        },
        success: function (resp) {
            if (resp == 1) {
                $(obj).parent().parent().remove();
            } else if (resp == 0) {

            }
        }
    });
}
function returnComment(obj) {
    var html =  '<div class="comment-box replay-box">'
            +   '<textarea placeholder="@icebreaker" name="comment" class="replay" id="replay-textarea" cols="100%" rows="3" tabindex="1"></textarea>'
            +   '<div class="comment-ctrl"><span class="emotion">'
            +   '<img src="" width="20" height="20" alt=""/>表情</span>'
            +   '<div class="comment-prompt">'
            +   '<i class="fa fa-spin fa-circle-o-notch"></i>'
            +   '<span class="comment-prompt-text"></span></div>'
            +   '<button type="button" name="comment-submit" id="replay-submit" tabindex="5">回复</button>'
            +   '</div></div>';
    $(obj).parent().siblings('.comment-main').append(html);
}