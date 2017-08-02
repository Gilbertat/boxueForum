<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateUserRequest;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use Hash;
use App\Jobs\SendConfirmEmail;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
    }

    public function register(StoreUserRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'name' => $request->nickname,
            'password' => bcrypt($request->password),
        ]);

        $job = (new SendConfirmEmail($user))->delay(5);
        dispatch($job);

        return response()
            ->json([
                'registered' => true
            ]);
    }

    public function login(ValidateUserRequest $request)
    {
        $user = User::query()->where('email', $request->email)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $user->api_token = str_random(60);
            $user->save();

            return response()
                ->json([
                    'authenticated' => true,
                    'api_token' => $user->api_token,
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'user_avatar' => $user->present()->gravatar,
                ]);
        }

        return response()
            ->json([
                'email' => ['邮箱或密码输入错误，请重试!']
            ], 422);

    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->api_token = null;
        $user->save();

        return response()
            ->json([
                'done' => true,
            ]);
    }


}
