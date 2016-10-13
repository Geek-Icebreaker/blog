<?php
namespace Home\Controller;
use Think\Controller;
class BackController extends Controller {
	public function index(){
       A('Common')->showPage('2','Back/index');
	}
}