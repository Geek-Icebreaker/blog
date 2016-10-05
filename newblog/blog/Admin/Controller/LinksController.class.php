<?php
namespace Admin\Controller;
use Think\Controller;
class LinksController extends Controller {
    public function index(){
		$this->display();
	}
	public function getLinks(){
		if(IS_AJAX){
			$links = D('Links');
			$this->ajaxReturn(
				$links->getLinks(			
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
	public function getOneLink(){
		if(IS_AJAX){
			$links = D('Links');
			$this->ajaxReturn(
				$links->getOneLink(I('post.id'))
			);
		}
	}
	public function updateLink(){
		if(IS_AJAX){
			$links = D('Links');
			$links->updateLink(I('post.id'),I('post.name'),I('post.url'),I('post.date'));
		}
	}
	public function add(){
		if(IS_AJAX){
			$links = D('Links');
			echo $links->addLink(I('post.name'),I('post.url'),I('post.date'));
		}		
	}
	public function remove(){
		if(IS_AJAX){
			$links = D('Links');
			echo $links->remove(I('post.ids'));
		}
	}
}