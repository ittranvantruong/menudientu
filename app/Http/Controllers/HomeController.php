<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    public function userLogin($name){

        if(Auth::attempt(['name' => $name, 'password' => config("mevivu.default-password")])){

            return redirect()->route('home')->with('success', 'Chào mừng bạn đến với nhà hàng !');
        }
        return redirect()->route('login');
    }
    public function index(){
        $categories = Category::select('id', 'name', 'type')->with('product:id,category_id,name,price,price_large,quantity,unit,avatar,desc')->get();
        return view('index',compact('categories'));
    }

    
}
