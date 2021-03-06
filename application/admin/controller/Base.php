<?php
namespace app\admin\controller;
use think\Controller;
class Base extends Controller
{
	private $account;
	public function _initialize()
	{
		//判断是否登录
		$isLogin=$this->isLogin();
		if(!$isLogin){
			//return $this->redirect(url('login/index'));

			$this->error('请先登录','login/index');
		}
		$accounttype=$this->getUserType();
		if($accounttype=='管理员'){$this->assign('menu','menu');}
		else{
			session(null,'admin');
			$this->error('请先用管理员账号登录','login/index');
		}
		$this->assign('user',$this->getLoginUser());
		
	//	return $isLogin;
	}
	public function isLogin()
	{
		$user=$this->getLoginUser();
		
		if($user&&$user->id){
			return true;
		}
		return false;
	}
   public function getUserType(){

 		 $usertype= session('AccountType','','admin');
 		 if(!isset($usertype)){return '匿名';}
 		 if($usertype==3){return '管理员';}
 		 if($usertype==1){return '教师';}
 		 if($usertype==2){return '学生';}
   }
	public function getLoginUser(){
		if(!$this->account)
		{

			$this->account=session('Account','','admin');
		}
		return $this->account;
	}
	//0 删除 1正常 2禁用
	public function status($id=0,$status=2){
		//获取数据
		/*$data=input('get.');
		if(empty($data['id'])){
	
			$this->error('id不合法');
		}
	
		if(!is_numeric($data['status'])){
			$this->error('status不合法');
		}*/
		if($id==0){
		    $this->error('id不合法');
		}
	
		if(!is_numeric($status)){
			$this->error('status不合法');
		}


		//利用tp5 校验
		//获取控制器
		$model=request()->controller();
		//超级管理员不可以被删
		
		if($model=="Admin"){
			$res=model($model)->save(['status'=>$status],['id'=>$id,'num'=>['<>','superadmin']]);
		}
		else{
		$res=model($model)->save(['status'=>$status],['id'=>$id]);}
		if($res){
			$this->success('更新成功');
		}
		else{
			$this->error('更新失败');
		}
	}
}