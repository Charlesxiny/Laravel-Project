<?php

/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 01/03/2017
 * Time: 10:57
 */
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserModel extends Model {
    /*
     *数据表User
     */
    protected $table = 'game_user';
    /*
     *使用自带时间戳 不用Laravel来维护
     */
    public $timestamps = false;

    public $guarded = [];
}
