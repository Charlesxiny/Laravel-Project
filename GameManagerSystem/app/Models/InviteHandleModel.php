<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 04/03/2017
 * Time: 19:29
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class InviteHandleModel extends Model
{
    protected $table ='game_invite_hand';
    protected $guarded = [];
    public $timestamps = false;
}