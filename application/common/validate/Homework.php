<?php
namespace app\common\validate;
use think\Validate;
class Homework extends Validate
{
		protected $rule=[
		
		'name'=>'require|max:20',
		'status'=>'number',	
		'teacher_id'=>'require|number',
		'course_id'=>'require|number',	
		'start_time'=>'require',
		'end_time'=>'require',
	];
	//场景设置
	protected $scene=[
	//添加
		'status'=>['id','status'],//状态
		'add'=>['name','course_id','start_time','end_time'],
	];
}