<?php
namespace app\admin\controller;
use \think\View;
use think\Input;
use think\Request;
use think\Controller;

class Login
{

    public function index()
    {
        return '登录';
    }
    public function login()
    {
       $view = new View();
       $name = input('request.name');
       $password  = input('request.password');


       $check=\app\admin\model\Admin::login($name, $password);
       if ($check) {
       		$callback['status'] = '1'; 
	    	$callback['message'] = '登录成功';
	    	echo json($callback)->getcontent();
			// exit();
       }else{
       		$callback['status'] = '0';
	    	$callback['message'] = '登录失败';
	    	echo json($callback)->getcontent();
       }
       
    }

    // 退出登录
    public function logout(){
    	\app\admin\model\Admin::logout();

	    if (!session('?ext_user')) {
	        $callback['status'] = '1';
		      $callback['message'] = '登出成功';
		      echo json($callback)->getcontent();
	        exit();
	    }
    }

}
