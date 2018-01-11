<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 12/03/2017
 * Time: 15:49
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ActiveRecordModel extends Model
{
    protected $table = 'game_active_record';
    protected $guarded = [];
    public $timestamps = false;
}