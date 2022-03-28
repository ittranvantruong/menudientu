<?php

namespace App\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Admin\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    //

    public function index(){
        $products = Product::select('id', 'name', 'price', 'price_large', 'quantity', 'unit', 'status')->orderBy('id', 'DESC')->get();
        return view('admin.product.index', compact('products'));
    }
    public function create(){
        $category = Category::select('id', 'name')->whereStatus(1)->orderBy('sort', 'DESC')->get();
        return view('admin.product.create', compact('category'));
    }

    public function edit(Product $product){
        $category = Category::select('id', 'name')->whereStatus(1)->orderBy('sort', 'DESC')->get();

        $product = (object) $product->only(['id', 'name', 'status', 'price', 'price_large', 'quantity', 'unit', 'detail', 'desc', 'category_id', 'avatar']);
        return view('admin.product.edit', compact('product', 'category'));
    }

    public function store(ProductRequest $request){
        $data = $request->only(['name', 'status', 'price', 'price_large', 'quantity', 'unit', 'desc', 'category_id', 'avatar']);
        $product = Product::create($data);
        return redirect()->route('edit.product', $product->id)->with('success', 'Thêm món ăn thành công');  
    }

    public function update(ProductRequest $request){
        $data = $request->only(['name', 'status', 'price', 'price_large', 'quantity', 'unit', 'desc', 'category_id', 'avatar']);
        Product::find($request->id)->update($data);
        return back()->with('success', 'Sửa món ăn thành công');  
    }

    public function delete(Product $product){
        $product->delete();
        return redirect()->route('index.product')->with('success', 'Xóa thành công');
    }
    public function multiple(Request $request){
        // dd($request);

        if (!$request->filled('action') || !$request->filled('id') || !in_array($request->action, ['show', 'hidden', 'delete'])) {
            return back()->with('error', 'Thực hiện không thành công');
        }
        switch ($request->action) { 
            case 'show': 
                Product::whereIn('id', $request->id)->update(['status' => 1]);
            break; 
            case 'hidden': 
                Product::whereIn('id', $request->id)->update(['status' => 0]);
            break;
            case 'delete': 
                Product::whereIn('id', $request->id)->delete();

            break; 
            default:
                return back()->with('error', 'Thực hiện không thành công');
                
        }
        return back()->with('success', 'Thực hiện thành công');

    }
}
