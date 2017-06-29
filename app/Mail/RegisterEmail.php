<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $user;
    /**
     * Create a new message instance.
     *
     * @var 用户对象
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirm')
                    ->subject('欢迎来到泊学论坛，请确认你的邮箱');
    }
}
