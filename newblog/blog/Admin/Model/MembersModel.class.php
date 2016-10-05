<?php 
namespace Admin\Model;
use Think\Model;
class MembersModel extends Model{
	/*
	 * 	self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
		self::MUST_VALIDATE 或者1 必须验证
		self::VALUE_VALIDATE或者2 值不为空的时候验证
	 * */
	protected $patchValidate = true;
	protected $_validate = array(
		array('name','require','-1',0,'unique',self::MODEL_INSERT),//判断用户名是否存在
		array('name','/^\w{4,20}$/','-2',0,'regex'),
		array('password','/^\w{4,20}$/','-3',self::EXISTS_VALIDATE,'regex',self::MODEL_INSERT), //新增时的验证
		array('password','/^\w{4,20}$/','-4',self::VALUE_VALIDATE,'regex',self::MODEL_UPDATE), //编辑更新时的验证
		//array('password', '4,20', '-3', 0,'length'),
		array('email','/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/','-4',self::VALUE_VALIDATE,'regex'),
		array('qq','/^\d{4,12}$/','-5',self::VALUE_VALIDATE,'regex'),

		
		
	);
     protected $_auto = array ( 
        array('password','md5',3,'function') , // 对password字段在新增和编辑的时候使md5函数处理
    );
		 
	
	public function getmembers($page,$rows,$sort,$order,$username,$timeFrom,$timeTo){
		$map = array();
		if($username){
			$map['name'] = array('LIKE','%'.$username.'%');
		}
		if($timeFrom && $timeTo){
			$map['reg_time'] = array(
				array('EGT',strtotime($timeFrom)), //EGT 大于
				array('ELT',strtotime($timeFrom))  //ELT 小于
			);
		}else if($timeFrom){
			$map['reg_time'] = array('EGT',strtotime($timeFrom)); 
		}else if($timeTo){       
			$map['reg_time'] = array('ELT',strtotime($timeTo));
		}
		$members = $this->field('id,m_name,email,qq,reg_time,login_time,login_ip')
		->where($map)
		->order(array($sort=>$order))
		->limit($rows * ($page-1),$rows)
		->select();
		foreach($members as $key=>$value){
			$members[$key]['login_time'] = date('Y-m-d H:i:s',$members[$key]['login_time']);
			$members[$key]['reg_time'] = date('Y-m-d H:i:s',$members[$key]['reg_time']);
		}
		
		return array(
			'sql'=>$this->getLastSql(),
			'total'=>$this->where($map)->count(),
			'rows'=>$members
		);
	}
	//delete members
	public function remove($members){
		return $this->delete($members);
	}
	//add memebers
	public function addMember($name,$password,$email,$qq,$faceSrc){
		$data['name'] = $name;
		$data['password'] = $password;
		$data['faceSrc'] = $faceSrc;
		if($email){
			$data['email'] = $email;
		}
		if($qq){
			$data['qq'] = $qq;
		}

		if(!$this->create($data)){
			return $this->getError();
		}else{
			$uid = $this->add();
			return $uid;
		}
	}
	public function getOneMember($id){
		$map['id'] = $id;
		return $this->field('id,m_name,password,email,qq')->where($map)->find();
	}
	public function updateMember($id,$password,$email,$qq){
		$data['id'] = $id;
		if(!empty($password)){
			$data['password'] = $password;
		}
		$data['email'] = $email;
		$data['qq'] = $qq;
		if($this->create($data)){
			$uid = $this->save();
			return $uid ? $uid : 0;
		}else{
			return $this->getError();
		}
		
	}
}



?>