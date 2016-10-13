<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
	public function upload(){
		//$uploadobj = new \Think\UploadFile($_FILES);// 实例化上传类
		//$uploadobj->upload();
		var_dump($_FILES);
	}
}