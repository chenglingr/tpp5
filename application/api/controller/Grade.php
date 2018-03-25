<?php
namespace app\api\controller;
use think\Controller;
class Grade extends Controller
{
	private $obj;
	public function _initialize(){
		$this->obj=model("Grade");
	}
  public function getGradesByDepartName()
    {
      $departName=input('post.depart');
   
      //通过id获取二级城市
      $grades=$this->obj->getGradesByDepartName($departName);

     
      if(!$grades){
        return show(0,'error');
      }
      return show(1,'success',$grades);
    }
   
      
}
