<?php

namespace App\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Admin\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    //
    public function index(){
        $category = Category::select('id', 'name', 'status', 'sort', 'type')->orderBy('sort', 'ASC')->get();
        return view('admin.category.index', compact('category'));
    }

    public function edit(Category $category){
        return $category->only('id', 'name', 'status', 'sort', 'type');
    }

    public function store(CategoryRequest $request){
        $data = $request->only(['name', 'status', 'sort']);
        $data['type'] = $request->whenFilled('type', function() use ($data){
            return true;
        }, function() use ($data){
            return false;
        });
        $category = Category::create($data);
        $type = 'category';
        $render = view('admin.render.all')->with('type', $type)->with('item', $category)->render();
        return response()->json([
            'status' => 200,
            'message' => 'Thêm danh mục thành công',
            'data' => $render
        ], 200);
    }

    public function update(CategoryRequest $request){
        $data = $request->only(['name', 'status', 'sort']);
        $data['type'] = $request->whenFilled('type', function() use ($data){
            return true;
        }, function() use ($data){
            return false;
        });
        $category = Category::find($request->id);
        $category->update($data);
        $type = 'category';
        $render = view('admin.render.all')->with('type', $type)->with('item', $category)->render();
        return response()->json([
            'status' => 200,
            'message' => 'Sửa danh mục thành công',
            'replace' => $category->id,
            'data' => $render
        ], 200);
    }

    public function delete(Category $category){
        if($category->id != 1){
            $category->delete();
        }
        return response()->json([
            'status' => 200,
            'message' => 'Thực hiện thành công'
        ], 200);
    }

    public function multiple(Request $request){
        // dd($request);
        if (!$request->filled('action') || !$request->filled('id') || in_array(1, $request->id) || !in_array($request->action, ['show', 'hidden', 'delete'])) {
            return back()->with('error', 'Thực hiện không thành công');
        }
        switch ($request->action) { 
            case 'show': 
                Category::whereIn('id', $request->id)->update(['status' => 1]);
            break; 
            case 'hidden': 
                Category::whereIn('id', $request->id)->update(['status' => 0]);
            break;
            case 'delete': 
                foreach($request->id as $value){
                    Category::find($value)->delete();
                }
            break; 
            default:
                return back()->with('error', 'Thực hiện không thành công');
                
        }
        return back()->with('success', 'Thực hiện thành công');

    }
}
