<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 11/03/2017
 * Time: 19:32
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BasicInfoModel extends Model
{
    protected $table = 'game_basic_info';
    public $timestamps = false;
    protected $guarded = [];
}