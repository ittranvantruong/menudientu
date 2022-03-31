<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UserOrderEvent;

class RealtimeController extends Controller
{
    //
    public function listen(){
        $arr =array(
            'msg' => 'Hello World',
            'name' => 'Mevivu'
        );
        // return $arr;
        return event(new UserOrderEvent($arr));
    }
}
