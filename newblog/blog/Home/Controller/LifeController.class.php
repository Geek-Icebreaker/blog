<?php
namespace Home\Controller;
use Think\Controller;
class LifeController extends Controller {
	public function index(){
        A('Common')->showPage('5','Life/index');
	}
}