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