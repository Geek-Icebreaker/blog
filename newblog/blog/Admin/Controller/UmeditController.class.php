<?php
namespace Admin\Controller;
use Think\Controller;
class UmeditController extends Controller {

	public function upload(){
		date_default_timezone_set("Asia/chongqing");
		error_reporting(E_ERROR);
		header("Content-Type: text/html; charset=utf-8");
		$CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(__ROOT__/"Public/Admin/php/config.json")), true);
		   
		$action = I('get.action');
		switch ($action) {
		    case 'config':
		        $result =  json_encode($CONFIG);
		        break;
		
		    /* 上传图片 */
		    case 'uploadimage':
				echo 11111;
						        //$result = include("action_upload.php");
						        /*
		        $upload = new \Think\Upload();// 实例化上传类
			    $upload->maxSize   =     3145728 ;// 设置附件上传大小
			    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			    $upload->rootPath  =     __ROOT__.'/Uploads/'; // 设置附件上传根目录
			    $upload->savePath  =     ''; // 设置附件上传（子）目录
			    // 上传文件 
			    $info   =   $upload->upload();
			    if(!$info) {// 上传错误提示错误信息
			        $this->error($upload->getError());
			    }else{// 上传成功
			        //$this->success('上传成功！');
	                $arr = array(
	                    'state'=>'SUCCESS',
	                    'url'=>'http://'.$_SERVER['SERVER_NAME'].'/Uploads/'.$info['upfile']['savepath'].$info['upfile']['savename'],
	                    'title'=>$info['upfile']['savename'],
	                    'original'=>$info['upfile']['name'],
	                    'type'=>$info['upfile']['ext'],
	                    'size'=>$info['upfile']['size']
	                );
					$result =  json_encode($arr);
			    }*/
		    /* 上传涂鸦 */
		    	break;
		    case 'uploadscrawl':
		    /* 上传视频 */
		    	break;
		    case 'uploadvideo':
		    /* 上传文件 */
		    	break;
		    case 'uploadfile':
				echo 22222;
		        //$result = include("action_upload.php");
		        /*
		        $upload = new \Think\Upload();// 实例化上传类
			    $upload->maxSize   =     3145728 ;// 设置附件上传大小
			    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
			    $upload->savePath  =     ''; // 设置附件上传（子）目录
			    // 上传文件 
			    $info   =   $upload->upload();
			    if(!$info) {// 上传错误提示错误信息
			        $this->error($upload->getError());
			    }else{// 上传成功
			        //$this->success('上传成功！');
	                $arr = array(
	                    'state'=>'SUCCESS',
	                    'url'=>'http://'.$_SERVER['SERVER_NAME'].'/Uploads/'.$info['upfile']['savepath'].$info['upfile']['savename'],
	                    'title'=>$info['upfile']['savename'],
	                    'original'=>$info['upfile']['name'],
	                    'type'=>$info['upfile']['ext'],
	                    'size'=>$info['upfile']['size']
	                );
					$result =  json_encode($arr);
			    }*/
		        break;
		
		    /* 列出图片 */
		    case 'listimage':
		        //$result = include("action_list.php");
		        break;
		    /* 列出文件 */
		    case 'listfile':
		        //$result = include("action_list.php");
		        break;
		
		    /* 抓取远程文件 */
		    case 'catchimage':
		        //$result = include("action_crawler.php");
		        break;
		
		    default:
		        $result = json_encode(array(
		            'state'=> '请求地址出错'
		        ));
		        break;
		}
		
		/* 输出结果 */
		if (isset($_GET["callback"])) {
		    if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
		        echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
		    } else {
		        echo json_encode(array(
		            'state'=> 'callback参数不合法'
		        ));
		    }
		} else {
		    echo $result;
		}
	}
}