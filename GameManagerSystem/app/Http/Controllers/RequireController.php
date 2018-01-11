<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 16/11/2016
 * Time: 16:32
 */

namespace App\Http\Controllers;


use App\Models\RequireModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class RequireController extends Controller{
    public function newRequire() {
        //$dealing_user = DB::table('game_user')->where('privilege', '=', 5)->get() ;
        $dealing_user = UserModel::where('privilege', '!=', 3)->orderBy('username','asc')->get() ;
        return view('require.new_requireV2', ['dealing'=>$dealing_user]);
    }
    public function addNewRequire(Request $request) {
        $title = $request->input('title') ;
        $bg_dec = $request->input('bg_dec');
        $description = $request->input('description');
        @$determine = $request->input('determine');
        @$dealing = $request->input('dealing');
        $remark = $request->input('remark') ;
        $author = session('username');
        $timestamp = time();
        $status = '规划中';

        @$file = $request->file('doc');
        @$file_name = '';
        if ($file != '') {
            $file_name = $file->getClientOriginalName();
            $file->move(public_path() . "/doc/", $file->getClientOriginalName());
        }

        @$screen_shot = $request->file('screen_shot');
        @$screen_shot_name = '';
        if ($screen_shot != '') {
            $screen_shot_name = $screen_shot->getClientOriginalName();
            $screen_shot->move(public_path() . "/require_image/" , $screen_shot_name);
        }
//        $result = DB::table('game_require')->insert([
//            ['title'=>$title, 'file_name'=>$file_name, 'author'=>$author, 'dealing'=>$dealing, 'timestamp'=>$timestamp,
//            'remark'=>$remark, 'status'=>$status]
//        ]);
        $result = RequireModel::create(
                  ['title'=>$title,
                   'bg_dec'=>$bg_dec,
                   'description'=>$description,
                   'determine'=>$determine,
                   'file_name'=>$file_name,
                   'screen_shot'=>$screen_shot_name,
                   'author'=>$author,
                   'dealing'=>$dealing,
                   'timestamp'=>$timestamp,
                   'remark'=>$remark,
                   'status'=>$status]
        );
        if ($result != '') {
            return view('result', ['result'=>'新需求添加成功', 'url'=>'require_list']);
        } else {
            return view('result', ['result'=>'新需求添加失败', 'url'=>'require_list']);
        }
    }

    public function dealRequire(Request $request) {
        $id = $request->input('id') ;
        $change_status = $request->input('change_status');
        $deal_to = $request->input('deal_to');

        $result = RequireModel::where('id', '=', $id)->update(['status'=>$change_status, 'dealing'=>$deal_to]) ;
        if ($result != '') {
            return view('result', ['result'=>'操作成功', 'url'=>'require_list']);
        } else {
            return view('result', ['result'=>'操作失败', 'url'=>'require_list']);
        }
    }

    public function downFile($file_name) {
        return response()->download(public_path() . "/doc/" . $file_name);
    }
    public function downScreenShot($file_name){
        return response()->download(public_path() . "/require_image/" . $file_name);
    }

    public function requireDetail($id) {
        $require_detail = RequireModel::where('id', '=', $id)->get()->first();
        $user_list = UserModel::orderBy('username', 'asc')->get();
        return view('require.require_detail', ['detail'=>$require_detail, 'user_list'=>$user_list]);
    }
}
