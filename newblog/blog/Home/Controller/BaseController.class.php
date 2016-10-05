<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
	public function logout(){
		session('name',null);
		header('Location: http://www.ice-breaker.cn/');
	}
	public function isOnline(){
        if(!session('?name')){
            echo 0;
        }else{
            echo 1;
        }
    }
	public function frontUser(){
		if (session('name')) {
            $this->assign('name', session('name'));
        } else {
            $this->assign('name', '');
        }
	}
	public function getHotArticle(){
		$article = D('Article');
		return $article->getHotArticle();
	}
}