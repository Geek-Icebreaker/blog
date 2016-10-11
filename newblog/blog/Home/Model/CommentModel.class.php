<?php
namespace Home\Model;
use Think\Model;
class CommentModel extends Model
{
    /**
     * @param $aid  评论的文章ID
     * @param $mid  评论文章的用户ID
     * @param $comment  评论的文章内容
     * @return mixed|string
     */
    public function articleComment($aid, $mid, $comment)
    {
        $map['aid'] = $aid;
        $map['mid'] = $mid;
        $map['comment'] = $comment;
        $map['comment_time'] = time();
        if (!$this->create($map)) {
            return $this->getError();
        } else {
            $cid = $this->add();
			return $cid;
		}
    }
    public function delComment($id){
        $did = $this->where('id=%d',$id)->delete();
        if($did > 0){
            return $did;
        }
    }

    /**
     * @param $str  评论的内容 表情替换成路径
     */
    public function ubbReplace($str) {
        $str = str_replace ( ">", '<;', $str );
        $str = str_replace ( ">", '>;', $str );
        $str = str_replace ( "\n", '>;br/>;', $str );
        $str = preg_replace ( "[\[em_([0-9]*)\]]", '<img src="'.__ROOT__.'/Public/Home/images/arclist/$1.gif"/>', $str );
        return $str;
    }
    /**
     * @param $aid 获取的单条文章ID
     * @return mixed
     */
    public function getCommentList($aid)
    {
        $count = $this->where('aid=%d',$aid)->count();
        $Page = new \Think\Page($count, 15); //实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('first', '首页');
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('end', '尾页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->setConfig('header', '总记录数：%TOTAL_ROW%条');
        $pageshow = $Page->show();

        $comments = $this->table('blog_comment bc')
            ->join('blog_members bm on bm.id = bc.mid', 'left')
            ->field('bc.id,bc.aid,bc.comment,bc.mid,bc.comment_time,bm.m_name,bm.faceSrc')
            ->order('bc.comment_time desc')
            ->where('aid=%d', $aid)
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        foreach ($comments as $key => $value) {
            $comments[$key]['comment'] = $this->ubbReplace(htmlspecialchars_decode($comments[$key]['comment']));
            $comments[$key]['comment_time'] = date('Y-m-d H:i:s', $comments[$key]['comment_time']);
        }
		$commentCounts = $this->where('aid=%d',$aid)->count(); //获取当前文章评论数
        return array($comments,$pageshow,$commentCounts);
    }
}


?>