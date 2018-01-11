<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 2017/5/2
 * Time: 14:34
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AccountUnsealModel extends Model
{
    protected $table = 'game_account_unseal';
    protected $guarded = [];
    public $timestamps = false;

}