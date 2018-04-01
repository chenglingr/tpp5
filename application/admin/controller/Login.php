<?php
namespace app\admin\controller;
use think\Controller;
class Login extends Controller
{
	public function index()
	{
		
		if(request()->post()){
			//登录逻辑
			//获取相关信息
			$data=input('post.');
            $usertype=$data['usertype'];
            if($usertype=="0"){
	            //校验输入
				$ret=model('admin')->get(['num'=>$data['num']]);
	           
				if(!$ret||$ret->status!=1){
					$this->error('用户不存在或未经审核');
				}
				if($ret->password!=md5($data['password'].$ret->code))
				{
					$this->error('密码不正确');
				}
							
				//admin是作用域
				session('Account',$ret,'admin');
				session('AccountType',0,'admin');
				return $this->success('登陆成功',url('admin/index'));//管理员zhuye
            }
            if($usertype=="1"){
	            //校验输入
				$ret=model('teacher')->get(['num'=>$data['num']]);
	           
				if(!$ret||$ret->status!=1){
					$this->error('用户不存在或未经审核');
				}
				if($ret->password!=md5($data['password'].$ret->code))
				{
					$this->error('密码不正确');
				}
							
				//admin是作用域
				session('Account',$ret,'admin');
				session('AccountType',1,'admin');
				return $this->success('登陆成功',url('homework/index'));//教师zhuye
            }
            if($usertype=="2"){
	            //校验输入
				$ret=model('student')->get(['num'=>$data['num']]);
	           
				if(!$ret||$ret->status!=1){
					$this->error('用户不存在或未经审核');
				}
				if($ret->password!=md5($data['password'].$ret->code))
				{
					$this->error('密码不正确');
				}
							
				//admin是作用域
				session('Account',$ret,'admin');
				session('AccountType',2,'admin');
				return $this->success('登陆成功',url('index/index'));//学生zhuye
            }

		}else{
			//获取session
			$account=session('Account','','admin');
            $accountType=session('AccountType','','admin');
			if($account&&$account->id&&$accountType){
				if( $accountType==0) {return $this->redirect('admin/index');}//管理员主页
				if( $accountType==1) {return $this->redirect('homework/index');}//教师主页
				if( $accountType==2) {return $this->redirect('index/index');}//学生主页
			}
		
			return $this->fetch();
		}
		
	}
	public function logout()
	{
		session(null,'admin');
		return $this->redirect('login/index');
	}
	
}