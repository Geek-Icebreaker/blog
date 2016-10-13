<?php
namespace Home\Controller;
use Think\Controller;
class CategoryController extends Controller {
	public function index(){
       A('Common')->showPage('4','Category/index');
	}
}