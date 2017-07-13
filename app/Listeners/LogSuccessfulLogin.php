<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;


class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if ($event->user->activated) {
            Flash::success('欢迎回来!');
        } else {
            Auth::logout();
            Flash::warning('您的帐号尚未激活，请点击邮箱中的注册邮件进行激活。');
        }
    }
}
