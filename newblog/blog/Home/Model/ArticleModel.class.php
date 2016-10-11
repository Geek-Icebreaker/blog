<?php
namespace Home\Model;

use Think\Model;

class ArticleModel extends Model
{
    /**
     * getarticles 获取所有文章
     * access public
     * @return array
     */
    public function getarticles($cate)
    {
		if(isset($cate)){
			$count = $this->where('cate_id=%d',$cate)->count();
			$Page = new \Think\Page($count, 8); //实例化分页类 传入总记录数和每页显示的记录数
			$Page->setConfig('first', '首页');
			$Page->setConfig('prev', '上一页');
			$Page->setConfig('next', '下一页');
			$Page->setConfig('end', '尾页');
			$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
			$Page->setConfig('header', '总记录数：%TOTAL_ROW%条');
			
			$pageshow = $Page->show();  //分页显示输出
			
			$articles = $this->table('blog_article ba')
				->join('blog_article_cate bac on ba.cate_id = bac.cate_id', 'left')
				->field('a_id,a_title,a_intro,a_views,a_comments,create_time,bac.cate_name')
				->order('create_time desc')
				->where('bac.cate_id=%d', $cate)
				->limit($Page->firstRow . ',' . $Page->listRows)
				->select();
			$comments = D('Home/Comment');
			foreach ($articles as $key => $value) {
				$articles[$key]['create_time'] = date('Y-m-d H:i:s', $articles[$key]['create_time']);
				$articles[$key]['commentCounts'] = $comments->where('aid=%d',$articles[$key]['a_id'])->count();
			}
			return array($articles, $pageshow);			
		}else{
			$count = $this->count();
			$Page = new \Think\Page($count, 8); //实例化分页类 传入总记录数和每页显示的记录数
			$Page->setConfig('first', '首页');
			$Page->setConfig('prev', '上一页');
			$Page->setConfig('next', '下一页');
			$Page->setConfig('end', '尾页');
			$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
			$Page->setConfig('header', '总记录数：%TOTAL_ROW%条');


			$pageshow = $Page->show();  //分页显示输出
			
			$articles = $this->table('blog_article ba')
				->join('blog_article_cate bac on ba.cate_id = bac.cate_id', 'left')
				->field('a_id,a_title,a_intro,a_views,create_time,bac.cate_name')
				->order('create_time desc')
				->limit($Page->firstRow . ',' . $Page->listRows)
				->select();
			$comments = D('Home/Comment');
			foreach ($articles as $key => $value) {
				$articles[$key]['create_time'] = date('Y-m-d H:i:s', $articles[$key]['create_time']);
				$articles[$key]['commentCounts'] = $comments->where('aid=%d',$articles[$key]['a_id'])->count();
			}
	
			return array($articles,$pageshow);			
		}

    }

    /**
     * getOnearticle 获取单条文章
     * @param int $a_id 文章id
     * @return array
     */
    public function getOnearticle($a_id)
    {
		$this->where('a_id=%d',$a_id)->setInc('a_views');
        $articles = $this->table('blog_article ba')
            ->join('blog_article_cate bac on ba.cate_id = bac.cate_id', 'left')
            ->join('blog_admin on ba.a_author = blog_admin.id', 'left')
            ->field('ba.a_id,ba.a_title,ba.a_content,ba.a_views,ba.a_type,blog_admin.name,bac.cate_name,ba.create_time')
            ->order('create_time desc')
            ->where('a_id=%d', $a_id)
            ->select();
		
        foreach ($articles as $key => $value) {
            $articles[$key]['a_content'] = htmlspecialchars_decode($articles[$key]['a_content']);
            $articles[$key]['create_time'] = date('Y-m-d H:i:s', $articles[$key]['create_time']);
			
		}
		return $articles;
    }
	public function getHotArticle(){
		$articles = $this->table('blog_article ba')
			->join('blog_article_cate bac on ba.cate_id = bac.cate_id', 'left')
			->field('ba.a_id,ba.a_title,ba.a_views,ba.create_time,bac.cate_name')
			->order('a_views desc')
			->limit(0,4)
			->select();
		foreach ($articles as $key => $value) {
			$articles[$key]['create_time'] = date('Y-m-d H:i:s', $articles[$key]['create_time']);
		}
		
		return $articles;					
	}
}


?>