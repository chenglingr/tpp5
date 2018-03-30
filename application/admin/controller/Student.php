<?php
namespace app\admin\controller;
use think\Controller;
/*use PHPExcel_IOFactory;  
use PHPExcel; */

class Student extends Base{
	public function index($id=0){

		$departs=config('depart.depart_name');
		$grades=model('Grade')->getAllGradeByStatus(1);

		$this->assign('departs',$departs);

		//$this->assign('grades', $grades);


		if(intval($id)){
			
    		$students=model('Student')->getStudentByGradeID($id,1);

			return $this->fetch('',[
				'students'=>$students,
				
			]);
    	}
		/*if (request()->isGet()){
			$id=input('get.id');

			echo $id.'eee';
			if(!empty($id)){
				$students=model('Student')->getStudentByGradeID($id,1);
				return $this->fetch('',['students'=>$students]);
			}

		}*/

		if(request()->isPost()){
           //入库逻辑
            $data=input('post.');
			$id=$data['grade_id'];
			$students=model('Student')->getStudentByGradeID($id,1);

			return $this->fetch('',[
				'students'=>$students,
				
			]);
		}
			
		return $this->fetch('',[
			'students'=>[],
			
		]);
	

	}
	public function add(){

		$departs=config('depart.depart_name');
		//$grades=model('Grade')->getAllGradeByStatus(1);
		return $this->fetch('',['departs'=>$departs]);
		//return $this->fetch('',['departs'=>$departs,'grades'=>$grades]);
	}
	public function addlist(){
		
		$departs=config('depart.depart_name');
		
		return $this->fetch('',['departs'=>$departs]);
/*		$user = new User;
$list = [
    ['name'=>'thinkphp','email'=>'thinkphp@qq.com'],
    ['name'=>'onethink','email'=>'onethink@qq.com']
];
$user->saveAll($list);*/
	}
	//批量导入 excel
	public function savelist(){

	
		if(!request()->post()){
			$this->error('请求错误');
		}
		$data=input('post.');
		if((!input('post.grade_id'))||input('post.grade_id')==-1)
		{
			$this->error('请先选择有效班级');
		}
  //获取表单上传文件  
 		$file = request()->file('studentlist');  
  		$info = $file->validate(['ext' => 'xlsx,xls'])->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . 'student');  

  		  //数据为空返回错误  
        if(empty($info)){  
        	$this->error('文件导入错误');
        } 

        //获取文件名  
        $exclePath = $info->getSaveName();  
        //上传文件的地址  
        $filename = ROOT_PATH . 'public' . DS . 'uploads' . DS . 'student'. DS . $exclePath;  
          //判断截取文件  . strtr($exclePath,'\\','/')
        $extension = strtolower( pathinfo($filename, PATHINFO_EXTENSION) ); 
        
	//$delfilename= $_SERVER['DOCUMENT_ROOT'].'tpp5/public/uploads/student/'.strtr($exclePath,'\\','/');

	vendor("PHPExcel.PHPExcel.PHPExcel");
	vendor("PHPExcel.PHPExcel.IOFactory");
        //区分上传文件格式  
        if($extension == 'xlsx') {  
            $objReader =\PHPExcel_IOFactory::createReader('Excel2007');  
            $objPHPExcel = $objReader->load($filename, $encode = 'utf-8');  
        }else if($extension == 'xls'){  
            $objReader =\PHPExcel_IOFactory::createReader('Excel5');  
            $objPHPExcel = $objReader->load($filename, $encode = 'utf-8');  
        }  
  
        $excel_array = $objPHPExcel->getsheet(0)->toArray();   //转换为数组格式   

          array_shift($excel_array);  
         // array_shift($excel_array);  
       
          foreach($excel_array as $k=>$v) {  
          
                $res[$k]['num']     = $v[0];  
                $res[$k]['username']  = $v[1];  
				$res[$k]['tel']=$v[2]?$v[2]:"";
                 
                $res[$k]['email'] = $v[3]? $v[3]:"";  
                $res[$k]['major'] = $v[4]? $v[4]:"";  
 				$res[$k]['code'] =mt_rand(100,10000);
 				$res[$k]['password'] =md5('123456'. $res[$k]['code']);
 				$res[$k]['depart'] =$data['depart'];
 				$res[$k]['grade_id'] =$data['grade_id'];        
              
        }  
   		$ok=true;
   	
		 try{
			$ok=  Model('Student')->addStudentList($res);
		 }catch(\Exception $e){
  			$ok=false;
		 }finally{

		 	unset($info);//释放文件资源
 			if (file_exists($filename)) {  
           		unlink($filename);  
          	} 
          
		 }
	
     	if($ok){
			$this->success("批量添加成功",url('student/index',['id'=>$data['grade_id']]));
      	}
      	else
     	{
      		$this->error('批量导入错误');
     	}

 // $this->ajaxReturn($output);
		
     

     
	}

	public function save(){
		if(!request()->post()){
			$this->error('请求错误');
		}
		$data=input('post.');
		
		$validate=validate('Student');
		if(!$validate->scene('add')->check($data))
		{
			$this->error($validate->getError());
		}

			//判定提交的用户是否存在
		$accountResult=Model('Student')->get(['num'=>$data['num']]);
		if($accountResult){
			$this->error('该用同学已存在，请重新分配学号');
		}

		//账户相关信息校验
		//自动生成 密码的加密字符串
		$data['code']=mt_rand(100,10000);
		$accountData=[
			'num'=>$data['num'],
			'username'=>$data['username'],
			'code'=>$data['code'],
			'password'=>md5($data['password'].$data['code']),
			'tel'=>$data['tel'],
			'email'=>$data['email'],
			'depart'=>$data['depart'],
			'major'=>$data['major'],
			'grade_id'=>$data['grade_id'],
		];
		$accountID=model('Student')->add($accountData);
		if(!$accountID){
			$this->error('添加失败');
		}
		$this->success("添加成功",url('student/index',['id'=>$data['grade_id']]));
		//$this->success("申请成功",url('register/waiting',['id'=>$bisId]));
	}

}