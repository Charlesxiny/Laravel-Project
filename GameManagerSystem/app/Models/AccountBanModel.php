<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 04/03/2017
 * Time: 21:27
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AccountBanModel extends Model
{
    protected $table = 'game_account_ban';

    protected $guarded = [];

    public $timestamps = false;
}