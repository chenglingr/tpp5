<?php
namespace app\index\controller;
use think\Controller;


class TeacherController extends Controller{

	public function index()
	{
     
		$teachers=model('teacher')->select();
		return $this->fetch('',['teachers'=>$teachers]);
	}
	public function add()
	{
		$this->assign('name','lisi');
		$this->assign('age',20);
		 return $this->fetch();
	}

}