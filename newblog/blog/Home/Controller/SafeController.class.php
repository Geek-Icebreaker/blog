<?php
namespace Home\Controller;
use Think\Controller;
class SafeController extends Controller {
	public function index(){
       A('Common')->showPage('3','Safe/index');
	}
}