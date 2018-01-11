<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 04/03/2017
 * Time: 18:37
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RequireModel extends Model
{
    protected $table = 'game_require';
    public $timestamps = false;
    protected $guarded = [];
}