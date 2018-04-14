<?php
namespace app\index\controller;
use think\Controller;

class Grade extends Base{

    public function index(){
    	$grades=model('Grade')->getAllGradeNoEnd();

     	return $this->fetch('',[
     		'grades'=>$grades,
     	]);
    }
}