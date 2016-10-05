<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends Controller {
	public function index(){
		$this->display();
	}
	//初始化加载所有用户数据
	public function getarticles(){
		if(IS_AJAX){
			$articles = D('Article');
			$this->ajaxReturn(
								$articles->getarticles(
														I('post.page'),
														I('post.rows'),
														I('post.sort'),
														I('post.order')
													)
							);
		}else{
			$this->error('非法请求');
		}
	}
	public function getcate(){
		if(IS_AJAX){
			$cate = D('ArticleCate');
			$this->ajaxReturn($cate->getcate());
		}
	}
	public function addarticle(){
		if(IS_AJAX){
			$articles = D('Article');
			$aid = $articles->addarticle(
									I('post.title','','htmlspecialchars'),
									I('post.intro','','htmlspecialchars'),
									I('post.cate','','htmlspecialchars'),
									I('post.author','','htmlspecialchars'),
									I('post.create_time','','htmlspecialchars'),
									I('post.content','','htmlspecialchars')
							     );
			echo $aid;
		}
	}
	//删除文章
	public function remove(){
		if(IS_AJAX){
			$articles = D('Article');
			echo $articles->remove(I('post.ids'));
		}
	}
	public function getOnearticle(){
		if(IS_AJAX){
			$articles = D('Article');
			$this->ajaxReturn($articles->getOnearticle(I('post.a_id')));
		}		
	}
	public function updateArticle(){
		if(IS_AJAX){
            $article = D('Article');
            $aid = $article->updateArticle(I('post.id'),I('post.title'),I('post.intro'),I('post.cate'),I('post.author'),I('post.create_time'),I('post.content'));
            echo $aid;
		}
	}
}