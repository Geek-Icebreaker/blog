<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	public function set(){
		A('Base')->frontUser();
		$members = M('Members');
		$user = $members->where('id=%d',session('id'))->getField('m_name,email,qq,faceSrc');
		
		$this->assign('user',$user);
		$remoteInfo = A('Base')->getRemoteInfo();
		$this->assign('remoteInfo',$remoteInfo);
		$this->display('set');
	}
	public function notice(){
		$this->display('notice');
	}
	public function password(){
		A('Base')->frontUser();
		$remoteInfo = A('Base')->getRemoteInfo();
		$this->assign('remoteInfo',$remoteInfo);
		$this->display('password');
	}
	public function modify(){
		if(IS_AJAX){
			$members = D('Members');
			return $members->modify(session('id'),I('post.name'),I('post.qq'),I('post.email'));
		}
	}
	public function modifyPass(){
		if(IS_AJAX){
			$members = D('Members');
			$password = $members->where('id=%d',session('id'))->getField('password');
			if(md5(I('post.old-password')) == $password){
				echo $members->modifyPass(session('id'),I('post.new-password'));
			}else{
				echo 2;
			}
		}		
	}
	public function upload(){
		if(IS_AJAX){
			$img = I('post.img');
			$members = D('Members');
			$data['id'] = session('id');
			$data['faceSrc'] = $img;
			echo $members->save($data);
		}
	}
}