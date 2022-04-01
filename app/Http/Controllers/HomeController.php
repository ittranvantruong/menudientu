<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Admin\Http\Requests\ProductRequest;


class HomeController extends Controller
{
    public function index(){
        $categories = Category::select('id', 'name', 'type')->with('product:id,category_id,name,price,price_large,quantity,unit,avatar,desc')->get();
        return view('index',compact('categories'));
    }

    public function cart(){
        return view('cart');
    }
}
