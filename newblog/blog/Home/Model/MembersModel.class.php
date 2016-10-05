<?php 
namespace Home\Model;
use Think\Model;
class MembersModel extends Model{
	protected $_validate = array(
	   // array('m_name','require',0,self::MUST_VALIDATE,'unique',self::MODEL_INSERT), 
		array('m_name','','0',0,'unique',1), 
	    array('m_name','checkName',-1,self::MUST_VALIDATE,'callback',self::MODEL_INSERT,array(4,20)),
		array('password','checkPass',-2,self::MUST_VALIDATE,'callback',self::MODEL_INSERT,array(4,20)),
		array('qq','/^[1-9]\d{4,12}$/',-3,self::MUST_VALIDATE,'regex',self::MODEL_INSERT),
	);
	protected function checkName($m_name,$min,$max){
		if(iconv_strlen($m_name,'UTF-8') < $min || iconv_strlen($m_name,'UTF-8') > $max)
			return false;
		else
			return true;
	}
	protected function checkPass($password,$min,$max){
		if(iconv_strlen($password,'UTF-8') < $min || iconv_strlen($password,'UTF-8') > $max)
			return false;
		else
			return true;
	}
	
	function my_sort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC ){   
        if(is_array($arrays)){   
            foreach ($arrays as $array){   
                if(is_array($array)){   
                    $key_arrays[] = $array[$sort_key];   
                }else{   
                    return false;   
                }   
            }   
        }else{   
            return false;   
        }  
        array_multisort($key_arrays,$sort_order,$sort_type,$arrays);   
        return $arrays;   
    }
	
	public function addMember($name,$password,$qq){
		$map['m_name'] = $name;
		$map['password'] = $password;
		$map['qq'] = $qq;
		$map['reg_time'] = time();
		if(!$this->create($map)){
			return $this->getError();
		}else{
			$data['m_name'] = $name;
			$data['password'] = md5($password);
			$data['qq'] = $qq;
			$data['reg_time'] = time();			
			$uid = $this->data($data)->add();
			return $uid;
		}
	}
	public function getReaders(){
		$readers = $this->field('id,m_name,faceSrc')->select();
		$arr = array();
		foreach($readers as $key=>$value){
			$comment = D('Comment');
			
			$readers[$key]['counts'] = count($comment->where('mid=%d',$readers[$key]['id'])->field('id')->select());
		}   
		$newReaders = $this->my_sort($readers,'counts',SORT_DESC,SORT_STRING);
		foreach($newReaders as $key=>$value){
			switch ($key){
				case 0:
					$newReaders[$key]['sid'] = 1;
					break;
				case 1:
					$newReaders[$key]['sid'] = 2;
					break;
				case 2:
					$newReaders[$key]['sid'] = 3;
					break;
				default:
					$newReaders[$key]['sid'] = 4;
			}
		}
		return $newReaders;
		
	}
	public function modify($id,$name,$qq,$email){
		$data['id'] = $id;
		$data['m_name'] = $name;
		$data['qq'] = $qq;
		$data['email'] = $email;
		return $this->save($data);
	}
	public function modifyPass($id,$password){
		$data['id'] = $id;
		$data['password'] = md5($password);
		return $this->save($data);
	}
}



?>