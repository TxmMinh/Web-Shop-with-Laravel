<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.users.login', [
            'title' => 'Đăng nhập hệ thống'
        ]);
    }

    public function store(Request $request) //Request giúp nhận toàn bộ thông tin gừi lên Server
    {
        // $name = $request->input('password');
        // echo $name;
        // dd($request->input());

        $messages = [
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ];

        //Validate form (Dùng kiểm tra các giá trị nhập từ các thành phần của form)
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => ['required', Password::min(6)],
        ], $messages);

        if (Auth::attempt([ //Kiểm tra account (check in users table) -> return true or false
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            // 'level' => 1,
        ], $request->input('remember'))) {
            return redirect()->route('admin');
        }

        //Tạo thông báo lỗi
        Session::flash('error', 'Email hoặc Password không đúng');

        return redirect()->back();
    }
}
