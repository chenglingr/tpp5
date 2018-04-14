<?php
namespace app\common\model;
use think\Model;

class Course extends BaseModel{
		public function getCourseByStatus($status=1){
		$data=[
			'status'=>$status,			
		];
		if($status!=1){
			$data=['status'=>['neq',1],];
		}
			
		$order=[
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->paginate();
					
		return $result;
	}
	public function getCourseByGradeID($gradeid){
		$data=[
			'grade_id'=>$gradeid,
		];
	
			
		$order=[
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->paginate();
					
		return $result;
	}
	public function getCourseByTeacherID($teacherid){
		$data=[
			'teacher_id'=>$teacherid,			
		];
		
			
		$order=[
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->paginate();
					
		return $result;
	}

	public function getCourseByTeacherIDStatusNoEnd($teacherid){
		$data=[
			'teacher_id'=>$teacherid,
			'status'=>1,
			'end_time'=>['gt',time()],	
		];
		
			
		$order=[
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->select();
					
		return $result;
	}
	public function getCourseByTeacherIDStatusEnd($teacherid){
		$data=[
			'teacher_id'=>$teacherid,
			'status'=>1,
			'end_time'=>['lt',time()],	
		];
		
			
		$order=[
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->limit(10)
					->select();
					
		return $result;
	}
	public function getCourseByGradeIDTeacherID($gradeid=0,$teacherid=0,$departname='')
	{
		//teacher id 0 为全部  gradeid=-1无班级  0为全部班级--部门名
		$datas[]="status=1";
		if($gradeid==-1){return [];}
		if($teacherid>0){
			$datas[]="teacher_id=".$teacherid;
		}
		if($gradeid>0){
			$datas[]="grade_id=".$gradeid;
		}
		elseif ($gradeid==0&&$departname!='') {
			//查出本部门所有的班级
		$gradeids=	model('Grade')->getGradesIDByDepartName($departname);
		if($gradeids)
			$datas[]="grade_id in (".implode(',',$gradeids).")";
		}
			
		$order=[
			'id'=>'desc',
		];
		$result= $this->where(implode(' AND ', $datas))
					->order($order)
					->paginate();
		  //echo $this->getLastSql();
					
		return $result;
	} 

	public function getGradeNamebyCourseID($id){
		$data=[
			'id'=>$id,		
		];		
	
		$result= $this->where($data)				
					->select();		
			
		$grade=model('Grade')->get($result[0]['grade_id']);
	
		return $grade['name'];
	}

	public function getCourseByStudentIDStatusNoEnd($studentid){

		$student=model('Student')->get($studentid);
		$gradeid=$student['grade_id'];
		$data=[
			'grade_id'=>$gradeid,
			'status'=>1,
			'end_time'=>['gt',time()],
		];
	
			
		$order=[
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->select();
					
		return $result;

	}
		public function getCourseByStudentIDStatusEnd($studentid){

		$student=model('Student')->get($studentid);
		$gradeid=$student['grade_id'];
		$data=[
			'grade_id'=>$gradeid,
			'status'=>1,
			'end_time'=>['lt',time()],
		];
	
			
		$order=[
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->limit(10)
					->select();
					
		return $result;

	}
	public function getCourseByGradeID3($gradeid){
		$data=[
			'status'=>1,
			'end_time'=>['gt',time()],	
			'grade_id'=>$gradeid,
		];		
			
		$order=[
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)				
					->paginate(6);					
		return $result;
	}

	public function getAllCourseNoEnd(){
		$data=[
			'status'=>1,
			'end_time'=>['gt',time()],	
		];		
			
		$order=[
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)				
					->paginate(3);					
		return $result;
	}
	public function getCourseLimitNum($num=4){
		$data=[
			
			'status'=>1,
			'end_time'=>['gt',time()],
		];
	
			
		$order=[
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->limit($num)
					->select();
					
		return $result;
	}
}