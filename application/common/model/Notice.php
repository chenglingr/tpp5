<?php
namespace app\common\model;
use think\Model;

class Notice extends BaseModel{
	public function getNoticeByStatus($status=1){
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
	public function getNoticeByNum($num=16){
		$data=[
			'status'=>1,			
		];

		$order=[
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->limit($num)
					->paginate();
					
		return $result;
	}
}