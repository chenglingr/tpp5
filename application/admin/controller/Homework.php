<?php
namespace app\admin\controller;
use think\Controller;

class HomeWork extends BaseTeacher{
	public function index(){
		$teacherid=$this->getUserID();
		$homeworks=Model('Homework')->getHomeworkByTeacherStatus($teacherid,1,false);

		return $this->fetch('',['homeworks'=>$homeworks]);
	}

	public function gotoelfinder(){

	
		$homeworkid=input('param.id');
		$homework=  model('Homework')->get($homeworkid);
        $courseid=$homework->course_id;
		//网址 要改写
		//$path='http://localhost:88/tpp5/elfinder/index.html';
		$path=request()->domain().'/tpp5/elfinder/index.html';
		session('homeworkid',$courseid.'/'.$homeworkid);
		$this->redirect($path);
	}
	public function getCourseFile()
	{
		if(input('?post.course_id')){
			$courseid=input('post.course_id');
			$path=request()->domain().'/tpp5/elfinder/index.html';
			session('homeworkid',$courseid);
			$this->redirect($path);
		}
			$this->error('请求错误');

	}
	public function gethomeworklist(){
	if(!input('?param.id'))	{
		$this->error('请求错误');
	};
		//
		$homeworkid=input('param.id');
		//根据作业id->获取课程id ->班级id->学生名单。显示
		$students=model('Student')->getStudentByHomeworkID($homeworkid);

//获取课程id
        $homework=  model('Homework')->get($homeworkid);
        $courseid=$homework->course_id;
        $this->assign('homeworkid',$homeworkid);
        $this->assign('courseid', $courseid);

		return 	$this->fetch('',[	
			'homeworkid'=>$homeworkid,
			'homeworkname'=> $homework['name'],
			'students'=>$students,
			'urlpath'=>request()->domain().'/tpp5/elfinder/files/'. $courseid.'/'.$homeworkid,
		]);
	}
	public function indexend(){
		$teacherid=$this->getUserID();
		$homeworks=Model('Homework')->getHomeworkByTeacherStatus($teacherid,1,true);

		return $this->fetch('',['homeworks'=>$homeworks]);
	}
	//根据课程查询
	public function indexcourse(){
		$this->assign('courseStatus','(正在进行的课程)');
		$teacherid=$this->getUserID();
		$courses=Model('Course')->getCourseByTeacherIDStatusNoEnd($teacherid);
		//取课程
		//取作业
		$homeworks=[];
	//	
		if(request()->post()){
			$data=input('post.');
			if(!input('?post.course_id')){$this->error('请求错误');}

			$courseid=$data['course_id'];
			$homeworks=Model('Homework')->getHomeworkByCourseStatus($courseid,1);
		}
		return $this->fetch('',['courses'=>$courses,'homeworks'=>$homeworks,'action'=>'indexcourse']);
	}
	public function indexcourseend(){
		$this->assign('courseStatus','(已结束的课程)');
		$teacherid=$this->getUserID();
		$courses=Model('Course')->getCourseByTeacherIDStatusEnd($teacherid);
		//取课程
		//取作业
		$homeworks=[];
	//	
		if(request()->post()){
			$data=input('post.');
			if(!input('?post.course_id')){$this->error('请求错误');}
			$courseid=$data['course_id'];
			$homeworks=Model('Homework')->getHomeworkByCourseStatus($courseid,1);
		}
		return $this->fetch('indexcourse',['courses'=>$courses,'homeworks'=>$homeworks,'action'=>'indexcourseend']);
	}

	public function add(){
		//选出课程
		$teacherid=$this->getUserID();
		$courses=model('Course')->getCourseByTeacherIDStatusNoEnd($teacherid);
		return $this->fetch('',['courses'=>$courses]);
	}
	public function save(){
		$teacherid=$this->getUserID();
		if($teacherid==0){$this->error('请先登陆'); }
		if(!request()->post()){
			$this->error('请求错误');
		}
		$data=input('post.');
		
		$validate=validate('Homework');
		if(!$validate->scene('add')->check($data))
		{
			$this->error($validate->getError());
		}

		
		$homeworkData=[
			'name'=>$data['name'],
			'start_time'=>strtotime($data['start_time']),//转为时间戳
			'end_time'=>strtotime($data['end_time']),			
			'teacher_id'=>$teacherid,
			'course_id'=>$data['course_id'],
			'remark'=>$data['remark'],		
		];
		$homeworkID=model('Homework')->add($homeworkData);
		if(!$homeworkID){
			$this->error('添加失败');
		}
//在课程下新建 作业id的文件夹
		define(ROOT_PATH, __DIR__);
		$realpath=ROOT_PATH . '/elFinder/files/'.$data['course_id'].'/'.$homeworkID;
		if(!is_dir($realpath)){
			mkdir($realpath);
		}
		$this->success("添加成功",url('homework/index'));
	}
	public function setScore()
	{
		 if (!request()->isAjax()){
          
           return ;
        }
        $sid=input('post.sid');
        $hid=input('post.hid');
        $score=input('post.score');
        $data=['student_id'=>$sid,'homework_id'=>$hid,'score'=>$score];
        
        $result=model('Answer')->setScore($data);
        if($result>0){
        	 $data1=['info'=>'评判成功','status'=>1,];  
        }
       else{
       		$data1=['info'=>'未交作业,评判失败','status'=>0,];  
       }
        return json_encode($data1);
	}

}