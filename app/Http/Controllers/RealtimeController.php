<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UserOrderEvent;
use App\Events\CallEmployeeEvent;

class RealtimeController extends Controller
{
    //
    public function addNewOrder($msg = 'Có 1 đơn hàng mới', $order){
        $html = view('admin.order.render.realtime')->with('item', $order)->render();
        $link = route('edit.order', $order->id);
        $class = orderStatusClass($order->status);
        $array =array(
            'msg' => $msg,
            'class' => $class,
            'html' => $html,
            'link' => $link
        );
        // return $arr;
        return event(new UserOrderEvent($array));
    }

    public function callEmployee(){
        $array =array(
            'msg' => 'Khách gọi từ '.auth()->user()->fullname,
            'text' => 'Tiếp nhận yêu cầu <a href="javascript:void(0)" class="close-jq-toast-single close-jq-toast-single-custom" onclick="pausedAudio();">Tiếp nhận</a>',
        );
        event(new CallEmployeeEvent($array));
        return true;
    }
}
