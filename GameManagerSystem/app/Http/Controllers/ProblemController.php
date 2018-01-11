<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 23/04/2017
 * Time: 14:15
 */

namespace App\Http\Controllers;


use App\Models\BugsModel;
use App\Models\EventReoprtRecordModel;
use App\Models\GameEventReport;
use App\Models\ProblemModel;
use App\Models\UserModel;
use Symfony\Component\HttpFoundation\Request;

class ProblemController extends Controller
{
    public function showProblemList(){
        $list = ProblemModel::orderBy('timestamp','desc')->paginate(12);;
        $dealing_user = UserModel::all() ;
        $time_arr = array();
        for ($i = 0; $i < 7; $i = $i + 1){
            array_push($time_arr,strtotime('-' . ($i+1) . ' day'));
        }
        $time_data = array();
        array_push($time_data,count(ProblemModel::whereBetween('timestamp',[$time_arr[6],$time_arr[5]])->get()));
        array_push($time_data,count(ProblemModel::whereBetween('timestamp',[$time_arr[5],$time_arr[4]])->get()));
        array_push($time_data,count(ProblemModel::whereBetween('timestamp',[$time_arr[4],$time_arr[3]])->get()));
        array_push($time_data,count(ProblemModel::whereBetween('timestamp',[$time_arr[3],$time_arr[2]])->get()));
        array_push($time_data,count(ProblemModel::whereBetween('timestamp',[$time_arr[2],$time_arr[1]])->get()));
        array_push($time_data,count(ProblemModel::whereBetween('timestamp',[$time_arr[1],$time_arr[0]])->get()));
        array_push($time_data,count(ProblemModel::whereBetween('timestamp',[$time_arr[0],time()])->get()));

        return view('integration.problems_list',['problem_list'=>$list, 'dealing'=>$dealing_user, 'time_data'=>$time_data]);
    }
    public function addToBug(Request $request){
        $crash_id = $request->input('id');
        $crash_description = $request->input('description');
        $crash_dealing = $request->input('dealing');
        $crash_info = ProblemModel::where('id', '=', $crash_id)->get()->first();
        if ($crash_info->times <= 50){
            $danger = '建议';
        }elseif ($crash_info->times > 50 && $crash_info->times <= 150){
            $danger = '一般';
        }elseif ($crash_info->times > 150 && $crash_info->times <= 500){
            $danger = '高';
        }else {
            $danger = '紧急';
        }
        $result = BugsModel::create([
            'title' => $crash_info->title,
            'description' => $crash_description .
                '错误类型:' . $crash_info->type . "\n" .
                '出现次数:' . $crash_info->times . "\n" .
                '提出时间:' . $crash_info->timestamp .
                '出现机型:' . $crash_info->machine_type,
            'version' => $crash_info->version,
            'type' => 5,
            'danger' => $danger,
            'timestamp' => time(),
            'status' => '新',
            'author' => session('username'),
            'dealing' => $crash_dealing
        ]);
        if ($result) {
            ProblemModel::where('id', '=', $crash_id)->update(['status'=>1]);
            return view('result', ['result' => '已将问题转至缺陷列表', 'url'=>'problems_list']);
        }else{
            return view('result', ['result' => '操作失败', 'url' => 'problems_list']);
        }
    }
    function showReport(){
        $events = GameEventReport::paginate(8);
        $event_count = array();

        $records = EventReoprtRecordModel::paginate(10);
        foreach ($events as $event) {
            $count = count(EventReoprtRecordModel::where('event_name', '=', $event->event_name)->get());
            array_push($event_count, $count);
        }
        return view('integration.event_report',['events' => $events, 'event_count' => $event_count, 'records' => $records]);
    }
    function addEvent(Request $request){
        $event_name = $request->input('event_name');
        $param1 = $request->input('param1')?$request->input('param1'):'';
        $param2 = $request->input('param2')?$request->input('param2'):'';
        $param3 = $request->input('param3')?$request->input('param3'):'';
        $param4 = $request->input('param4')?$request->input('param4'):'';
        $result = GameEventReport::create([
            'event_name' => $event_name,
            'event_param1' => $param1,
            'event_param2' => $param2,
            'event_param3' => $param3,
            'event_param4' => $param4
        ]);
        if ($result){
            return view('result', ['result' => '添加成功', 'url' => 'event_report']);
        }else{
            return view('result', ['result' => '添加失败', 'url' => 'event_report']);
        }

    }

}