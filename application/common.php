<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function status($status)
{
	if($status==1){
		$str="<span class='label label-success radius'>正常</span>";
	}else if($status==0){
		$str="<span class='label label-danger radius'>删除</span>";
	}else{
		$str="<span class='label label-danger radius'>禁用</span>";
	}
	return $str;
}
function answerstatus($homeworkid,$studentid){
	$num=model('Answer')->getCountbyHomeworkIdStudentId($homeworkid,$studentid);
	if($num==0)	{
		$str="<span class='label label-danger radius'>未交作业</span>";
	}
	else{
		$str="<span class='label label-success radius'>已交提交作业</span><br><span class='label label-warning radius'>请确保已上传文件</span>";
	}
	return $str;
}
function answerstatusindex($homeworkid,$studentid,$courseid=0,$studentnum=''){
	$num=model('Answer')->getCountbyHomeworkIdStudentId($homeworkid,$studentid);
	$urlpath=request()->domain().'/tpp5/elfinder/files/'.$courseid.'/'.$homeworkid.'/'.$studentnum.'/index.html';

	$isFile=true;
	try{
		$headeraar = get_headers($urlpath);
		if(strpos($headeraar[0],'HTTP/1.0 1')===false 
				&& strpos($headeraar[0],'HTTP/1.0 2')===false 
				&& strpos($headeraar[0],'HTTP/1.0 3')===false 
				&& strpos($headeraar[0],'HTTP/1.1 1')===false 
				&& strpos($headeraar[0],'HTTP/1.1 2')===false 
				&& strpos($headeraar[0],'HTTP/1.1 3')===false){
			$isFile=false;
			//验证错误处理
		}
	}catch(Exception $e){
		//执行错误处理	
	}


	// $isFile=is_file($urlpath);
	if($num==0||!$isFile)	{
		$str="<span class='label label-danger radius'>未交作业</span>";
	}
	else{
		$str="<span class='label label-success radius'>已交提交作业</span>";
	}
	return $str;
}
//通用的分页样式
function pagination($obj){
	if(!$obj){
		return '';
	}
	//可进行参数连接
	$params=request()->param();
	return '<div class="cl pd-5 bg-1 bk-gray mt-20 tp5-o2o">'.$obj->appends($params)->render().'</div>';
}
function getTeacherName($id){
	if(!intval($id)){
    		return '无效老师';
    	}
	$teacher=model('Teacher')->get($id);
	return $teacher->username;
}
function getGradeName($id){
	if(!intval($id)){
    		return '无效班级';
    	}
	$grade=model('Grade')->get($id);
	return $grade->name;
}
function getCourseName($id){
	if(!intval($id)){
    		return '无效课程';
    	}
	$course=model('Course')->get($id);
	return $course->name;
}

function getGradeNamebyCourseID($id)
{

  $name=model('Course')->getGradeNamebyCourseID($id);
  return $name;
}

function isEnd($endtime){
	$end=strtotime($endtime);
	if($end>time()){
		$str="<span class='label label-danger radius'>作业已结束</span>";
	}else
	{
		$str="<span class='label label-success radius'>作业正在进行中</span>";		
	}
	return $str;
}
function upnum($homeworkid,$studentid){
	$num=model('Answer')->getUpCountbyHomeworkIdStudentId($homeworkid,$studentid);
    return $num;
}
function downnum($homeworkid,$studentid){
	$num=model('Answer')->getDownCountbyHomeworkIdStudentId($homeworkid,$studentid);
    return $num;
}
function getScore($homeworkid,$studentid)
{
	$score=model('Answer')->getScorebyHomeworkIdStudentId($homeworkid,$studentid);
	return $score;
}