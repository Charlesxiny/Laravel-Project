<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 2017/5/8
 * Time: 23:24
 */

namespace App\Http\Controllers;


use App\Models\AccountBanModel;
use App\Models\AccountUnsealModel;
use App\Models\ActiveRecordModel;
use App\Models\EventReoprtRecordModel;
use App\Models\GameEventReport;
use App\Models\InviteApplyModel;
use App\Models\InviteHandleModel;
use App\Models\ProblemModel;
use Illuminate\Routing\Controller;

class UploadController extends Controller
{
    public function uploadActive($year,$month,$num) {
        $result = ActiveRecordModel::create(
            ['year'=>$year,'month'=>$month,'num'=>$num]
        );
        if ($result != ''){
            return response()->json(['status'=>'1','msg'=>'success']);
        }else{
            return response()->json(['status'=>'0','msg'=>'fail']);
        }
    }
    public function uploadIntegration($title,$type,$times,$version,$timestamp,$machine){
        $result = ProblemModel::create([
            'title'=>$title,
            'type'=>$type,
            'times'=>$times,
            'version'=>$version,
            'timestamp'=>$timestamp,
            'machine_type'=>$machine,
            'status'=>0
        ]);
        if ($result != ''){
            return response()->json(['status'=>'1','msg'=>'success','data'=>['title'=>$title,'type'=>$type,'times'=>$times,'version'=>$version,'timestamp'=>$timestamp,'machine'=>$machine]]);
        }else{
            return response()->json(['status'=>'0','msg'=>'fail']);
        }
    }
    public function uploadInviteApply($account,$username,$area,$email,$timestamp){
        $result = InviteApplyModel::create([
            'account'=>$account,
            'username'=>$username,
            'area'=>$area,
            'email'=>$email,
            'timestamp'=>$timestamp
        ]);
        if ($result != ''){
            return response()->json(['status'=>'1','msg'=>'success','data'=>['account'=>$account,'username'=>$username,'area'=>$area,'email'=>$email,'timestamp'=>$timestamp]]);
        }else{
            return response()->json(['status'=>'0','msg'=>'fail']);
        }
    }
    public function uploadDataReport($event_name,$param1='',$param2='',$param3='',$param4=''){
        $item = GameEventReport::where('event_name', '=', $event_name)->get()->first();
        if ($item != '') {
            $result = EventReoprtRecordModel::create([
                'event_name' => $event_name,
                'param1' => @$param1,
                'param2' => @$param2,
                'param3' => @$param3,
                'param4' => @$param4
            ]);
        }else{
            return response()->json(['status'=>'0','msg'=>'fail','error'=>'can not find this event']);
        }
        if ($result != ''){
            return response()->json(['status'=>'1','msg'=>'success']);
        }else{
            return response()->json(['status'=>'0','msg'=>'fail','error'=>'']);
        }
    }
    public function uploadUseInviteCode($username,$area,$invite_code){
        $item = InviteHandleModel::where('invite_code', '=', $invite_code)->get()->first();
        if ($item != ''){
            if ($item->username == $username && $item->area == $area){
                $item->status = 1 ;
                $item->save();
                return response()->json(['status'=>'1','msg'=>'success']);
            }else{
                return response()->json(['status'=>'0','msg'=>'fail','error'=>'please input correct information']);
            }
        }else{
            return response()->json(['status'=>'0','msg'=>'fail','error'=>'can not find this code']);
        }
    }
    public function uploadUnseal($openid,$unseal_reason){
        $item = AccountBanModel::where('openid', '=', $openid)->get()->first();
        if ($item != ''){
            $result_insert = AccountUnsealModel::create([
                'openid'=>$openid,
                'username'=>$item->name,
                'area'=>$item->area,
                'ban_time'=>$item->ban_time,
                'ban_reason'=>$item->ban_reason,
                'unseal_reason'=>$unseal_reason,
                'unseal_timestamp'=>time(),
                'operator'=>'system'
            ]);
            if ($result_insert != ''){
                $result_del = AccountBanModel::where('openid', '=', $openid)->delete();
                if ($result_del != '') {
                    return response()->json(['status' => '1', 'msg' => 'success']);
                }else{
                    return response()->json(['status'=>'0','msg'=>'fail','error'=>'failed please try again']);
                }
            }else{
                return response()->json(['status'=>'0','msg'=>'fail','error'=>'can not unseal this record']);
            }
        }else{
            return response()->json(['status'=>'0','msg'=>'fail','error'=>'can not find this openid in record']);
        }
    }
}