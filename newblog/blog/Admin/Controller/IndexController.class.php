<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	if(!session('?admin')){
    		$this->redirect('Admin/Login/index');
    	}elseif(session('?admin')){
			$admin = M('Admin');
			$lastLoginTime = date('Y-m-d H:i:s',$admin->where('name=%d',session('admin'))->getField('login_time'));
    		$this->assign('name',session('admin'));
			$this->assign('lastLoginTime',$lastLoginTime);
			$this->display();
    	}
	}
	public function logout(){
		$status = I('post.logout');
		if($status == 1){
			if(session('?admin')){
				session('admin',null);
				$return = array('status'=> 1,'url'=>U('Admin/Login/index'));
				echo json_encode($return);
			}			
		}
	}
	public function showNav(){
		$nav = D('AdminNav');
		$this->ajaxReturn($nav->getNav(I('post.id')));
	}
}