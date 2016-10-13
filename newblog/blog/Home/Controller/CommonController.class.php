<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class CommonController extends Controller {
	public function showPage($aid,$tpl){
		$this->onLine();
		$count = $this->infoCount();
		$articles = D('Home/Article');
		$remoteInfo = A('Base')->getRemoteInfo();
		$arr = $articles->getarticles($aid);
		$hotArticle = A('Base')->getHotArticle();
		
		
		$this->assign('hotArticle',$hotArticle);
		$this->assign('articleList', $arr[0]);
        $this->assign('pageshow', $arr[1]);
		$this->assign('remoteInfo',$remoteInfo);
		$this->assign('count',$count);
		$this->display($tpl);
	}
	public function onLine(){
		if (session('name')) {
            $this->assign('name', session('name'));
        } else {
            $this->assign('name', '');
        }		
	}
	public function infoCount(){
		$count = array();
		$model = new Model();
		$count['members'] = count($model->query('select id from blog_members'));
		$count['cates'] = count($model->query('select cate_id from blog_article_cate'));
		$count['comments'] = count($model->query('select id from blog_comment'));
		$count['tags'] = 8;
		return $count;
	}
}