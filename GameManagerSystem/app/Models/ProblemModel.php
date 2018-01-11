<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 23/04/2017
 * Time: 14:13
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProblemModel extends Model
{
    protected $table = 'game_crash_list';
    public $timestamps = false;
    protected $guarded = [];
}