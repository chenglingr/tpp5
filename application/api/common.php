<?php
//返回数据
function show($status,$message='',$data=[]){
	return [
		'status'=>intval($status),
		'message'=>$message,
		'data'=>$data,
	];
}
