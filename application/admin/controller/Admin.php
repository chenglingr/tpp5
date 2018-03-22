<?php
namespace app\admin\controller;
use think\Controller;

class Admin extends Base{
	/*private $obj;
	public function _initialize(){
		$this->obj=model("Admin");
	}
*/
	public function index(){
		$admins=model('Admin')-> getAdminByStatus(1);
	//	$this->assign('user',$this->getLoginUser());
//$this->assign('admins',$admins);
		return $this->fetch('',['admins'=>$admins]);
	}
	public function list(){
		$admins=model('Admin')-> getAdminByStatus(0);

	
       return $this->fetch('',['admins'=>$admins]);		
	}
	public function add(){
		return $this->fetch();
	}
	public function save(){
		if(!request()->post()){
			$this->error('请求错误');
		}
		$data=input('post.');
		
		$validate=validate('Admin');
		if(!$validate->scene('add')->check($data))
		{
			$this->error($validate->getError());
		}

			//判定提交的用户是否存在
		$accountResult=Model('Admin')->get(['num'=>$data['num']]);
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
		];
		$accountID=model('Admin')->add($accountData);
		if(!$accountID){
			$this->error('添加失败');
		}
		$this->success("添加成功",url('admin/index'));
		//$this->success("申请成功",url('register/waiting',['id'=>$bisId]));
	}
	/*public function waiting($id){
		if(empty($id)){
			$this->error('error');
		}
		$detail=model('Bis')->get($id);

		return $this->fetch('',['detail'=>$detail,]);
	}*/
}