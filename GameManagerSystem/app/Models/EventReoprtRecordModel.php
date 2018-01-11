<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 2017/4/30
 * Time: 18:44
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EventReoprtRecordModel extends Model
{
    protected $table = 'game_report_record';
    protected $guarded = [];
    public $timestamps = false;
}