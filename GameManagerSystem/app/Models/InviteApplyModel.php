<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 04/03/2017
 * Time: 19:28
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class InviteApplyModel extends Model
{
    protected $table = 'game_invite_apply';
    public $timestamps = false;
    //黑名单字段
    protected $guarded = [];
}