<?php 
namespace Admin\Model;
use Think\Model;

class ArticleCateModel extends Model{
		public function getcate(){
		return $this->field('cate_id,cate_name')->select();
	}
}



?>