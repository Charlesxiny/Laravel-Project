<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 12/11/2016
 * Time: 15:13
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\UserTypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller{
    public function loginUI() {
        return view('login') ;
    }
    public function loginDO(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        //$user = DB::table('game_user')->where('username', $username)->get()->first() ;
        $user = UserModel::where('username', $username)->get()->first();
        if ($user != ''){
            if ($user->password == $password) {
                session(['id'=>$user->id, 'username'=>$username, 'privilege'=>$user->privilege, 'photo_img'=>$user->photo_img]) ;
                return view('result', ['result'=>'登录成功', 'url'=>'home']) ;
            }else {
                return view('result', ['result'=>'登录失败,密码不正确', 'url'=>'show_login']) ;
            }
        }else {
            return view('result', ['result'=>'登录失败,用户名不存在', 'url'=>'show_login']) ;
        }
    }
    public function logout() {
        session(['username'=>'']) ;
        return view('login');
    }

    public function showAddUser() {
        //$privilege_list =  DB::table('game_user_type')->get() ;
        $privilege_list = UserTypeModel::all();
        return view('user.add_userV2', ['privilege_list'=>$privilege_list]) ;
    }
    public function addNewUser(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $department = $request->input('department');
        $tel = $request->input('tel');
        $email = $request->input('email');
        $privilege = $request->input('privilege');
        @$photo_img = $request->file('photo_img');
        if ($photo_img != ''){
            $photo_img->move(public_path() . '/photo_img/', $username . '.png');
        }
//        $result = DB::table('game_user')->insert([
//            ['username' => $username, 'password' => $password, 'department' => $department, 'privilege' => $privilege]
//        ]);
        $result = UserModel::create(
            ['username' => $username, 'password' => $password, 'department' => $department, 'tel'=>$tel, 'email'=>$email, 'privilege'=>$privilege, 'photo_img'=>$username . '.png']
        );
        if ($result != '') {
            return view('result', ['result' => '添加成功', 'url' => 'user_list']);
        } else {
            return view('result', ['result' => '添加失败', 'url' => 'user_list']);
        }
    }
    public function deleteUser(Request $request){
        //$result = DB::table('game_user')->where('id','=',$id)->delete() ;
        $id = $request->input('id');
        $result = UserModel::where('id','=',$id)->delete();
        if ($result != '') {
            return view('result', ['result'=>$id, 'url'=>'user_list']);
        } else {
            return view('result', ['result'=>'删除失败', 'url'=>'user_list']);
        }
    }
    public function editUserPasswordSelf(Request $request){
        $password = $request->input('new_password') ;
        //$result = DB::table('game_user')->where('username',session('username'))->update(['password'=>$password]) ;
        $result = UserModel::where('username',session('username'))->update(['password'=>$password]);
        if ($result != '') {
            return view('result', ['result'=>'修改成功', 'url'=>'logout']);
        } else {
            return view('result', ['result'=>'修改失败', 'url'=>'user_list']);
        }
    }
    public function editUserInfo($id){
        //$user = DB::table('game_user')->where('id', '=', $id)->get()->first();
        $user = UserModel::where('id', '=', $id)->get()->first();
        $privilege = DB::table('game_user_type')->get();
        return view('user.edit_userV2', ['user'=>$user, 'privilege'=>$privilege]);
    }
    public function editUserDo(Request $request){
        $userId = $request->input('id');
        $username = $request->input('username');
        $department = $request->input('department');
        $privilege = $request->input('privilege');
        $email = $request->input('email');
        $tel = $request->input('tel');
//        $result = DB::table('game_user')->where('id', '=', $userId)->update(['username'=>$username, 'department'=>$department,
//        'privilege'=>$privilege]) ;
        $result = UserModel::where('id', '=', $userId)->update(['username'=>$username, 'department'=>$department,'tel'=>$tel,'email'=>$email,
        'privilege'=>$privilege]) ;
        if ($result != '') {
            return view('result', ['result'=>'修改成功', 'url'=>'user_list']);
        } else {
            return view('result', ['result'=>'修改失败', 'url'=>'user_list']);
        }
    }
    public function forget(){
        return view('user.forget');
    }
    public function forgetSend(Request $request){
        $username = $request->input('username');
        @$item = UserModel::where('username', '=', $username)->get()->first();
        if ($item != ''){
            $email = $item->email;
            Mail::send('user.mail', ['data'=> $item->password],function($message) use($email){
                $message ->to($email)->subject('【游戏管理系统】官方邮件  --用户密码找回');
            });
        }
        return view('login');
    }
}