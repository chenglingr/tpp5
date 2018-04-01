<?php
namespace app\common\model;
use think\Model;

class Teacher extends BaseModel{

	public function getTeacherByStatus($status=1){
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
	public function getAllTeacher(){
		$data=[
			'status'=>1,			
		];
	
		$order=[
			'username'=>'desc',
			'id'=>'desc',
		];
		$result= $this->where($data)
					->order($order)
					->select();
					
		return $result;
	}
	//服务器端分页 https://www.cnblogs.com/landeanfen/p/4976838.html
	public function doRoleRuleList($offset, $limit, $search, $order, $ordername) {
	 
	    $total =$this->where(['status'=>['=', 1]])->count();
	 
	    $rows =$this->where([
	            'status'=>['=',1],
	             'username|depart' => ['like', "%{$search}%"],	   
	        ])
	        ->order($ordername." ".$order)
	        ->limit($offset,$limit)
	        ->select();


	    return ['total'=>$total,'rows'=>$rows];
	}
}