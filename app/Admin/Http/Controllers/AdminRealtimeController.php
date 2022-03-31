<?php

namespace App\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Events\OrderChangeStatusEvent;

class AdminRealtimeController extends Controller
{
    //
    //

    public function changeStatusOrder($newStatus, $oldStatus, $order){
        $html = view('admin.order.render.realtime')->with('item', $order)->render();
        $array = [
            'new' => [
                'class' => $class = orderStatusClass($newStatus),
                'html' => $html
            ], 
            'old' => [
                'class' => $class = orderStatusClass($oldStatus),
                'item' => 'item-'.$order->id
            ]
        ];
        event(new OrderChangeStatusEvent($array));
        return true;
    }
}
