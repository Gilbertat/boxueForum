<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{

    public function __construct() {
        $this->middleware('guest', [
           'only' => ['create']
        ]);
    }

    /* 登录 */
    public function create() {
        return view('sessions.create');
    }

/*登录认证*/
    public function store(Request $request) {
        $this->validate($request, [
           'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            if (Auth::user()->activated) {
                session()->flash('success', '欢迎回来!');
                return redirect()->intended(route('users.show', [Auth::user()]));
            } else {
                Auth::logout();
                session()->flash('warning', '您的帐号尚未激活，请点击邮箱中的注册邮件进行激活。');
                return redirect('/');
            }
        } else {
            session()->flash('danger', '用户名或密码错误，请重试!');
            return redirect()->back();
        }
    }

    public function destroy() {
        Auth::logout();
        session()->flash('success', '您已成功退出');
        return redirect('login');
    }

}
