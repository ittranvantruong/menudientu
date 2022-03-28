<?php

namespace App\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index(Request $request){
        $users = $request->whenFilled('role', function ($input) {
            return User::select('id', 'name', 'fullname')->whereRole($input)->get();
        }, function () {
            return User::select('id', 'name', 'fullname')->get();
        });
        return view('admin.user.index', compact('users'));
    }
    public function create(){
        return view('admin.user.create');
    }
    public function store(UserRequest $request) {
        $data = $request->only('name', 'fullname');
        $data['password'] = bcrypt(config('mevivu.default-password'));
        $user = User::create($data);
        return redirect()->route('edit.user', $user->id);
    }

    public function edit(User $user){
        return view('admin.user.edit', compact('user'));
    }

    public function update(UserRequest $request) {
        $data = $request->only('name', 'fullname');
        $user = User::find($request->id)->update($data);
        return back()->with('success', 'Thực hiện thành công');
    }
    
    public function delete(Request $request, User $user){

        $user->delete();
        return redirect()->route('index.user', ['role' => $user->role])->with('success', 'Xóa thành công');
    }
}
