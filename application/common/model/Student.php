<?php
namespace app\common\model;
use think\Model;

class Student extends BaseModel{

		public function getStudentByGradeID($gradeID=0,$status=1){
		$data=[
			'status'=>1,
			'grade_id'=>$gradeID,		
		];
		if($status!=1){
			$data=['status'=>['neq',1],];
		}
			
		$order=[
			'status'=>'desc',
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->paginate();
					
		return $result;
	}
	public function addStudentList($datas)
	{
		$students=$this->saveAll($datas);
		if($students){
			return true;
		}
		return false;
	}

	public function getStudentByHomeworkID($homeworkid){
		$homework=model('Homework')->get($homeworkid);
		$course=model('Course')->get($homework['course_id']);
		$grade_id=$course['grade_id'];
		$result=$this->where(['grade_id'=>$grade_id,'status'=>1])->select();

		return $result;
	}
	public function getStudentByCourseID($courseid){
		$course=model('Course')->get($courseid);
		$grade_id=$course['grade_id'];
		$result=$this->where(['grade_id'=>$grade_id,'status'=>1])->select();

		return $result;
	}
}