<?php
namespace Home\Controller;
use Think\Controller;
class FrontController extends Controller {
	public function index(){
        A('Common')->showPage('1','Front/index');
	}
}