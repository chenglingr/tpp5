<?php
namespace app\admin\controller;
use think\Controller;

class Student extends Base{
	public function index($id=0){

		$departs=config('depart.depart_name');
		$grades=model('Grade')->getAllGradeByStatus(1);

		$this->assign('departs',$departs);

		//$this->assign('grades', $grades);


		if(intval($id)){
			
    		$students=model('Student')->getStudentByGradeID($id,1);

			return $this->fetch('',[
				'students'=>$students,
				
			]);
    	}
		/*if (request()->isGet()){
			$id=input('get.id');

			echo $id.'eee';
			if(!empty($id)){
				$students=model('Student')->getStudentByGradeID($id,1);
				return $this->fetch('',['students'=>$students]);
			}

		}*/

		if(request()->isPost()){
           //入库逻辑
            $data=input('post.');
			$id=$data['grade_id'];
			$students=model('Student')->getStudentByGradeID($id,1);

			return $this->fetch('',[
				'students'=>$students,
				
			]);
		}
			
		return $this->fetch('',[
			'students'=>[],
			
		]);
	

	}
	public function add(){

		$departs=config('depart.depart_name');
		//$grades=model('Grade')->getAllGradeByStatus(1);
		return $this->fetch('',['departs'=>$departs]);
		//return $this->fetch('',['departs'=>$departs,'grades'=>$grades]);
	}
	public function addlist(){
		return $this->fetch();
/*		$user = new User;
$list = [
    ['name'=>'thinkphp','email'=>'thinkphp@qq.com'],
    ['name'=>'onethink','email'=>'onethink@qq.com']
];
$user->saveAll($list);*/
	}
	public function save(){
		if(!request()->post()){
			$this->error('请求错误');
		}
		$data=input('post.');
		
		$validate=validate('Student');
		if(!$validate->scene('add')->check($data))
		{
			$this->error($validate->getError());
		}

			//判定提交的用户是否存在
		$accountResult=Model('Student')->get(['num'=>$data['num']]);
		if($accountResult){
			$this->error('该用同学已存在，请重新分配学号');
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
			'major'=>$data['major'],
			'grade_id'=>$data['grade_id'],
		];
		$accountID=model('Student')->add($accountData);
		if(!$accountID){
			$this->error('添加失败');
		}
		$this->success("添加成功",url('student/index',['id'=>$data['grade_id']]));
		//$this->success("申请成功",url('register/waiting',['id'=>$bisId]));
	}

}