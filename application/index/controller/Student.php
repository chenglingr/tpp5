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

public function test(){
  $dataup=['homework_id'=>1,'student_id'=>2];
$result=model('Answer')->updateUpNum($dataup);
echo $result;
}

    public function up(){
   
        if (!request()->isAjax()){
          
           return ;
        }
        $sid=input('post.sid');
        $hid=input('post.hid');

        $cookiename = 'up'.$sid.$hid.'10000';

        $dataup=['homework_id'=>$hid,'student_id'=>$sid];



       if(cookie($cookiename)==null){
           
            $result=model('Answer')->updateUpNum($dataup);
            if($result!=0){
                 $data=[
                    'info'=>'点赞成功',
                    'status'=>1,
                ];  
                 cookie($cookiename,time()+40, 3600);  
            }else{
                $data=[
                    'info'=>'未交作业不能为其点赞',
                    'status'=>0,
                ];   
            }
         return json_encode($data);
        }
        else
        {
            $data=[
                'info'=>'不要重复点赞',
                'status'=>0,
            ];   
         return json_encode($data);
        
        } 
       
    }

     public function down(){
   
        if (!request()->isAjax()){
          
           return ;
        }
        $sid=input('post.sid');
        $hid=input('post.hid');

        $cookiename = 'down'.$sid.$hid.'10000';

        $datadown=['homework_id'=>$hid,'student_id'=>$sid];



       if(cookie($cookiename)==null){
           
            $result=model('Answer')->updateDownNum($datadown);
            if($result!=0){
                 $data=[
                    'info'=>'送臭鸡蛋成功',
                    'status'=>1,
                ];  
                 cookie($cookiename,time()+40, 3600);  
            }else{
                $data=[
                    'info'=>'未交作业不能为其送臭鸡蛋',
                    'status'=>0,
                ];   
            }
         return json_encode($data);
        }
        else
        {
            $data=[
                'info'=>'不要重复送臭鸡蛋',
                'status'=>0,
            ];   
         return json_encode($data);
        
        } 
       
    }
}