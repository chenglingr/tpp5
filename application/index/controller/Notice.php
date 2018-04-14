<?php
namespace app\index\controller;
use think\Controller;

class Notice extends Base{
	public function detail($id){
        $courses=model('Course')->getCourseLimitNum();
        $grades=model('Grade')->getGradeLimitNum();
        $this->assign('courses',$courses);
        $this->assign('grades',$grades);

		if(!intval($id)){
    		$this->error('ID不合法');
    	}
    	$notice=model('Notice')->get($id);
    	if(!$notice||$notice->status!=1){
    		$this->error('该公告不存在');
    	}

        $name=$notice->name;
        $content=html_entity_decode($notice->content);//富文本 反转一下
		return $this->fetch('',['name'=>$name,'content'=>$content,'create_time'=>$notice->create_time]);
	}

    public function index(){
        $courses=model('Course')->getCourseLimitNum();
        $grades=model('Grade')->getGradeLimitNum();
        $this->assign('courses',$courses);
        $this->assign('grades',$grades);

        $notices=model('Notice')->getNoticeByNum(16);
        return $this->fetch('',['notices'=>$notices]);
    }
}