<?php 
namespace Admin\Model;
use Think\Model;
class LinksModel extends Model{
	public function getLinks($page,$rows,$sort,$order){
		$links = $this->field('id,name,url,time,status')
		->order(array($sort=>$order))
		->limit($rows * ($page-1),$rows)
		->select();
		foreach($links as $key=>$value){
			$links[$key]['time'] = date('Y-m-d H:i:s',$links[$key]['time']);
		}
		return array(
			'sql'=>$this->getLastSql(),
			'total'=>$this->count(),
			'rows'=>$links
		);
	}
	public function getOneLink($id){
		$link = $this->where('id=%d',$id)->find();
		$link['time'] = date('Y-m-d H:i:s',$link['time']);
		return $link;
	}
	public function updateLink($id,$name,$url,$date){
		$data['id'] = $id;
		$data['name'] = $name;
		$data['url'] = $url;
		$data['time'] = strtotime($date);
		$lid = $this->save($data);
		return $lid ? $lid : 0;
	}
	public function addLink($name,$url,$date){
		$data['name'] = $name;
		$data['url'] = $url;
		$data['time'] = strtotime($date);
		$lid = $this->add($data);
		return $lid ? $lid : 0;
	}
	public function remove($ids){
		return $this->delete($ids);
	}
}



?>