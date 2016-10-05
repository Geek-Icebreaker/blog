<?php 
namespace Admin\Model;
use Think\Model;

class AdminNavModel extends Model{
	public function getNav($id = 0){
		$map['nid'] = $id;
		return $this->where($map)->field('id,text,state,iconCls,url')->select();
	}
}



?>