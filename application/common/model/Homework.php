<?php
namespace app\common\model;
use think\Model;

class Homework extends BaseModel{

	public function getHomeworkByTeacherStatus($teacherid=0,$status=1,$isend=false){
		
		$order=[
			'course_id'=>'desc',
			'end_time'=>'desc',
			'id'=>'desc',
		];

		if($isend){
			//判断课程是否结束
			
			$data=[
				'status'=>$status,
				'teacher_id'=>$teacherid,
				'end_time'=>['lt',time()],//lt xiao于	 未结束		
			];
			$result= $this->where($data)					
					->order($order)->limit(20)
					->paginate();
		}else{
			$data=[
				'status'=>$status,
				'teacher_id'=>$teacherid,
				'end_time'=>['egt',time()],//gt 大于	 未结束		
			];	

			$result= $this->where($data)
					->order($order)
					->paginate();


		}

					
		return $result;
	}
	public function getHomeworkByCourseStatus($courseid=0,$status=1){
		$data=[
			'status'=>$status,	
			'course_id'=>$courseid,		
			
		];		
			
		$order=[
			'end_time'=>'desc',
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->paginate();
					
		return $result;
	}

	public function getHomeworkByStudentid($studentid){
		//studentid->grade_id->course_id-->homework_id
		$student=model('Student')->get($studentid);
		$grade_id=$student['grade_id'];
		$data=[
			'grade_id'=>$grade_id,
			'status'=>1,
			'end_time'=>['egt',time()],
		];
		$courses=model('Course')->where($data)->column('id');
		
		$result=$this->where(['course_id'=>['in',$courses]])->paginate();
		return $result;
	}

	public function	getHomeworkByCourseID($courseid){
		$data=[
			'status'=>1,	
			'course_id'=>$courseid,		
			
		];		
			
		$order=[
			'end_time'=>'desc',
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->paginate(6);
					
		return $result;
	}
}