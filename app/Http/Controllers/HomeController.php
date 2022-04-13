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

            return redirect()->route('home')->with('success', 'Welcome to the restaurant');
        }
        return redirect()->route('login');
    }
    public function index(){
        $categories = Category::select('id', 'name', 'type')->whereStatus(1)
        ->with('product:id,category_id,name,price,price_large,quantity,unit,avatar,desc')
        ->orderBy('sort', 'ASC')->get();
        return view('index',compact('categories'));
    }

    
}
