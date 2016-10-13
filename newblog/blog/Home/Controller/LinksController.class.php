<?php
namespace Home\Controller;
use Think\Controller;
class LinksController extends Controller {
	public function index(){
		A('Common')->onLine();
		$links = M('Links');
		$this->assign('allLinks',$links->select());
		$remoteInfo = A('Base')->getRemoteInfo();
		$this->assign('remoteInfo',$remoteInfo);
		$this->display();
	}
}