<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

trait TimerTrait
{

    public function diffInTime(){
        
        $data['from']                   = Auth::user()->updated_at;
        $data['to']                     = Carbon::now();
        $data['diff_in_hours']          = $data['to']->diffInHours($data['from']);
        $data['diff_in_minutes']        = $data['to']->diffInMinutes($data['from']);
        $data['diff_in_seconds']        = $data['to']->diffInSeconds($data['from']);
        $data['diff_in_milliseconds']   = $data['diff_in_seconds']*1000;
        $data['remaining_time']         = 180 - $data['diff_in_seconds'];

     
        return $data;
    }
 
}