<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
	public function logout(){
		session('name',null);
		header('Location: http://www.ice-breaker.cn/');
	}
	public function isOnline(){
        if(!session('?name')){
            echo 0;
        }else{
            echo 1;
        }
    }
	public function frontUser(){
		if (session('name')) {
            $this->assign('name', session('name'));
        } else {
            $this->assign('name', '');
        }
	}
	public function getHotArticle(){
		$article = D('Home/Article');
		return $article->getHotArticle();
	}
	//获取访问用户配置信息
	public function getRemoteInfo(){
		$arr['ip'] = $this->getIp();
		$arr['os'] = $this->getOS();
		
		return $arr;
	}
	private function getIp(){
		$realip;
		if(isset($_SERVER)){
			if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
				$realip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}else if(isset($_SERVER['HTTP_CLIENT_IP'])){
				$realip=$_SERVER['HTTP_CLIENT_IP'];
			}else{
				$realip=$_SERVER['REMOTE_ADDR'];
			}
		}else{
			if(getenv('HTTP_X_FORWARDED_FOR')){
				$realip=getenv('HTTP_X_FORWARDED_FOR');
			}else if(getenv('HTTP_CLIENT_IP')){
				$realip=getenv('HTTP_CLIENT_IP');
			}else{
				$realip=getenv('REMOTE_ADDR');
			}
		}
		return $realip;
	}
	private function getOS(){ 
		$os=''; 
		$Agent=$_SERVER['HTTP_USER_AGENT']; 
		if (eregi('win',$Agent)&&strpos($Agent, '95')){ 
			$os='Windows 95'; 
		}elseif(eregi('win 9x',$Agent)&&strpos($Agent, '4.90')){ 
			$os='Windows ME'; 
		}elseif(eregi('win',$Agent)&&ereg('98',$Agent)){ 
			$os='Windows 98'; 
		}elseif(eregi('win',$Agent)&&eregi('nt 5.0',$Agent)){ 
			$os='Windows 2000'; 
		}elseif(eregi('win',$Agent)&&eregi('nt 6.0',$Agent)){ 
			$os='Windows Vista'; 
		}elseif(eregi('win',$Agent)&&eregi('nt 6.1',$Agent)){ 
			$os='Windows 7'; 
		}elseif(eregi('win',$Agent)&&eregi('nt 5.1',$Agent)){ 
			$os='Windows XP'; 
		}elseif(eregi('win',$Agent)&&eregi('nt',$Agent)){ 
			$os='Windows NT'; 
		}elseif(eregi('win',$Agent)&&ereg('32',$Agent)){ 
			$os='Windows 32'; 
		}elseif(eregi('linux',$Agent)){ 
			$os='Linux'; 
		}elseif(eregi('unix',$Agent)){ 
			$os='Unix'; 
		}else if(eregi('sun',$Agent)&&eregi('os',$Agent)){ 
			$os='SunOS'; 
		}elseif(eregi('ibm',$Agent)&&eregi('os',$Agent)){ 
			$os='IBM OS/2'; 
		}elseif(eregi('Mac',$Agent)&&eregi('PC',$Agent)){ 
			$os='Macintosh'; 
		}elseif(eregi('PowerPC',$Agent)){ 
			$os='PowerPC'; 
		}elseif(eregi('AIX',$Agent)){ 
			$os='AIX'; 
		}elseif(eregi('HPUX',$Agent)){ 
			$os='HPUX'; 
		}elseif(eregi('NetBSD',$Agent)){ 
			$os='NetBSD'; 
		}elseif(eregi('BSD',$Agent)){ 
			$os='BSD'; 
		}elseif(ereg('OSF1',$Agent)){ 
			$os='OSF1'; 
		}elseif(ereg('IRIX',$Agent)){ 
			$os='IRIX'; 
		}elseif(eregi('FreeBSD',$Agent)){ 
			$os='FreeBSD'; 
		}elseif($os==''){ 
			$os='Unknown'; 
		} 
		return $os; 
	}
	private function ipFrom(){
		
	}
}