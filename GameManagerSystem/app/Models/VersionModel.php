<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 2017/5/8
 * Time: 10:15
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class VersionModel extends Model
{
    protected $table = 'game_version';
    protected $guarded = [];
    public $timestamps = false;
}