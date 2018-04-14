<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
	private $account;
	public function _initialize()
	{
		//判断是否登录
		
		$user=$this->getLoginUser();
		/*if($user&&$user->id){
			$this->assign('user',$user);
		}*/
		$this->assign('user',$user);
	}
	
	public function getLoginUser(){
		if(!$this->account)
		{

			$this->account=session('Account','','admin');
		}
		return $this->account;
	}
	
}