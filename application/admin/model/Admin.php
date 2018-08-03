<?php
namespace app\admin\model;
use think\Request;
use think\Model;

class Admin extends \think\Model
{
    public static function login($name, $password)
    {
    	$request = Request::instance();

    	if ($request->isPost()){
    		$post = $request->post();
    		$map['name'] = $post['name'];
	        $map['password'] = md5($post['password']);

	        $user=Admin::where($map)->find();
	        if ($user) {
	            unset($user["password"]);
	            session("ext_user", $user);

                $check['adminId'] = $user["id"];
                $check['adminName'] = $user["name"];
                $check['flag'] = true;
	            return $check;
	        }else{
	            return false;
	        }

    	}

        
    }

    public static function logout(){
        session("ext_user", NULL);
        return [
            "code" => 0,
            "desc" => "退出成功"
        ]; 
    }
}