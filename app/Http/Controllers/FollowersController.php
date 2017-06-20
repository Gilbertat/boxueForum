<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    function __construct()
    {
        $this->middleware('auth', [
           'store', 'destroy'
        ]);
    }

    /* 用户关注 */
    public function store($id)
    {
        $user = User::findOrFail($id);
        if (Auth::user()->id === $user->id) {
            return redirect('/');
        }
        if (! Auth::user()->isFollowing($id)) {
            Auth::user()->follow($id);
            $user->increment('follower_count');
        }

        return redirect()->route('users.show', $id);
    }

    /* 取消关注 */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->id === $user->id) {
            return redirect('/');
        }

        if (Auth::user()->isFollowing($id)) {
            Auth::user()->unfollow($id);
            $user->decrement('follower_count');
        }

        return redirect()->route('users.show', $id);
    }
}
