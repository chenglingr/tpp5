<?php
namespace app\common\validate;
use think\Validate;
class Teacher extends Validate
{
		protected $rule=[
		'name'=>'require|max:25',
		'status'=>'number',			
	];
	//场景设置
	protected $scene=[
	//添加
		'status'=>['id','status'],//状态
	];
}