<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        if (session('name')) {
            $this->assign('name', session('name'));
        } else {
            $this->assign('name', '');
        }
        $articles = D('Home/Article');
		$count = A('Common')->infoCount();
        $arr = $articles->getarticles();
		
		$hotArticle = $articles->getHotArticle(); //获取热门文章
		$remoteInfo = A('Base')->getRemoteInfo();
		$this->assign('articleList', $arr[0]);
        $this->assign('pageshow', $arr[1]);
		$this->assign('hotArticle',$hotArticle);
		$this->assign('remoteInfo',$remoteInfo);
		$this->assign('count',$count);
        $this->display();
    }

    public function login()
    {
        if (IS_AJAX) {
            $map['m_name'] = I('post.name');
            $map['password'] = md5(I('post.password'));
            $members = M('Members');
            $data = $members->where($map)->find();
            if ($data['id']) {
                session('id', $data['id'], 'expire=7200', '/');
                session('name', $data['m_name'], 'expire=7200', '/');
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function reg()
    {
        if (IS_AJAX) {
            $members = D('Members');
            $res = $members->addMember(I('post.name'), I('post.password'), I('post.qq'));
			echo $res;
        }
    }

    public function checkUser($name)
    {
        $members = D('Members');
        if ($members->checkUser($name)) {
            return 1;   //存在返回1
        } else {
            return 2;  //不存在返回2
        }
    }

    public function getarticles()
    {
        if (IS_AJAX) {
            $articles = D('Home/Article');
            $articleList = $articles->getarticles();
            print_r($articleList);
            $this->assign('articleList', $articleList);
        }
    }
}