<?php
namespace app\admin\controller;
use think\Request;

class Operate
{

    public function index()
    {
        return '添加周报';
    }
    public function addWeekly()
    {
        $request = Request::instance();
    	// 是否为 POST 请求
		if ($request->isPost()){
            
	        $postParams = $request->post();
            $weekTime = $postParams['weekTime'];

            $adminId = 1;
            $startTime = $weekTime[0];
            $endTime = $weekTime[1];
            $weekOfYear = $postParams['weekOfYear'];
            $thisWeekWork = $postParams['thisWeekWork'];
            $nextWeekWork = $postParams['nextWeekWork'];
            $collaboration = $postParams['collaboration'];
            $curtime = date('Y-m-d H:i:s');

            $data = [
                'adminId' => $adminId,
                'startTime' => $startTime,
                'endTime' => $endTime,
                'weekOfYear' => $weekOfYear,
                'thisWeekWork' => $thisWeekWork,
                'nextWeekWork' => $nextWeekWork,
                'collaboration' => $collaboration,
                'create_time' => $curtime,
                'update_time' => $curtime,
                'state' => 1
            ];         

            $result = db('weekly')->insert($data);

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
}
