<?php
namespace app\common\model;
use think\Model;

class Grade extends BaseModel{

	public function getGradeByStatus($status=1){
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
	public function getAllGradeByStatus($status=1){
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
					->select();
					
		return $result;
	}

	public function	getGradesByDepartName($departName){
		$data=[
			'depart'=>$departName,
			'status'=>1,			
		];
		$order=[
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->select();
				
		return $result;

	}
	public function	getGradesIDByDepartName($departName){
		$data=[
			'depart'=>$departName,
			'status'=>1,			
		];
		$order=[
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->column('id');
				
		return $result;

	}

	
	public function  getAllGradeNoEnd(){
		$data=[
			'status'=>1,			
		];
		
		$order=[
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->paginate(8);
					
		return $result;
	}
	public function  getGradeNameByID($gradeid){
	
		$result= $this->get($gradeid);
					
		return $result->getAttr('name');
	}
	public function  getGradeNameByCourseID($courseid){
	
	    $course=model('Course')->get($courseid);
	    $gradeid= $course['grade_id'];
		$result= $this->get($gradeid);
					
		return $result->getAttr('name');
	}
	public function getGradeLimitNum($num=5){
		$data=[
			
			'status'=>1,
			
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