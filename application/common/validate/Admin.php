<?php
namespace app\common\validate;
use think\Validate;
class Admin extends Validate
{
		protected $rule=[
		'num'=>'require|max:20',
		'username'=>'require|max:20',
		'status'=>'number',	
		'password'=>'require|max:32',
	];
	//场景设置
	protected $scene=[
	//添加
		'status'=>['id','status'],//状态
		'add'=>['num','username','password'],
	];
}