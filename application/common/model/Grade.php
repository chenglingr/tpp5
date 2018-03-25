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

}