<?php
namespace Home\Controller;
use Think\Controller;
class ReadersController extends Controller {
	public function index(){
		if (session('name')) {
            $this->assign('name', session('name'));
        } else {
            $this->assign('name', '');
        }
		$members = D('Members');
		$readers = $members->getReaders();
		$this->assign('readers',$readers);
		$remoteInfo = A('Base')->getRemoteInfo();
		$this->assign('remoteInfo',$remoteInfo);
		$this->display();
	}
}