$(document).ready(function(){
	$('#user-form :input').blur(function () {
        if ($(this).is('#name')) {
            if (this.value == '' || !/^([\w\_\u4e00-\u9fa5]){4,20}$/.test(this.value)) {
				$('#name').parent().addClass('has-error');
				$('#name').next().css('display','block');
			} else {
				$('#name').parent().removeClass('has-error');
                $('#name').next().css('display','none');
            }
        }
        if ($(this).is('#qq')) {
            if (this.value == '' || (this.value != '' && !/^[1-9]\d{4,12}$/.test(this.value))) {
				$('#qq').parent().addClass('has-error');
				$('#qq').next().css('display','block');
            } else {
				$('#qq').parent().removeClass('has-error');
                $('#qq').next().css('display','none');
            }
        }
        if($(this).is('#email')){
			if(this.value == '' || ( this.value!="" && !/.+@.+\.[a-zA-Z]{2,4}$/.test(this.value))){
				$('#email').parent().addClass('has-error');
				$('#email').next().css('display','block');
			}else{
				$('#email').parent().removeClass('has-error');
				$('#email').next().css('display','none');
			}
        }
	});
	$('#password-form :input').blur(function () {
		if ($(this).is('#old-password')) {
            if (this.value == '') {
				$('#old-password').parent().addClass('has-error');
				$('#old-password').next().html('密码不能为空');
				$('#old-password').next().css('display','block');
			} else {
				$('#old-password').parent().removeClass('has-error');
                $('#old-password').next().css('display','none');
            }
        }
        if ($(this).is('#new-password')) {
            if (this.value == '' || this.value != '' && !/^(\w){4,20}$/.test(this.value)) {
				$('#new-password').parent().addClass('has-error');
				$('#new-password').next().html('密码不符合规则');
				$('#new-password').next().css('display','block');
            } else {
				$('#new-password').parent().removeClass('has-error');
                $('#new-password').next().css('display','none');
            }
        }
        if($(this).is('#last-password')){
			if(this.value == '' || this.value != $('#new-password').val()){
				$('#last-password').parent().addClass('has-error');
				$('#last-password').next().html('密码与上面的密码不匹配');
				$('#last-password').next().css('display','block');
			}else{
				$('#last-password').parent().removeClass('has-error');
				$('#last-password').next().css('display','none');
			}
        }
	});
	$('.info-btn').click(function (e) {
        $('#user-form :input').trigger('blur');
        if ($('.has-error').length > 0) {
			alert('请填写完整');
            return false;
        } else {
			$.ajax({
                type: "POST",
                url: thinkphp.url + 'User/modify',
                data: {
                    name: $('#name').val(),
                    qq: $('#qq').val(),
                    email: $('#email').val(),
                },
                beforeSend: function () {
					
                },
                success: function (resp) {
					if(resp == 1 || resp == 0){
						$('.user-alert').addClass('alert-success');
						$('.user-alert').fadeIn('slow');
						$('.close').click(function(){
							$('.user-alert').fadeOut('slow');
						});
					}
                }
            })
        }

    });
	$('.passowrd-btn').click(function (e) {
        $('#password-form :input').trigger('blur');
        if ($('.has-error').length > 0) {
			return false;
        } else {
			$.ajax({
                type: "POST",
                url: thinkphp.url + 'User/modifyPass',
                data: {
                   'old-password':$('#old-password').val(),
				   'new-password':$('#new-password').val(),
                },
                beforeSend: function () {
					
                },
                success: function (resp) {
					if(resp == 1 || resp == 0){
						$('.user-alert').addClass('alert-success');
						$('.user-alert').children('span').html('密码修改成功');
						$('.user-alert').fadeIn('slow');
						$('.close').click(function(){
							$('.user-alert').fadeOut('slow');
							$('.user-alert').removeClass('alert-success');
						});
					}else if(resp == 2){
						$('.user-alert').addClass('alert-danger');
						$('.user-alert').children('span').html('原始密码不正确');
						$('.user-alert').fadeIn('slow');
						$('.close').click(function(){
							$('.user-alert').fadeOut('slow');
							$('.user-alert').removeClass('alert-danger');
						});
					}
                }
            })
        }

    });
	function getFileUrl(sourceId) {
		var url;
		if (navigator.userAgent.indexOf("MSIE")>=1) { // IE
			url = document.getElementById(sourceId).value;
		} else if(navigator.userAgent.indexOf("Firefox")>0) { // Firefox
			url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));
		} else if(navigator.userAgent.indexOf("Chrome")>0) { // Chrome
			url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));
		}
		return url;
	}

	/**
	 * 将本地图片 显示到浏览器上
	 */
	function preImg(sourceId, targetId) {
		var url = getFileUrl(sourceId);
		var imgPre = document.getElementById(targetId);
		imgPre.src = url;
	}
		
	function updateCoords(c){
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
	};
	function checkCoords(){
		alert(parseInt($('#w').val()));
		if (parseInt($('#w').val())) return true;
		alert('请裁剪头像');
		return false;
	};
	$(".upload-btn").click(function(){
		return $("#file").click();
	});
	
	var image=new Image();
	function setImageURL(url){
		image.src=url;
		$('.upload').click(function(){
			if(checkCoords()){
				var x = $('#x').val();
				var y = $('#y').val();
				var width = $('#w').val();
				var height = $('#h').val();
				var canvas=$('<canvas style="display:none;" width="'+width+'" height="'+height+'"></canvas>')[0],
				ctx=canvas.getContext('2d');
				ctx.drawImage(image,x,y,width,height,0,0,width,height);//重绘
				$(document.body).append(canvas);//添加到文档中可以查看效果
				var data=canvas.toDataURL(); //得到裁剪后的图片base64位数据
				
				// dataURL 的格式为 “data:image/png;base64,****”,逗号之前都是一些说明性的文字，我们只需要逗号之后的就行了
				//data=data.split(',')[1];
				//data=window.atob(data);
				/*var ia = new Uint8Array(data.length);
				for (var i = 0; i < data.length; i++) {
					ia[i] = data.charCodeAt(i);
				};*/
				// canvas.toDataURL 返回的默认格式就是 image/png
				//var blob=new Blob([ia], {type:"image/png"});
				//console.log(blob);
				$.ajax({
					type: "POST",
					url: thinkphp.url + 'User/upload',
					data: {
					   'img':data
					},
					beforeSend: function () {
						$('.cancel').addClass('disabled');
						//$('.info').css('display','none');
						//$('.status').css('display','block')
					},
					success: function (resp) {
						if(resp == 1){
							$(".close").click();
							//$('.info').css('display','block');
							//$('.status').css('display','none');
							$('#img').attr('src',data);
						}
					}
				})
			}
		})
	}
	$('#file').on('change',function(){
		preImg(this.id,'element_id')
		$('#myModal').modal('show');
		$('#element_id').Jcrop({
			aspectRatio: 1,
			onSelect: updateCoords
		});
		var file=this.files[0];
		var reader=new FileReader();
		reader.onload=function(){
			// 通过 reader.result 来访问生成的 DataURL
			var url=reader.result;
			setImageURL(url);
		};
		reader.readAsDataURL(file);
	});
});