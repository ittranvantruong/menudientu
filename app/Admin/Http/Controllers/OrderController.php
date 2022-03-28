<?php

namespace App\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Admin\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    //
    public function index(Request $request){

        $users = $request->whenFilled('status', function ($input) {
            return User::select('id', 'email', 'phone', 'role')->whereStatus($input)->with('user_info:user_id,fullname')->get();
        }, function () {
            return User::select('id', 'email', 'phone', 'role')->with('user_info:user_id,fullname')->get();
        });
        return view('user.index', compact('users'));
    }

    public function create(){
        $users = User::select('id', 'fullname')->whereRole(collect(config('mevivu.role.user'))->keys()->all()[1])->orderBy('id', 'DESC')->get();
        $products = Product::select('id', 'name')->whereStatus(1)->orderBy('id', 'DESC')->get();
        return view('admin.order.create', compact('users', 'products'));
    }
    public function store(OrderRequest $request){
        $data = $request->all();
        $total = 0;
        $order = Order::create(['user_id' => $data['user_id'], 'total' => $total]);

        $data['product'] = collect($data['product'])->sort();
        $products = Product::select('name', 'price', 'quantity', 'unit')->whereIn('id', $data['product'])->get();
        foreach ($data['product'] as $key => $value) {
            $order->detail()->create([
                'name' => $products[$key]->name,
                'price' => $data['price'][$key] ? $data['price'][$key] : $products[$key]->price,
                'quantity' => $data['quantity'][$key] ? $data['quantity'][$key] : 1,
                'quantity_item' => $products[$key]->quantity,
                'unit' => $products[$key]->unit

            ]);
            $total += ($data['price'][$key] ? $data['price'][$key] : $products[$key]->price) * ($data['quantity'][$key] ? $data['quantity'][$key] : 1);
        }
        $order->update(['total' => $total]);
        dd($order);
    }

    public function getProduct(Request $request){
        $html = '';
        $total_price = 0;
        $products = Product::select('id', 'name', 'price', 'price_large', 'quantity', 'unit')->whereIn('id', $request->product_id)->get();
        foreach($products as $item) {
            $html .= view('admin.render.all')->with('type', 'addProductOrder')->with('item', $item)->render();
            $total_price += $item->price;
        }
        return response()->json(['html' => $html, 'total_price' => $total_price]);
    }
}
