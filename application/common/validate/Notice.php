<?php
namespace app\common\validate;
use think\Validate;
class Notice extends Validate
{
		protected $rule=[
		'name'=>'require|max:50',
		'content'=>'require',
		'status'=>'number',	
		'admin_id'=>'number|require',
	];
	//场景设置
	protected $scene=[
	//添加
		'status'=>['id','status'],//状态
		'add'=>['name','content','admin_id'],
	];
}