<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Topic;
use boxue\Handler\Exception\ImageUploadException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['edit', 'update', 'editPassword', 'updatePassword', 'editAvatar', 'updateAvatar']
        ]);

        $this->middleware('guest', [
           'only' => ['create']
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    // 根据id查询用户
    public function show($id)
    {
        $user = User::findOrFail($id);
        $topics = User::find($id)->topic()->orderBy('updated_at', 'desc')->paginate(15);
        return view('users.show', compact('user', 'topics'));
    }

    // 用户资料入库,并自动登录
    public function store (StoreUserRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'name' => $request->nickname,
            'password' => bcrypt($request->password),
        ]);

        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已经发送到您的注册邮箱上，请注意查收。');
        return redirect('/');
    }

    // 发送邮件
    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'shiyue45457@gmail.com';
        $name = 'boxueForum';
        $to = $user->email;
        $subject = '欢迎来到泊学论坛，请确认你的邮箱';

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

    // 根据邮件激活对应账号
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->avatar = 'default_avatar.jpg';
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜您，账号激活成功!');
        return redirect()->route('users.show', [$user]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nickname' => 'required|max:10',
        ]);
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        $user->update([
            'name' => $request->nickname,
            'city' => $request->city,
        ]);
        session()->flash('success', '个人资料更新成功!');
        return redirect()->route('users.show', $id);
    }

    public function editPassword($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        return view('users.edit_password', compact('user'));
    }

    public function updatePassword($id, Request $request)
    {
        $this->validate($request, [
           'password' => 'required|confirmed'
        ]);
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        $user->update([
           'password' => bcrypt($request->password),
        ]);

        session()->flash('success', '密码修改成功!');
        return redirect()->route('login', $id);
    }

    /*修改头像*/
    public function editAvatar($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        return view('users.edit_avatar', compact('user'));
    }

    public function updateAvatar($id, Request $request)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        if ($file = $request->file('avatar')) {
            try {
                $user->updateAvatar($file);
                session()->flash('success','上传头像成功');
            } catch (ImageUploadException $exception) {
                session()->flash('errors', error($exception->getMessage()));
            }
        } else {
            session()->flash('errors','上传头像失败');
        }

        return redirect(route('users.edit_avatar', $id));
    }

    public function topic($id)
    {
        $user = User::findOrFail($id);
        $topics = User::find($id)->topic()->orderBy('updated_at', 'desc')->paginate(15);

        return view('users.topics', compact('user', 'topics'));
    }

    public function all()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function fame()
    {
        $topics = Topic::where('vote_count', '>', 0)
                        ->orderBy('vote_count', 'desc')
                        ->get();
    }


    public function followers($id)
    {
        $user = User::findOrFail($id);
        $users = $user->followers()->paginate(15);
        return view('users.followers', compact('user','users'));
    }

}
