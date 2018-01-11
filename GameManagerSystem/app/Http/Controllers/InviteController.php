<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 16/11/2016
 * Time: 11:49
 */

namespace App\Http\Controllers;


use App\Models\InviteApplyModel;
use App\Models\InviteHandleModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Request;

class InviteController extends Controller{
    public function sendCode(Request $request) {
        $id = $request->input('id_send');
        //$item = DB::table('game_invite_apply')->where('id', '=', $id )->get()->first() ;
        $item = InviteApplyModel::where('id', '=', $id )->get()->first() ;
        $email = $item->email;

        $code = $this->randomCode('letter') . $this->randomCode('num') . $this->randomCode('letter') . $this->randomCode('num');
        //检测是否重复
        $repeat = InviteHandleModel::where('invite_code', '=', $code)->get()->first();
        if ($repeat != ''){
            //重复则重新生成
            $code = $this->randomCode('letter') . $this->randomCode('num') . $this->randomCode('letter') . $this->randomCode('num');
        }

        Mail::send('invite.mail_blade', ['data'=>$code],function($message) use($email){
            $message ->to($email)->subject('游戏开发过程管理系统 --邀请码');
        });

        $insertRe = InviteHandleModel::create(
            ['username'=>$item->username, 'area'=>$item->area, 'invite_code'=>$code, 'status'=>0, 'timestamp'=>time()]

        );
        if ($insertRe != ''){
            $delRe = InviteApplyModel::where('id', '=', $id)->delete() ;
        }else{
            return view('result', ['result' => '生成错误，请重试', 'url' => 'invite_apply_list']);
        }
        if ($delRe != ''){
            return view('result', ['result' => '操作成功', 'url' => 'invite_apply_list']);
        } else {
            return view('result', ['result' => '操作失败', 'url' => 'invite_apply_list']);
        }

    }
    public function denyInvite(Request $request) {
        $id = $request->input('id_deny') ;
        //$result = DB::table('game_invite_apply')->where('id', '=', $id)->delete() ;
        $result = InviteApplyModel::where('id', '=', $id)->delete();
        if ($result != ''){
            return view('result', ['result' => '操作成功', 'url' => 'invite_apply_list']);
        } else {
            return view('result', ['result' => '操作失败', 'url' => 'invite_apply_list']);
        }
    }
    public function delRecord(Request $request) {
        $id = $request->input('id');
        $ret = InviteHandleModel::where('id', '=', $id)->delete();
        if ($ret != ''){
            return view('result', ['result' => '删除成功', 'url' => 'invite_hand_list']);
        }else{
            return view('result', ['result' => '删除失败', 'url' => 'invite_hand_list']);
        }
    }
    public function delAdvance(Request $request){
        $control = $request->input('control');
        if ($control == 0){
            $result = InviteHandleModel::where('status', '=', 1)->delete();
        }else{
            DB::table('game_invite_hand')->truncate();
            return view('result', ['result' => '删除成功', 'url' => 'invite_hand_list']);
        }
        if ($result != ''){
            return view('result', ['result' => '删除成功', 'url' => 'invite_hand_list']);
        } else {
            return view('result', ['result' => '删除失败' . $result, 'url' => 'invite_hand_list']);
        }
    }
    public function randomCode($key){
        if ($key == 'letter'){
            $code = chr(rand(97,122)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(97,122));
        }elseif ($key == 'num'){
            $code = rand(100,999);
        }
        return $code;
    }


}