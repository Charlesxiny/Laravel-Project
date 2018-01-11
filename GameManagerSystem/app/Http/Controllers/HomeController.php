<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 11/03/2017
 * Time: 23:37
 */

namespace App\Http\Controllers;


use App\Models\BasicInfoModel;
use App\Models\UserModel;
use App\Models\VersionModel;
use SebastianBergmann\Version;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function showMember(){
        $member_num = array();
        $member = UserModel::orderBy('privilege', 'desc')->get();
        $num1 = UserModel::where('privilege', '=', 1)->get();
        array_push($member_num, count($num1));
        $num2 = UserModel::where('privilege', '=', 2)->get();
        array_push($member_num, count($num2));
        $num3 = UserModel::where('privilege', '=', 3)->get();
        array_push($member_num, count($num3));
        $num4 = UserModel::where('privilege', '=', 4)->get();
        array_push($member_num, count($num4));
        $num5 = UserModel::where('privilege', '=', 5)->get();
        array_push($member_num, count($num5));
        $num6 = UserModel::where('privilege', '=', 6)->get();
        array_push($member_num, count($num6));
        $num7 = UserModel::where('privilege', '=', 7)->get();
        array_push($member_num, count($num7));

        return view('homeV2_member',['member'=>$member, 'member_num'=>$member_num]);
    }
    public function newVersion(Request $request){
        $new_version = $request->input('new_version');
        $result = VersionModel::create(
            ['version'=>$new_version, 'timestamp'=>time()]
        );
        if ($result != ''){
            return view('result',['result'=>'添加成功', 'url'=>'home']);
        }else{
            return view('result',['result'=>'添加失败', 'url'=>'home']);
        }
    }
    public function changeVersion($id){
        $item = VersionModel::where('id', '=', $id)->get()->first();
        $item->timestamp = time();
        $result = $item->save();
        if ($result != ''){
            return view('result',['result'=>'修改成功', 'url'=>'home']);
        }else{
            return view('result',['result'=>'修改失败', 'url'=>'home']);
        }   
    }
    public function delVersion($id){
        $result = VersionModel::where('id', '=', $id)->delete();
        if ($result != ''){
            return view('result',['result'=>'删除成功', 'url'=>'home']);
        }else{
            return view('result',['result'=>'删除失败', 'url'=>'home']);
        }
    }
    public function changeIcon(Request $request){
        $icon = $request->file('icon');
        $id = $request->input('id');
        $icon_name = $icon->getClientOriginalName();

        $icon->move(public_path() . "/images/" , $icon_name);
        $result = BasicInfoModel::where('id', '=', $id)->update(['photo_img'=>$icon_name]);
        if ($result != ''){
            return view('result',['result'=>'更换成功', 'url'=>'home']);
        }else{
            return view('result',['result'=>'更换失败', 'url'=>'home']);
        }
    }
    public function editDec(Request $request){
        $info = BasicInfoModel::all()->first();
        $info->game_dec = $request->dec ;
        $result = $info->save();
        if ($result != ''){
            return view('result',['result'=>'修改成功', 'url'=>'home']);
        }else{
            return view('result',['result'=>'修改失败', 'url'=>'home']);
        }
    }
    public function editName(Request $request){
        $info = BasicInfoModel::all()->first();
        $info->game_name = $request->name;
        $result = $info->save();
        if ($result != ''){
            return view('result',['result'=>'修改成功', 'url'=>'home']);
        }else{
            return view('result',['result'=>'修改失败', 'url'=>'home']);
        }
    }
}