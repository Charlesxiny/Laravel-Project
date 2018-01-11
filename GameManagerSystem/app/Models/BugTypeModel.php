<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 14/03/2017
 * Time: 23:11
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BugTypeModel extends Model
{
    protected $table = 'game_bug_type';
    protected $guarded = [];
    public $timestamps = false;
}