<?php
namespace app\common\model;
use think\Model;

class Answer extends BaseModel{

	public function getCountbyHomeworkIdStudentId($homeworkid,$studentid){
		$data=[
			'homework_id'=>$homeworkid,
			'student_id'=>$studentid,
		];

		return $this->where($data)->count();
	}

	public function add($data){
		$homeworkid=$data['homework_id'];
		$studentid=$data['student_id'];
		if($this->getCountbyHomeworkIdStudentId($homeworkid,$studentid)==0){
			$data['status']=1;
		//$data['create_time']=time();
		   $this->save($data);
		   return $this->id;
		}
		else
		{
			return -1;
		}

	}
}