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
        $request = Request::instance();
        // 是否为 POST 请求
        if ($request->isPost()){
            $postParams = $request->post();
            $weekly= db('weekly');
            $condition['adminId'] = $postParams['adminId'];
            $condition['state'] = '1';
            $count= $weekly->where($condition)->count();
            $pageNum = $postParams['pageNum'];
            $pageSize = $postParams['pageSize'];
            $data['count'] = $count;
        	$data['list'] = $weekly->where('state',1)->order('id desc')->page($pageNum,$pageSize)->select();
            $dataCount = count($data['list']);
            for($i=0; $i < $dataCount; $i++){
                $admin['id'] = $data['list'][$i]['adminId'];
                $admin['state'] = '1';
                $data['list'][$i]['adminName'] = db('admin')->where($admin)->value('name');
                $data['list'][$i]['weeklyDatil'] = '点击即可查看详情';
            }
        	$callback['code'] = 10000;
        	$callback['data'] =  $data;
        	$callback['message'] = '成功';
        	echo json($callback)->getcontent();
        }
    }

    public function updateWeekly(){
        $request = Request::instance();
        // 是否为 POST 请求
        if ($request->isPost()){
            $postParams = $request->post();

            $condition['id'] = $postParams['id'];
            $condition['adminId'] = $postParams['adminId'];
            $condition['state'] = '1';

            $thisWeekWork = $postParams['thisWeekWork'];
            $nextWeekWork = $postParams['nextWeekWork'];
            $collaboration = $postParams['collaboration'];
            $curtime = date('Y-m-d H:i:s');

            $data = [
                'thisWeekWork' => $thisWeekWork,
                'nextWeekWork' => $nextWeekWork,
                'collaboration' => $collaboration,
                'update_time' => $curtime
            ];     

            $result = db('weekly')->where($condition)->update($data);

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

    public function deleteWeekly(){
        $request = Request::instance();
        // 是否为 POST 请求
        if ($request->isPost()){
            
            $postParams = $request->post();

            $condition['id'] = $postParams['id'];
            $condition['adminId'] = $postParams['adminId'];
            $condition['state'] = '1';

            $data = [
                'state' => '0'
            ];

            $result = db('weekly')->where($condition)->data($data)->update();

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
            $condition['adminId'] = $postParams['adminId'];
            $condition['state'] = '1';

            $result = db('weekly')->where($condition)->find();


            $admin['id'] = $result['adminId'];
            $admin['state'] = '1';
            $result['adminName'] = db('admin')->where($admin)->value('name');


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
