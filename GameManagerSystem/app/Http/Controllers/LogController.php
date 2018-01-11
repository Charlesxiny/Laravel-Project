<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 21/11/2016
 * Time: 11:51
 */

namespace App\Http\Controllers;


class LogController extends Controller{
    public function showCharacter() {
        $file_arr = array();
        $file_time = array();
        $dir = public_path() . "/log/character/";
        // Open a known directory, and proceed to read its contents
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.')
                    array_push($file_arr,$file);
                    $a=filectime($dir . $file);
                    $time = date("Y-m-d H:i",$a);
                    //echo $time . "\n";
                    array_push($file_time, $time);
                } closedir($dh);
            }
        }
        return view('log.log_character', ['file_list'=>$file_arr,'file_time'=>$file_time]);
    }
    public function downLog($file_name) {
        return response()->download(public_path() . "/log/character/" . $file_name) ;
    }

    public function showMoney() {
        $file_arr = array();
        $file_time = array();
        $dir = public_path() . "/log/money/";
        // Open a known directory, and proceed to read its contents
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.')
                        array_push($file_arr,$file);
                    $a=filectime($dir . $file);
                    $time = date("Y-m-d H:i",$a);
                    //echo $time . "\n";
                    array_push($file_time, $time);
                } closedir($dh);
            }
        }
        return view('log.log_money', ['file_list'=>$file_arr,'file_time'=>$file_time]);
    }
    public function downLogMoney($file_name) {
        return response()->download(public_path() . "/log/character/" . $file_name) ;
    }
}