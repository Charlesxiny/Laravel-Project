<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 2017/4/29
 * Time: 16:19
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GameEventReport extends Model
{
    protected $table = 'game_event_report';
    protected $guarded = [];
    public $timestamps = false;
}