<?php
namespace app\common\validate;
use think\Validate;
class Course extends Validate
{
		protected $rule=[
		
		'name'=>'require|max:20',
		'status'=>'number',	
		'teacher_id'=>'require|number',
		'grade_id'=>'require|number',	
	];
	//场景设置
	protected $scene=[
	//添加
		'status'=>['id','status'],//状态
		'add'=>['name','teacher_id','grade_id'],
	];
}