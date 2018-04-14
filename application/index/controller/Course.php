<?php
namespace app\index\controller;
use think\Controller;

class Course extends Base{
    public function index(){
		//获取班级id
		$gradename='';
    	if(input('?param.id')){
    		$gradeid=input('param.id');
    		$courses=model('Course')->getCourseByGradeID3($gradeid);
            $gradename=model('Grade')->getGradeNameByID($gradeid);
           
    	}
    	else{
    		$courses=model('Course')->getAllCourseNoEnd();
    	}
    	 $this->assign('gradename',$gradename);
       return $this->fetch('',[
       		'courses'=>$courses,
       ]);
    }
}