<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 14/03/2017
 * Time: 18:03
 */

namespace App\Http\Controllers;


use App\Models\BugsModel;
use App\Models\BugTypeModel;
use App\Models\UserModel;
use App\Models\VersionModel;
use Symfony\Component\HttpFoundation\Request;

class BugController extends Controller
{
    //移动至IndexController

//    public function showBugList(){
//        $bug_types = BugTypeModel::all();
//        $bug_list = BugsModel::all();
//
//        $bug_type_arr = array();
//        $bug_techError = BugsModel::where('type', '=', 1);
//        $bug_requireError = BugsModel::where('type', '=', 2);
//        $bug_artError = BugsModel::where('type', '=', 3);
//        $bug_settingError = BugsModel::where('type', '=', 4);
//        $bug_envError = BugsModel::where('type', '=', 5);
//        $bug_handleError = BugsModel::where('type', '=', 6);
//        $bug_GMError = BugsModel::where('type', '=', 7);
//        $bug_otherError = BugsModel::where('type', '=', 8);
//
//        //将所有的错误类型的bug求数量之后push进去
//
//        array_push($bug_type_arr, count($bug_techError));
//        array_push($bug_type_arr, count($bug_requireError));
//        array_push($bug_type_arr, count($bug_artError));
//        array_push($bug_type_arr, count($bug_settingError));
//        array_push($bug_type_arr, count($bug_envError));
//        array_push($bug_type_arr, count($bug_handleError));
//        array_push($bug_type_arr, count($bug_GMError));
//        array_push($bug_type_arr, count($bug_otherError));
//
//
//
//        return view('bugs.bug_list', ['bug_list'=>$bug_list,
//            'bug_type_arr'=>$bug_type_arr,
//            'bug_types'=>$bug_types]);
//    }


//Route::get('bug_detail/{id}','BugController@bugDetail')->name('bug_detail');
    public function bugDetail($id){
        $bug_detail = BugsModel::where('id', '=', $id)->get()->first();
        $bug_type = BugTypeModel::where('id', '=', $bug_detail->type)->get()->first();
        $user_list = UserModel::orderBy('username', 'asc')->get();
        return view('bugs.bug_detail', ['detail'=>$bug_detail, 'bug_type'=>$bug_type->bug_type, 'user_list'=>$user_list]);
    }
    public function newBugUI(){
        $dealing_user = UserModel::where('privilege', '!=', 6)->orderBy('username','asc')->get() ;
        $bug_type = BugTypeModel::all();
        $version = VersionModel::orderBy('timestamp','desc')->get();
        return view('bugs.new_bug', ['dealing'=>$dealing_user, 'bug_type'=>$bug_type, 'version'=>$version]);

    }
    public function addNewBug(Request $request){
        $title = $request->input('title');
        @$description = $request->input('description');
        $version = $request->input('version');
        $type = $request->input('type');
        $danger = $request->input('danger');
        $timestamp = time();
        $status = '新';
        $author = session('username');
        $dealing = $request->input('dealing');
        //上传截图
        @$screen_shot = $request->file('screen_shot');
        @$origin_name = '';
        if ($screen_shot != ''){
            $origin_name = $screen_shot->getClientOriginalName();
            $screen_shot->move(public_path() . '/bug_image/' , $origin_name);
        }

        $result = BugsModel::create([
            'title'=>$title,
            'description'=>$description,
            'version'=>$version,
            'type'=>$type,
            'danger'=>$danger,
            'timestamp'=>$timestamp,
            'status'=>$status,
            'author'=>$author,
            'dealing'=>$dealing,
            'screen_shot'=>$origin_name
        ]);
        if ($result != '') {
            return view('result', ['result'=>'新缺陷添加成功', 'url'=>'bug_list']);
        }else{
            return view('result', ['result'=>'新缺陷添加失败', 'url'=>'bug_list']);
        }
    }
    public function dealBug(Request $request){
        $id = $request->input('id');
        $change_status = $request->input('change_status');
        $deal_to = $request->input('deal_to');
        $result = BugsModel::where('id', '=', $id)->update(['status'=>$change_status, 'dealing'=>$deal_to]) ;
        if ($result != '') {
            return view('result', ['result'=>'操作成功', 'url'=>'bug_list']);
        } else {
            return view('result', ['result'=>'操作失败', 'url'=>'bug_list']);
        }
    }
}