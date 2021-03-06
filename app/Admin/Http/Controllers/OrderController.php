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
        $orders = $request->whenFilled('status', function ($input) {
            return Order::select('id', 'user_id', 'status', 'total')->whereStatus($input)->with(['user:id,fullname', 'details:order_id,name,option,quantity'])->orderBy('id', 'DESC')->get();
        }, function () {
            return Order::select('id', 'user_id', 'status', 'total')->with(['user:id,fullname', 'details:order_id,name,option,quantity'])->orderBy('id', 'DESC')->get();
        });
        $status = orderStatus($request->status);
        return view('admin.order.index', compact('orders', 'status'));
    }

    public function create(){
        $users = User::select('id', 'fullname')->whereRole(collect(config('mevivu.role.user'))->keys()->all()[1])->orderBy('id', 'DESC')->get();
        $products = Product::select('id', 'name')->whereStatus(1)->orderBy('id', 'DESC')->get();
        return view('admin.order.create', compact('users', 'products'));
    }

    public function edit(Order $order){
        $users = User::select('id', 'fullname')->whereRole(collect(config('mevivu.role.user'))->keys()->all()[1])->orderBy('id', 'DESC')->get();

        $order = $order->load(['details:order_id,name,price,option,quantity,quantity_item,unit']);
        return view('admin.order.edit', compact('order', 'users'));
    }
    public function store(OrderRequest $request){
        $data = $request->all();
        $total = 0;
        $order = Order::create(['user_id' => $data['user_id'], 'status' => $data['status'], 'total' => $total]);
        foreach ($data['product_id'] as $key => $value) {
            $product = Product::select('name', 'price', 'quantity', 'unit')->whereId($value)->first();
            $data_create = [
                'name' => $product->name,
                'price' => isset($data['price'][$key]) ? $data['price'][$key] : $product->price,
                'quantity' => isset($data['quantity'][$key]) ? $data['quantity'][$key] : 1,
                'quantity_item' => $product->quantity,
                'unit' => $product->unit

            ];
            $data_create['option'] = $data_create['price'] > $product->price ? 'L' : 'M';
            $order->details()->create($data_create);

            $total += (isset($data['price'][$key]) ? $data['price'][$key] : $product->price) * (isset($data['quantity'][$key]) ? $data['quantity'][$key] : 1);
        }
        $order->update(['total' => $total]);
        return redirect()->route('edit.order', $order->id)->with('success', 'T???o ????n h??ng th??nh c??ng');
    }
    public function update(OrderRequest $request){
        $order = Order::find($request->id);
        $data = $request->only('user_id', 'status');
        $order->update($data);
        return back()->with('success', 'C???p nh???t th??nh c??ng');
    }

    public function updateStatus(Order $order, $status){
        if(!in_array($status, [0,1,2])){
            return back()->with('error', 'C???p nh???t kh??ng th??nh c??ng');
        }
        $order->update(['status' => $status]);
        return back()->with('success', 'C???p nh???t th??nh c??ng');
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
