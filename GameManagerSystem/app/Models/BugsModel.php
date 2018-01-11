<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 14/03/2017
 * Time: 23:02
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BugsModel extends Model
{
    protected $table = 'game_bugs';
    protected $guarded = [];
    public $timestamps = false;
}