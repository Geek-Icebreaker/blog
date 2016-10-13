<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: joychi <757256172@qq.com> <http://www.ice-breaker.cn>
// +----------------------------------------------------------------------
namespace Think;
class UploadFile {
		private $upload_name;       //upload name
		private $upload_tmp_name;   //upload tmp name
		private $upload_finally_name;  
		private $upload_extension;  //file extension
		private $allow_uploadedfile_type;   //file type
		private $save_pth;          //file save path
		private $israndname;        //is rand?
		private $upload_size;       //upload file size
		private $allow_uploadfile_size = 100000; //allow upload file size
		private $error;

    public function __construct($FILES){
		$this->upload_name = $FILES['file']['name'];
        $this->upload_tmp_name = $FILES['file']['tmp_name'];
        $this->upload_size = $FILES['file']['size'];
		$this->error = $FILES['file']['error'];
        $this->allow_uploadedfile_type = array('.jpg','.png','.gif','.txt','.mp4','.swf');
        $this->save_path = './';
        $this->israndname = 1;
    }
	public function upload(){
		if($this->error > 0){
			echo 0;
		}else{
			$this->upload_extension = $this->checkExt($this->upload_name);
			if(!in_array($this->upload_extension,$this->allow_uploadedfile_type)){
				echo 2;  
			}else{
				if($this->israndname){
					$this->upload_finally_name = date("ymdhis").rand(1,100).$this->upload_extension;
				}else{
					$this->upload_finally_name = $this->upload_name;
				}
				if(!move_uploaded_file($this->upload_tmp_name,$this->save_path.$this->upload_finally_name)){
					echo 3;
				}else{
					echo trim($this->upload_finally_name);
				}
			}
		}	
	}	
	private function checkExt($file_name){
       return strrchr($file_name, '.');
	}
	public function test(){
		echo 'test';
	}
}
