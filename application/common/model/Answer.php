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

	public function getUpCountbyHomeworkIdStudentId($homeworkid,$studentid){
		$data=[
			'homework_id'=>$homeworkid,
			'student_id'=>$studentid,
			];
		 $result= $this->where($data)->value('up');
		 if(isset($result) ){return $result;}

		 return 0;
	}
	public function getDownCountbyHomeworkIdStudentId($homeworkid,$studentid){
		$data=[
			'homework_id'=>$homeworkid,
			'student_id'=>$studentid,
			];
		 $result= $this->where($data)->value('down');
		 if(isset($result) ){return $result;}

		 return 0;
	}
	 public function updateUpNum($data){
	      return	$this->where($data)->setInc('up',1);
		
	 }
	 public function updateDownNum($data){
	      return	$this->where($data)->setInc('down',1);
		
	 }
	 public function setScore($data){
		 $result=$this->save(
		 	['score'  =>$data['score']],
		 	['student_id' => $data['student_id'],'homework_id'=>$data['homework_id']]
		 );
		 return $result;
	 }
	public function getScorebyHomeworkIdStudentId($homeworkid,$studentid){
		$data=[
			'homework_id'=>$homeworkid,
			'student_id'=>$studentid,
			];
		 $result= $this->where($data)->value('score');
		 if(isset($result) ){return $result;}

		 return 0;
	}
}