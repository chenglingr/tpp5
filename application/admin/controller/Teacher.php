<?php
namespace app\admin\controller;
use think\Controller;

class Teacher extends Base{

public function main(){
	return 'teacher';
}
	public function index(){
		$teachers=model('Teacher')-> getTeacherByStatus(1);

		return $this->fetch('',['teachers'=>$teachers]);
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
		
		$validate=validate('Teacher');
		if(!$validate->scene('add')->check($data))
		{
			$this->error($validate->getError());
		}

			//判定提交的用户是否存在
		$accountResult=Model('Teacher')->get(['num'=>$data['num']]);
		if($accountResult){
			$this->error('该用户工号已存在，请重新分配');
		}

		//账户相关信息校验
		//自动生成 密码的加密字符串
		$data['code']=mt_rand(100,10000);
		$accountData=[
			'num'=>$data['num'],
			'username'=>$data['username'],
			'code'=>$data['code'],
			'password'=>md5($data['password'].$data['code']),
			'tel'=>$data['tel'],
			'email'=>$data['email'],
			'depart'=>$data['depart'],
		];
		$accountID=model('Teacher')->add($accountData);
		if(!$accountID){
			$this->error('添加失败');
		}
		$this->success("添加成功",url('teacher/index'));
		//$this->success("申请成功",url('register/waiting',['id'=>$bisId]));
	}
}