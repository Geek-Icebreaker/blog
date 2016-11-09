<?php 
namespace Admin\Model;
use Think\Model;
class ArticleModel extends Model{
	/*
	 * 	self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
		self::MUST_VALIDATE 或者1 必须验证
		self::VALUE_VALIDATE或者2 值不为空的时候验证
	 * */

	public function getarticles($page,$rows,$sort,$order){
		$articles = $this->table('blog_article ba')
		->join('blog_article_cate bac on ba.cate_id = bac.cate_id','left')
		->join('blog_admin on ba.a_author = blog_admin.id')
		->field('ba.a_id,ba.a_title,ba.a_content,ba.a_views,ba.a_type,blog_admin.name,bac.cate_name,ba.create_time')
		->order(array($sort=>$order))
		->limit($rows * ($page-1),$rows)
		->select();
		foreach($articles as $key=>$value){
			$articles[$key]['create_time'] = date('Y-m-d H:i:s',$articles[$key]['create_time']);
		}
		return array(
			'sql'=>$this->getLastSql(),
			'total'=>$this->count(),
			'rows'=>$articles
		);
	}
	public function addarticle($title,$intro,$cate,$author,$create_time,$content){
		$data['a_title'] = $title;
		$data['a_intro'] = $intro;
		$data['cate_id'] = $cate;
		$data['a_author'] = $author;
		$data['create_time'] = strtotime($create_time);
		$data['a_content'] = $content;
		if(!$this->create($data)){
			return $this->getError();
		}else{
			$uid = $this->add();
			return $uid;
		}
	}
	public function remove($ids){
		return $this->delete($ids);
	}
	public function edit($ids){
		
	}
	public function getOnearticle($a_id){
		$articles = $this->table('blog_article ba')
		->join('blog_article_cate bac on ba.cate_id = bac.cate_id','left')
		->join('blog_admin on ba.a_author = blog_admin.id','left')
		->join('blog_comment bc on ba.a_id = bc.aid','left')
		->field('ba.a_id,ba.a_title,ba.a_intro,ba.a_content,ba.a_views,blog_admin.name,bac.cate_name,ba.create_time,bc.comment,bc.comment_time')
		->order('create_time desc')
		->where('a_id=%d',$a_id)
		->select();
		foreach($articles as $key=>$value){
			$articles[$key]['a_content'] =  htmlspecialchars_decode($articles[$key]['a_content']);
			$articles[$key]['create_time'] = date('Y-m-d H:i:s',$articles[$key]['create_time']);
		}
		return $articles[0];
	}
	public function updateArticle($id,$title,$thumbnail,$intro,$cate,$author,$create_time,$content){
	    $data['a_title'] = $title;
		$data['a_intro'] = $intro;
		$data['a_thumbnail'] = $thumbnail;
        $data['cate_id'] = $cate;
        $data['a_author'] = $author;
        $data['create_time'] = strtotime($create_time);
        $data['a_content'] = $content;
        if(!$this->create($data)){
            return $this->getError();
        }else{
            $uid = $this->where('a_id=%d',$id)->save();
            return $uid;
        }
    }
}



?>