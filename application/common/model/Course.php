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

	public function getCourseByGradeIDTeacherID($gradeid,$teacherid,$departname)
	{
		//teacher id 0 为全部  gradeid=-1无班级  0为全部班级--部门名
		$datas[]="status=1";
		if($teacherid>0){
			$datas[]="teacher_id=".$teacherid;
		}
		if($gradeid>0){
			$datas[]="grade_id=".$gradeid;
		}
		elseif ($gradeid==0) {
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
}