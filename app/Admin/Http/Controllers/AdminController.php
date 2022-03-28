<?php

namespace App\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Http\Requests\AdminLoginRquest;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminController extends Controller
{
    //
    public function login(){
        // Admin::create([
        //     'name' => 'admin',
        //     'password' => bcrypt('@admin@123')
        // ]);
        if(auth()->guard('admin')->check()){
            return redirect()->route('admin.index');
        }
        return view('admin.login');
    }

    public function postLogin(AdminLoginRquest $request){

        if(Auth::guard('admin')->attempt($request->only('name', 'password'))){
            if(session()->has('url-redirect')){
                $url = session()->get('url-redirect');
                session()->forget('url-redirect');
                return redirect($url)->with('success', 'Bạn đã đăng nhập thành công');
            }
            return redirect()->route('admin.index')->with('success', 'Bạn đã đăng nhập thành công');
        }
        
        return back()->with('error', 'Tên đăng nhập hoặc mật khẩu không đúng');
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất thành công');
    }
}
