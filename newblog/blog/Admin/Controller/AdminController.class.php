<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
	public function index(){
		echo 'admin page';
	}
	public function getAdmins(){
		if(IS_AJAX){
			$cate = D('Admin');
			$this->ajaxReturn($cate->getAdmins());
		}
	}
}