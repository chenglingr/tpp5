<?php
namespace app\admin\controller;
use think\Controller;

class Grade extends Base{
		public function index(){

	
		$grades=model('Grade')-> getGradeByStatus(1);
		return $this->fetch('',['grades'=>$grades]);
	}

	public function add(){

		$departs=config('depart.depart_name');

		return $this->fetch('',['departs'=>$departs]);
	}
	public function save(){
		if(!request()->post()){
			$this->error('请求错误');
		}
		$data=input('post.');
		
		$validate=validate('Grade');
		if(!$validate->scene('add')->check($data))
		{
			$this->error($validate->getError());
		}

			//判定提交的用户是否存在
		$accountResult=Model('Grade')->get(['name'=>$data['name']]);
		if($accountResult){
			$this->error('该用班级已存在，请重新分配');
		}

		//账户相关信息校验
	
		$gradeData=[		
			'name'=>$data['name'],			
			'depart'=>$data['depart'],
		];
		$gradeID=model('Grade')->add($gradeData);
		if(!$gradeID){
			$this->error('添加失败');
		}
		$this->success("添加成功",url('grade/index'));
		//$this->success("申请成功",url('register/waiting',['id'=>$bisId]));
	}
}