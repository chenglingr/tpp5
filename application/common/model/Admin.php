<?php
namespace app\common\model;
use think\Model;

class Admin extends BaseModel{

		//通过正常状态的管理员
	public function getAdminByStatus($status=1){
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
}