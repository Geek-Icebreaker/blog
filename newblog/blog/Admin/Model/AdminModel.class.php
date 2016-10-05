<?php 
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model{
	public function getAdmins(){
		return $this->field('id,name,login_time,login_ip')->select();
	}
}



?>