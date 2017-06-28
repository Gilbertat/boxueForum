<?php

namespace App\Listeners;

use App\Events\WelcomeEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeEmailEventListener
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
     * @param  WelcomeEmail  $event
     * @return void
     */
    public function handle(WelcomeEmail $event)
    {
        $user = $event->user;

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
}
