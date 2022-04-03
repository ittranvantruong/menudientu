<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Http\Requests\CartRequest;


class ShoppingCartController extends Controller
{
    //

    public function index(){
        // Cart::clear();
        $cartItems = Cart::getContent();
        // dd($cartItems->total());
        return view('cart', compact('cartItems'));
    }

    public function getProduct(Product $product){

        $html = '<option value="M">M - '.$product->price.'</option>';
        if($product->price_large != null){ 
            $html .= '<option value="L">L - '.$product->price_large.'</option>';
        }
        return response()->json([
            'id' => $product->id,
            'html' => $html
        ]);
    }

    public function store(CartRequest $request){
        $data = $request->all();
        $product = Product::find($data['id']);
        $price = $data['size'] == 'M' ? $product->price : $product->price_large;
        $array = [
            'id' => time(),
            'name' => $product->name,
            'price' => $price,
            'quantity' => $data['quantity'],
            'attributes' => [
                'size' => $data['size'],
                'product_id' => $product->id,
                'avatar' => $product->avatar,
                'price' => $product->price,
                'price_large' => $product->price_large,
                'quantity_item' => $product->quantity,
                'unit' => $product->unit
            ]
        ];
        $cartItem = Cart::add($array);
        return true;
    }

    public function update(CartRequest $request){
        $data = $request->all();
        $item = Cart::get($data['id']);
        // dd($item);
        $price = $data['size'] == 'M' ? $item->attributes->price : $item->attributes->price_large;
        
        $array = [
            'price' => $price,
            'quantity' => [
                'relative' => false,
                'value' => $data['quantity']
            ],
            'attributes' => [
                'size' => $data['size'],
                'product_id' => $item->attributes->product_id,
                'avatar' => $item->attributes->avatar,
                'price' => $item->attributes->price,
                'price_large' => $item->attributes->price_large,
                'quantity_item' => $item->attributes->quantity,
                'unit' => $item->attributes->unit,

            ]
        ];
        Cart::update($item->id, $array);
        return true;
    }

    public function delete($cart){
        Cart::remove($cart);
        return true;
    }
}
