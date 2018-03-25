<?php
namespace app\admin\controller;
use think\Controller;

class Course extends Base{
	public function index($gradeid=0,$teacherid=0){

		$departs=config('depart.depart_name');
		$teachers=model('Teacher')->getAllTeacher();
		$this->assign('departs',$departs);
		$this->assign('teachers',$teachers);

		if($gradeid!=0&&$teacherid!=0)
		{
			$courses=model('Course')->getCourseByGradeIDTeacherID($gradeid,$teacherid,"");

			return $this->fetch('',[
				'courses'=>$courses,
				
			]);
		}

		if(request()->isPost()){
           //入库逻辑
            $data=input('post.');
			$grade_id=$data['grade_id'];
			$teacher_id=$data['teacher_id'];
			$depart=$data['depart'];
		 	$courses=model('Course')->getCourseByGradeIDTeacherID($grade_id,$teacher_id,$depart);

			return $this->fetch('',[
				'courses'=>$courses,
				
			]);
		}
			
		return $this->fetch('',['courses'=>[]]);
	

	}
	public function add(){

		$departs=config('depart.depart_name');
		$teachers=model('Teacher')->getAllTeacher();
		//$grades=model('Grade')->getAllGradeByStatus(1);

		return $this->fetch('',['departs'=>$departs,'teachers'=>$teachers]);
	}
	public function save(){
		if(!request()->post()){
			$this->error('请求错误');
		}
		$data=input('post.');
		
		$validate=validate('Course');
		if(!$validate->scene('add')->check($data))
		{
			$this->error($validate->getError());
		}

			//判定提交的用户是否存在
		$TeacherResult=Model('Teacher')->get(['id'=>$data['teacher_id']]);
		if(!$TeacherResult){
			$this->error('老师不存在，请重新分配老师');
		}
		$GradeResult=Model('Grade')->get(['id'=>$data['grade_id']]);
		if(!$GradeResult){
			$this->error('班级不存在，请重新分配班级');
		}
		//账户相关信息校验
		//自动生成 密码的加密字符串
		
		$courseData=[
			'name'=>$data['name'],
			'start_time'=>strtotime($data['start_time']),//转为时间戳
			'end_time'=>strtotime($data['end_time']),			
			'teacher_id'=>$data['teacher_id'],
			'grade_id'=>$data['grade_id'],		
		];
		$courseID=model('Course')->add($courseData);
		if(!$courseID){
			$this->error('添加失败');
		}
		$this->success("添加成功",url('course/index',['gradeid'=>$data['grade_id'],'teacherid'=>$data['teacher_id']]));
		//$this->success("申请成功",url('register/waiting',['id'=>$bisId]));
	}

}