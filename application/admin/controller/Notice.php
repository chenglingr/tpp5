<?php
namespace app\admin\controller;
use think\Controller;

class Notice extends Base{
	public function index(){
		$notices=model('Notice')->getNoticeByStatus(1);

		return $this->fetch('',['notices'=>$notices]);
	}
	public function add(){

		return $this->fetch('add');
	}
	public function save(){
		if(!request()->post()){
			$this->error('请求错误');
		}
		$data=input('post.');
		//获取管理员id
		//echo $data['content'];exit;
		$user=$this->getLoginUser();
		if($user&&$user->id){
			$data['admin_id']=$user->id;
		}
		else{
			$this->error('请先登陆',url('login/index'));
		}

		if($this->getUserType()!='管理员'){
			$this->error('请先退出，再以管理员身份登陆',url('notice/index'));
		}

		$validate=validate('Notice');
		if(!$validate->scene('add')->check($data))
		{
			$this->error($validate->getError());
		}

			//判定提交的用户是否存在
		$accountResult=Model('Admin')->get(['id'=>$data['admin_id']]);
		if(!$accountResult){
			$this->error('请先登录');
		}

		//账户相关信息校验
		//自动生成 密码的加密字符串
		
		
		$noticeData=[
			'name'=>$data['name'],
			'content'=>$data['content'],
		
			'admin_id'=>$data['admin_id'],
		
		];
		$noticeID=model('Notice')->add($noticeData);
		if(!$noticeID){
			$this->error('添加失败');
		}
		$this->success("添加成功",url('notice/index'));
		//$this->success("申请成功",url('register/waiting',['id'=>$bisId]));
	}

}