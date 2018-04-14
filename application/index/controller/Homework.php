<?php
namespace app\index\controller;
use think\Controller;

class Homework extends Base{

    public function index(){
    			//获取课程id
		 $courses=model('Course')->getCourseLimitNum();
        $this->assign('courses',$courses);
    	if(input('?param.id')){
    		$courseid=input('param.id');
            //作业
    		$homeworks=model('Homework')->getHomeworkByCourseID($courseid);
            //课程信息
            $course=model('Course')->get($courseid);
            //班级名称
           // $gradename=model('Grade')->getGradeNameByID($course->grade_id);


             return $this->fetch('',[
		       		'course'=>$course,
		       		//'gradename'=>$gradename,
		       		'homeworks'=>$homeworks,
		       ]);
           
    	}
    	$this->error("请先选择课程");
    
      
    }
}