<?php
namespace app\index\controller;
use think\Controller;

class Notice extends Controller{
	public function detail($id){

		if(!intval($id)){
    		$this->error('ID不合法');
    	}
    	$notice=model('Notice')->get($id);
    	if(!$notice||$notice->status!=1){
    		$this->error('该公告不存在');
    	}

        $name=$notice->name;
        $content=html_entity_decode($notice->content);//富文本 反转一下
		return $this->fetch('',['name'=>$name,'content'=>$content]);
	}
}