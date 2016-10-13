<?php
namespace Home\Controller;
use Think\Controller;
class TagsController extends Controller {
	public function index(){
		A('Common')->onLine();
		$remoteInfo = A('Base')->getRemoteInfo();
		$this->assign('remoteInfo',$remoteInfo);
		$this->display();
	}
}