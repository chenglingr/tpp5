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

	public function getLoginUser(){
		if(!$this->account)
		{

			$this->account=session('Account','','admin');
		}
		return $this->account;
	}
}