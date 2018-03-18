<?php
namespace app\common\model;
use think\Model;

class BaseModel extends Model{

	public function add($data){
		$data['status']=1;
		//$data['create_time']=time();
		$this->save($data);
		return $this->id;
	}
	public function updateById($data,$id)
	{
		return $this->allowField(true)->save($data,['id'=>$id]);
	}
}