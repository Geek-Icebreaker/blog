<?php
namespace Home\Controller;
use Think\Controller;
class SafeController extends Controller {
	public function index(){
        if (session('name')) {
            $this->assign('name', session('name'));
        } else {
            $this->assign('name', '');
        }
        $articles = D('Home/Article');
        $arr = $articles->getarticles('3');
		$this->assign('articleList', $arr[0]);
        $this->assign('pageshow', $arr[1]);
        $this->display();
	}
}