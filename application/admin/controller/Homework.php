<?php
namespace app\admin\controller;
use think\Controller;

class HomeWork extends BaseTeacher{
	public function index(){
			return $this->fetch();
	}
	public function add(){
		return $this->fetch();
	}
	public function save(){
		
	}
	public function filelist(){
		return $this->fetch();
	}

	
	public function  getMyfile(){
		 //要调用extend/elfinder/connector.php
	}
}