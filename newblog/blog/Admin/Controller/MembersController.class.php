<?php
namespace Admin\Controller;
use Think\Controller;
class MembersController extends Controller {
	public function index(){
		$this->display();
	}
	//初始化加载所有用户数据
	public function getmembers(){
		if(IS_AJAX){
			$members = D('Members');
			$this->ajaxReturn(
								$members->getmembers(
														I('post.page'),
														I('post.rows'),
														I('post.sort'),
														I('post.order'),
														I('post.username'),
														I('post.timeFrom'),
														I('post.timeTo')
													)
							);
		}else{
			$this->error('非法请求');
		}
	}
	//删除用户
	public function remove(){
		if(IS_AJAX){
			$members = D('Members');
			echo $members->remove(I('post.ids'));
		}
	}
	//添加用户数据
	public function add(){
		if(IS_AJAX){
			$members = D('Members');
			$mark = $members->addMember(I('post.name'),I('post.password'),I('post.email'),I('post.qq'),I('post.faceSrc'));
			//echo json_encode(($mark));
			if(is_array($mark)){
				$arr  = array_values($mark);
				echo $arr[0];				
			}else{
				echo $mark;
			}

			//$this->ajaxReturn($mark);
		}
	}
	public function getOneMember(){
		if(IS_AJAX){
			$members = D('Members');
			$this->ajaxReturn($members->getOneMember(I('post.id')));
		}
	}
	//修改会员数据
	public function updateMember(){
		if(IS_AJAX){
			$members = D('Members');
			echo $members->updateMember(I('post.id'),I('post.password'),I('post.email'),I('post.qq'));
		}else{
			$this->error('非法操作');
		}
	}
}