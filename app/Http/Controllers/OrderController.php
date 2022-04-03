<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Order;
use App\Http\Controllers\RealtimeController;

class OrderController extends Controller
{
    //
    public function store(Request $request){
        $cart = Cart::getContent();
        // dd($cart);
        $total =  Cart::getTotal();
        $user = auth()->user();
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total
        ]);
        if($order){
            foreach($cart as $item){
                $order->details()->create([
                    'name' => $item->name,
                    'price' => $item->price,
                    'option' => $item->attributes->size,
                    'quantity' => $item->quantity,
                    'quantity_item' => $item->attributes->quantity_item,
                    'unit' => $item->attributes->unit
                ]);
            }
            $order = $order->load(['details:order_id,name,price,option,quantity,quantity_item,unit']);

            (new RealtimeController)->addNewOrder('Có 1 đơn hàng mới được thêm từ '.$user->fullname, $order);
            Cart::clear();
            
            return redirect()->route('home')->with('success', 'Đặt hàng thành công');
        }
        return back()->with('error', 'Đặt món ăn không thành công');
    }
}