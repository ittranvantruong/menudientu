<?php

namespace App\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminHomeController extends Controller
{
    //
    public function index(){
        $categories = Category::select('id', 'name', 'type')->with('product:id,category_id,name,price,price_large,quantity,unit,avatar,desc')->get();
        return view('admin.index');
    }
}
