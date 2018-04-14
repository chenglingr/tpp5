<?php
namespace app\index\controller;
use think\Controller;

class Student extends Base{
    public function index(){
    	 $courses=model('Course')->getCourseLimitNum();
        $this->assign('courses',$courses);
      if(input('?param.hid')&&input('?param.cid')){

    		$courseid=input('param.cid');
    		$homeworkid=input('param.hid');
            //作业
    		$homework=model('Homework')->get($homeworkid);
            //学生信息 姓名 学号
            $students=model('Student')->getStudentByCourseID($courseid);
            $gradename=  model('Grade')->getGradeNameByCourseID($courseid);
            $urlpath=request()->domain().'/tpp5/elfinder/files/'.$courseid.'/'.$homeworkid;
             return $this->fetch('',[
		       		'homework'=>$homework,
		       		'gradename'=>$gradename,
		       		'students'=>$students,
                    'urlpath'=> $urlpath,
                    'courseid'=>$courseid,
		       ]);
           
    	}
    	$this->error("请先选择课程的作业");
    }
}