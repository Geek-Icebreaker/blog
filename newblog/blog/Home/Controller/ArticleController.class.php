<?php
namespace Home\Controller;

use Think\Controller;

class ArticleController extends Controller
{
    public function index()
    {	
		
		if (session('name')) {
            $this->assign('userId', session('id'));
            $this->assign('name', session('name'));
        } else {
            $this->assign('userId', '');
            $this->assign('name', '');
        }
        if (IS_GET) {
            $a_id = I('get.a_id');
			$article = D('Home/Article');
            $articleList = $article->getOnearticle($a_id);
			//print_r($articleListArr);
            //获取当前文章对应的评论
            $comments = D('Home/Comment');
			$commentList = $comments->getCommentList($a_id);
			$count = A('Common')->infoCount();
			
			$this->assign('articleList', $articleList);
			$this->assign('commentList', $commentList[0]);
            $this->assign('pageShow', $commentList[1]);
			$this->assign('commentCounts', $commentList[2]);
			$this->assign('count',$count);
            $this->display();
        }
    }

    public function comment()
    {
        if (IS_POST) {
            $comments = D('Home/Comment');
            $cid = $comments->articleComment(I('post.aid'), I('post.mid'), I('post.comment'));
			$aid = I('post.aid');
			
			$article = D('Article');
			$comment = D('Comment');
			$commentCounts = $comment->where('aid=%d',$aid)->count(); //获取当前文章评论数
			
			$article->where('a_id=%d',$aid)->setField('a_comments',$commentCounts);
			echo $article->getlastsql();
			echo $article->getDbError();
			echo $cid;
        }
    }
    public function delComment(){
        if(IS_POST){
            $comments = D('Home/Comment');
            $did = $comments->delComment(I('post.id'));
            echo $did;
        }
    }
	public function search(){
		if(IS_GET){
			$keyword = mb_convert_encoding(urldecode($_GET['keyword']), "UTF-8", "gb2312");
			$article = D('Home/Article');
			$articles = $article->search($keyword);
			$hotArticle = $article->getHotArticle(); //获取热门文章
			$remoteInfo = A('Base')->getRemoteInfo();
			
			$this->assign('articleList', $articles[0]); //文章列表
			$this->assign('pageshow', $articles[1]);	//分页
			$this->assign('hotArticle',$hotArticle);	//最热文章
			$this->assign('remoteInfo',$remoteInfo);	//访问用户信息
			$this->display('Index/index');
		}
	}
}