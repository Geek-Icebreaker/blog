<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
		$this->display();
	}
	public function testmodel(){
		$admin = M('Admin');
		var_dump($admin);
	}
	public function login(){
		$map['name'] = I('post.loginName');
		$map['password'] = md5(I('post.loginPass'));
		$admin = M('Admin');
		$data = $admin->where($map)->find();
		if($data['id']){
			$dataArr = array('login_time'=>time(),'login_ip'=>$_SERVER["REMOTE_ADDR"]);
			$admin->where('id=%d',$data['id'])->setField($dataArr);
			session(array(
				'admin'=>$data['name'],
				'expire'=>3600*2,
			));
			session('admin',$data['name']);
			$return = array('status'=> 1,'url'=>U('Admin/Index/index'));
			echo json_encode($return);
		}else{
			$return = array('status'=> 0,'url'=>U('Admin/Login/index'));
			echo json_encode($return);
		}
	}
}