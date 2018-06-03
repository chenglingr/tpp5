<?php
namespace app\admin\controller;
use think\Controller;

class Answer extends BaseStudent{
 
	public function index(){

		//获取id --得到作业 num--网址
		$studentid=$this->getUserID();
		$studentnum=$this->getUserNum();
		$homeworks=[];
		$homeworks=model('Homework')->getHomeworkByStudentid($studentid);
		
		return $this->fetch('',[
			'homeworks'=>$homeworks,
			'urlpath'=>request()->domain().'/tpp5/elfinder/files',
			'studentnum'=>$studentnum,
			'studentid'=>$studentid,
		]);
	}
	public function indexcourse(){

		//获取id --得到作业 num--网址
		$studentid=$this->getUserID();
		$studentnum=$this->getUserNum();

		$courses=Model('Course')->getCourseByStudentIDStatusNoEnd($studentid);

		$homeworks=[];
		
		if(request()->post()){
			$data=input('post.');
			$courseid=$data['course_id'];
			$homeworks=Model('Homework')->getHomeworkByCourseStatus($courseid,1);
		}
		
		
		return $this->fetch('',[
			'homeworks'=>$homeworks,
			'urlpath'=>request()->domain().'/tpp5/elfinder/files',
			'studentnum'=>$studentnum,
			'courses'=>$courses,
			'studentid'=>$studentid,
		]);
	}
	public function indexcourseend(){
		//获取id --得到作业 num--网址
		$studentid=$this->getUserID();
		$studentnum=$this->getUserNum();

		$courses=Model('Course')->getCourseByStudentIDStatusEnd($studentid);

		$homeworks=[];
		
		if(request()->post()){
			$data=input('post.');
			$courseid=$data['course_id'];
			$homeworks=Model('Homework')->getHomeworkByCourseStatus($courseid,1);
		}
		
		
		return $this->fetch('indexcourseend',[
			'homeworks'=>$homeworks,
			'urlpath'=>request()->domain().'/tpp5/elfinder/files',
			'studentnum'=>$studentnum,
			'courses'=>$courses,
			'studentid'=>$studentid,
		]);
	}
	public function gotoelfinder(){
		$homeworkid=input('param.id');
		$studentnum=$this->getUserNum();
		//网址 要改写
		$path=request()->domain().'/tpp5/elfinder/index.html';
		$homework=  model('Homework')->get($homeworkid);
        $courseid=$homework->course_id;

		define(ROOT_PATH, __DIR__);
		$realpath=ROOT_PATH . '/elFinder/files/'.$courseid.'/'.$homeworkid.'/'.$studentnum;
		if(!is_dir($realpath)){
			mkdir($realpath);
		}
		session('homeworkid',$courseid.'/'.$homeworkid.'/'.$studentnum);

		$this->redirect($path);
	}
	public function add(){
		$homeworkid=input('param.id');
		$studentid=$this->getUserID();
		$answerData=[
			'homework_id'=>$homeworkid,
			'student_id'=>$studentid,
			
		];
		$answerID=model('Answer')->add($answerData);
		if(!$answerID){
			$this->error('提交作业失败');
		}
		if($answerID==-1){
			$this->error('无需重复提交，只要确保文件已上传',url('answer/index'));
		}
		$this->success("提交作业成功，请确保文件已上传",url('answer/index'));
	}

}