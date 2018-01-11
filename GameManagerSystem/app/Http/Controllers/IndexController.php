<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 12/11/2016
 * Time: 15:17
 *
 *
 * IndexController -> 负责网站的主页面左边tab跳转逻辑  都在这儿处理
 * V2版本进行进一步优化UI,逻辑再次分离,部分路由分发到子控制器
 */

namespace App\Http\Controllers;



use App\Models\AccountBanModel;
use App\Models\AccountModel;
use App\Models\ActiveRecordModel;
use App\Models\BasicInfoModel;
use App\Models\BugsModel;
use App\Models\BugTypeModel;
use App\Models\InviteApplyModel;
use App\Models\InviteHandleModel;
use App\Models\RequireModel;
use App\Models\UserModel;
use App\Models\VersionModel;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Yaml\Tests\B;

class IndexController extends Controller{
    public function showHome() {
        if (session('username') == '') {
            return view('login') ;
        }else{
            $active_num = array();
            $active_month = array();
            $basic_info = BasicInfoModel::where('id', '=', 1)->get()->first();
            session(['cur_version'=>$basic_info->game_version]);
            $active_record = ActiveRecordModel::where('year', '=', 2017)->orderBy('month','asc')->get();
            for ($i = 0; $i < count($active_record); $i++){
                array_push($active_num, $active_record[$i]->num);
                array_push($active_month, $active_record[$i]->month . '月');
            }

            $version_list = VersionModel::orderBy('timestamp','desc')->get();
            $new_version = VersionModel::orderBy('timestamp','desc')->get()->first();

            $require_models = RequireModel::all();
            $require_total = count($require_models);
            $require_finish = count(RequireModel::where('status', '=', '完成需求')->get());

            $bug_models = BugsModel::all();
            $bug_total = count($bug_models);
            $bug_finish = count(BugsModel::where('status', '=', '完成')->get());

            $require_list = RequireModel::paginate(5);
            $bug_list = BugsModel::paginate(5);
            session(['version'=>$new_version->version]);
            return view('homeV2', ['basic_info'=>$basic_info, 'active_num'=>$active_num, 'active_month'=>$active_month, 'new_version'=>$new_version->version, 'version_list'=>$version_list,
                'progress_bar'=>['require_total'=>$require_total, 'require_finish'=>$require_finish, 'bug_total'=>$bug_total, 'bug_finish'=>$bug_finish],
                'require_list'=>$require_list, 'bug_list'=>$bug_list]);
        }
    }
    public function showUserList() {
        //$users = DB::table('game_user')->simplePaginate(8);
        $users = UserModel::paginate(12);
        return view('user.user_listV2', ['users'=>$users]);
    }
    public function showBan() {
        return view('account.Ω');
    }
    public function showBanList() {
        //$list = DB::table('game_account')->simplePaginate(8);
        $list = AccountBanModel::orderBy('timestamp','desc')->paginate(12);
        return view('account.ban_listV2', ['list'=>$list]);
    }
    public function showInviteApplyList() {
        //$list = DB::table('game_invite_apply')->simplePaginate(8);
        $list = InviteApplyModel::orderBy('timestamp','asc')->paginate(12);
        $send_count = count(InviteHandleModel::all());
        return view('invite.invite_applyV2', ['list'=>$list, 'send_count'=>$send_count]);
    }
    public function showInviteHandList() {
        $list = InviteHandleModel::orderBy('timestamp','asc')->paginate(12);
        return view('invite.invite_handle_recordV2', ['list'=>$list]);
    }
    public function showRequireList($username='')
    {
        $require_all = count(RequireModel::all());
        $require_new = count(RequireModel::where('status', '=', '规划中')->get());
        $require_develope= count(RequireModel::where('status', '=', '开发中')->get());
        $require_finish = count(RequireModel::where('status', '=', '完成需求')->get());
        $require_refuse = count(RequireModel::where('status', '=', '已拒绝')->get());
        $holdon = count(RequireModel::where('status', '=', '挂起')->get());
        if ($username == '') {
            $require_list = RequireModel::orderBy('timestamp','desc')->paginate(12);
            return view('require.require_listV2', ['require_list' => $require_list,
                                                             'all'=>$require_all,
                                                             'new'=>$require_new,
                                                        'develope'=>$require_develope,
                                                          'finish'=>$require_finish,
                                                          'refuse'=>$require_refuse,
                                                          'hold_on'=>$holdon,
                                                          'active_all'=>'active',
                                                          'active_self'=>''

            ]);
        }else{
            $require_list = RequireModel::where('dealing', '=', $username)->orWhere('author', '=', $username)->orderBy('timestamp','desc')->paginate(12);
            return view('require.require_listV2', ['require_list' => $require_list,
                                                             'all'=>$require_all,
                                                             'new'=>$require_new,
                                                        'develope'=>$require_develope,
                                                          'finish'=>$require_finish,
                                                          'refuse'=>$require_refuse,
                                                          'hold_on'=>$holdon,
                                                          'active_all'=>'',
                                                          'active_self'=>'active'
            ]);
        }
    }
    public function showBugList($username=''){
        $bug_types = BugTypeModel::all();
        $bug_list = BugsModel::orderBy('timestamp','desc')->paginate(12);

        $bug_type_arr = array();
        $bug_techError = BugsModel::where('type', '=', 1)->get();
        $bug_requireError = BugsModel::where('type', '=', 2)->get();
        $bug_artError = BugsModel::where('type', '=', 3)->get();
        $bug_settingError = BugsModel::where('type', '=', 4)->get();
        $bug_envError = BugsModel::where('type', '=', 5)->get();
        $bug_handleError = BugsModel::where('type', '=', 6)->get();
        $bug_GMError = BugsModel::where('type', '=', 7)->get();
        $bug_otherError = BugsModel::where('type', '=', 8)->get();

        //将所有的错误类型的bug求数量之后push进去

        array_push($bug_type_arr, count($bug_techError));
        array_push($bug_type_arr, count($bug_requireError));
        array_push($bug_type_arr, count($bug_artError));
        array_push($bug_type_arr, count($bug_settingError));
        array_push($bug_type_arr, count($bug_envError));
        array_push($bug_type_arr, count($bug_handleError));
        array_push($bug_type_arr, count($bug_GMError));
        array_push($bug_type_arr, count($bug_otherError));

        if ($username == ''){
            return view('bugs.bug_list', ['bug_list'=>$bug_list,
                'bug_type_arr'=>$bug_type_arr,
                'bug_types'=>$bug_types,
                'active_all'=>'active',
                'active_self'=>''
            ]);
        }else{
            $bug_list = BugsModel::where('dealing', '=', $username)->orWhere('author', '=', $username)->paginate(12);
            return view('bugs.bug_list', ['bug_list'=>$bug_list,
                'bug_type_arr'=>$bug_type_arr,
                'bug_types'=>$bug_types,
                'active_all'=>'',
                'active_self'=>'active']);
        }

    }
}