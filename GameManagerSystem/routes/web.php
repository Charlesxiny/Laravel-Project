<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*
 * page control    -根据V1的UI制定的页面跳转控制器IndexController  由于V2大规模重构UI界面和功能，页面跳转逻辑重构，导致部分路由被移至具体子控制器或者被废弃
 *
*/
Route::get('/home', 'IndexController@showHome')->name('home');
Route::get('/user_list', 'IndexController@showUserList')->name('user_list');
// 废弃
Route::get('/show_ban', 'IndexController@showBan')->name('show_ban');
Route::get('/show_ban_list', 'IndexController@showBanList')->name('show_ban_list');
Route::get('/invite_apply_list', 'IndexController@showInviteApplyList')->name('invite_apply_list');
Route::get('/invite_hand_list', 'IndexController@showInviteHandList')->name('invite_hand_list');
Route::get('/require_list/{username?}', 'IndexController@showRequireList')->name('require_list');
Route::get('/bug_list/{id?}', 'IndexController@showBugList')->name('bug_list');

//home          -主页在V2版本分离出来的主页逻辑
Route::get('/home_member', 'HomeController@showMember')->name('home_member');
Route::post('/new_version', 'HomeController@newVersion')->name('new_version');
Route::get('/change_version/{id}', 'HomeController@changeVersion')->name('change_version');
Route::get('/del_version/{id}','HomeController@delVersion')->name('del_version');
Route::post('/change_icon', 'HomeController@changeIcon')->name('change_icon');
Route::post('/edit_dec', 'HomeController@editDec')->name('edit_dec');
Route::post('/edit_name', 'HomeController@editName')->name('edit_name');

//login
Route::get('/show_login', 'UserController@loginUI')->name('show_login');
Route::post('/login_do', 'UserController@loginDo')->name('login_do');
Route::get('/forget', 'UserController@forget')->name('forget');
Route::post('/forget_send', 'UserController@forgetSend')->name('forget_send');

//logout
Route::get('/logout', 'UserController@logout')->name('logout');

//User part
Route::get('/show_add_user', 'UserController@showAddUser')->name('show_add_user');
Route::post('/add_new_user', 'UserController@addNewUser')->name('add_new_user');
Route::post('/delete_user', 'UserController@deleteUser')->name('delete_user');
Route::post('/edit_password_self', 'UserController@editUserPasswordSelf')->name('edit_password_self');
Route::get('/edit_user_info/{id}', 'UserController@editUserInfo')->name('edit_user_info');
Route::post('/edit_user_do', 'UserController@editUserDo')->name('edit_user_do');

//account part
Route::post('/ban_do', 'AccountController@banDo')->name('ban_do') ;
Route::post('/unseal', 'AccountController@unseal')->name('unseal');
Route::get('/unseal_list', 'AccountController@unsealList')->name('unseal_list');
Route::post('/ban_continue', 'AccountController@banContinue')->name('ban_continue');
Route::get('/add_ban', 'AccountController@addBan')->name('add_ban');
Route::post('/add_ban_do', 'AccountController@addBanDo')->name('add_ban_do');

//invitation
Route::post('/send_code', 'InviteController@sendCode')->name('send_code');
Route::post('/deny_invite', 'InviteController@denyInvite')->name('deny_invite') ;
Route::post('/del_record', 'InviteController@delRecord')->name('del_record') ;
Route::post('/del_advance', 'InviteController@delAdvance')->name('del_advance');

//requirement
Route::get('/require_detail/{id}', 'RequireController@requireDetail')->name('require_detail');
Route::get('/new_require', 'RequireController@newRequire')->name('new_require');
Route::post('/add_new_require', 'RequireController@addNewRequire')->name('add_new_require');
Route::post('/deal_require', 'RequireController@dealRequire')->name('deal_require') ;
Route::get('/require_doc_download/{file_name}', 'RequireController@downFile')->name('require_doc_download');
//bugs
Route::get('/bug_detail/{id}','BugController@bugDetail')->name('bug_detail');
Route::get('/new_bug', 'BugController@newBugUI')->name('new_bug');
Route::post('/add_new_bug', 'BugController@addNewBug')->name('add_new_bug');
Route::post('/deal_bug', 'BugController@dealBug')->name('deal_bug');


//log system
Route::get('/character_log', 'LogController@showCharacter')->name('character_log');
Route::get('/download_log_character/{file_name}', 'LogController@downLog')->name('download_log_character');
Route::get('/money_log', 'LogController@showMoney')->name('money_log');
Route::get('/download_log_money/{file_name}', 'LogController@downLogMoney')->name('download_log_money');

//integration
Route::get('/problems_list', 'ProblemController@showProblemList')->name('problems_list');
Route::post('/add_to_bug', 'ProblemController@addToBug')->name('add_to_bug');
Route::get('/event_report', 'ProblemController@showReport')->name('event_report');
Route::post('/new_event', 'ProblemController@addEvent')->name('new_event');


//mobile API  用于和游戏客户端||第三方端进行数据的交互
//   方便测试，先用Get拼接参数  投入使用后主要使用post传参

//active 
Route::get('/upload_active/{year}/{month}/{num}', 'UploadController@uploadActive')->name('upload_active');
//integration
Route::get('/upload_integration/{title}/{type}/{times}/{version}/{timestamp}/{machine}', 'UploadController@uploadIntegration')->name('upload_integration');
Route::get('/upload_data_report/{event_name}/{param1?}/{param2?}/{param3?}/{param4?}', 'UploadController@uploadDataReport')->name('upload_data_report');
//invitation
Route::get('/upload_invite_apply/{account}/{username}/{area}/{email}/{timestamp}', 'UploadController@uploadInviteApply')->name('upload_invite_apply');
Route::get('/upload_invite_use/{username}/{area}/{invite_code}', 'UploadController@uploadUseInviteCode')->name('upload_invite_use');
//account
Route::get('/upload_unseal/{openid}/{unseal_reason}', 'UploadController@uploadUnseal')->name('upload_unseal');