<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 15/11/2016
 * Time: 09:39
 */

namespace App\Http\Controllers;


use App\Models\AccountBanModel;
use App\Models\AccountModel;
use App\Models\AccountUnsealModel;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends Controller{
    public function banDo(Request $request) {
        $openID = $request->input('openId');
        $username = $request->input('username') ;
        $area = $request->input('area') ;
        $ban_time = $request->input('ban_time') ;
        $ban_reason = $request->input('ban_reason');
        $remark = $request->input('remark');
//        $result = DB::table('game_account')->insert([
//                  ['openid'=>$openID,
//                   'name'=>$username,
//                   'area'=>$area,
//                   'ban_time'=>$ban_time,
//                   'ban_reason'=>$ban_reason,
//                   'ban_user'=>session('username'),
//                   'timestamp'=>time()
//                  ]
//        ]);
        $result = AccountBanModel::create(
                  ['openid'=>$openID,
                   'name'=>$username,
                   'area'=>$area,
                   'ban_time'=>$ban_time,
                   'ban_reason'=>$ban_reason,
                   'ban_user'=>session('username'),
                   'timestamp'=>time(),
                      'remark'=>$remark
                  ]
        );
        if ($result != '') {
            return view('result', ['result'=>'封号成功', 'url'=>'home']);
        } else {
            return view('result', ['result'=>'封号失败', 'url'=>'home']);
        }
    }
    public function unsealList(){
        $list = AccountUnsealModel::paginate(12);
        return view('account.unseal_listV2', ['list' => $list]);
    }
    public function unseal(Request $request) {
        $openid = $request->input('openid');
        $item = AccountBanModel::where('openid', '=', $openid)->get()->first();
        $result_insert = AccountUnsealModel::create([
            'openid'=>$openid,
            'username'=>$item->name,
            'area'=>$item->area,
            'ban_time'=>$item->ban_time,
            'ban_reason'=>$item->ban_reason,
            'unseal_reason'=>$request->input('unseal_reason'),
            'unseal_timestamp'=>time(),
            'operator'=>session('username')
        ]);
        if ($result_insert != ''){
            $result_del = AccountBanModel::where('openid', '=', $openid)->delete();
            if ($result_del != '') {
                return view('result', ['result'=>'解封成功', 'url'=>'show_ban_list']);
            } else {
                return view('result', ['result'=>'解封失败，请重试', 'url'=>'show_ban_list']);
            }
        }else{
            return view('result', ['result'=>'解封失败，请重试','url'=>'show_ban_list']);
        }
    }
    public function banContinue(Request $request){
        $openid = $request->input('openid');
        $item = AccountBanModel::where('openid', '=', $openid)->get()->first();
        $ban_time = $item->ban_time;
        $ban_time_continue = intval($request->input('ban_time'),10);
        $ban_total = $ban_time+$ban_time_continue;
        $result = AccountBanModel::where('openid', '=', $openid)->update(['ban_time'=>$ban_total]);
        if ($result != ''){
            return view('result',['result'=>'成功续封','url'=>'show_ban_list']);
        }else{
            return view('result',['result'=>'操作失败，请重试','url'=>'show_ban_list']);
        }
    }
    public function addBan(){
        return view('account.add_banV2');
    }
    public function addBanDo(Request $request){
        $openid = $request->input('openid');
        $username = $request->input('username');
        $area = $request->input('area');
        $ban_time = $request->input('ban_time');
        @$ban_reason = $request->input('ban_reason');
        $ban_user = session('username');
        $timestamp = time();
        @$remark = $request->input('remark');

        $result = AccountBanModel::create(
            ['openid'=>$openid,
                'name'=>$username,
                'area'=>$area,
                'ban_time'=>$ban_time,
                'ban_reason'=>$ban_reason,
                'ban_user'=>$ban_user,
                'timestamp'=>$timestamp,
                'remark'=>$remark
            ]
        );
        if ($result != '') {
            return view('result', ['result'=>'封号成功', 'url'=>'show_ban_list']);
        } else {
            return view('result', ['result'=>'封号失败', 'url'=>'show_ban_list']);
        }
    }


}