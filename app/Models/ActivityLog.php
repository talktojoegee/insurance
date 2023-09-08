<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    /*
     * user_id
title
narration
     */
    public static function addLog($userId, $title, $narration){
        $log = new ActivityLog();
        $log->title = $title ?? '';
        $log->user_id = $userId ?? '';
        $log->narration = $narration ?? '' ;
        $log->save();
    }


    public static function getActivityLogs(){
        return ActivityLog::orderBy('id', 'DESC')->get();
    }

    public static function getActivityLogByUserId($userId){
        return ActivityLog::where('user_id', $userId)->orderBy('id', 'DESC')->get();
    }
}
