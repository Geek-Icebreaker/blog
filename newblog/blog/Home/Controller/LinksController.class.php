<?php
namespace Home\Controller;
use Think\Controller;
class LinksController extends Controller {
	public function index(){
        if (session('name')) {
            $this->assign('name', session('name'));
        } else {
            $this->assign('name', '');
        }		
		$links = M('Links');
		$this->assign('allLinks',$links->select());
		$this->display();
	}
}