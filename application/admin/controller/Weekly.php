<?php
namespace app\admin\controller;
use think\Request;

class Weekly
{
    public function index()
    {	
       	return '周报列表';
    }
    public function getWeekly(){
    	$data = db('weekly')->where('state',1)->order('id desc')->select();
        $dataCount = count($data);
        for($i=0; $i < $dataCount; $i++){
            $admin['id'] = $data[$i]['adminId'];
            $admin['state'] = '1';
            $data[$i]['adminName'] = db('admin')->where($admin)->value('name');
            $data[$i]['weeklyDatil'] = '点击即可查看详情';
        }
    	$callback['code'] = 10000;
    	$callback['data'] =  $data;
    	$callback['message'] = '成功';
    	echo json($callback)->getcontent();
    }
    public function deleteWeekly(){
        $request = Request::instance();
        // 是否为 POST 请求
        if ($request->isPost()){
            
            $postParams = $request->post();
            $id = $postParams['id'];

            $data = [
                'state' => '0'
            ];

            $result = db('weekly')->where('id',$id)->data($data)->update();

            if($result){
                $callback['status'] = '1';
                $callback['message'] = '成功';
                echo json($callback)->getcontent();
            }else{
                $callback['status'] = '0';
                $callback['message'] = '失败';
                echo json($callback)->getcontent();
            }
        }
    }

    public function getWeeklyDatil(){
        $request = Request::instance();
        // 是否为 POST 请求
        if ($request->isPost()){
            
            $postParams = $request->post();
            $id = $postParams['id'];

            $condition['id'] = $id;
            $condition['state'] = '1';

            $result = db('weekly')->where($condition)->find();

            if($result){
                $callback['status'] = '1';
                $callback['data'] = $result;
                $callback['message'] = '成功';
                echo json($callback)->getcontent();
            }else{
                $callback['status'] = '0';
                $callback['data'] = '';
                $callback['message'] = '失败';
                echo json($callback)->getcontent();
            }
        }
    }
}
