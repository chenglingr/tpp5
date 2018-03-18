<?php
namespace app\index\controller;
use think\Db;
class Index
{
    public function index()
    {
    	echo '<pre>';
        var_dump(Db::name('teacher')->select());
		echo '</pre>';
    }
    public function hi()
    {
        return 'hi';
    }
}
