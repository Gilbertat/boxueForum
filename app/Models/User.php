<?php

namespace App\Models;


use App\Jobs\SendResetPasswordEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;
use Laracasts\Presenter\PresentableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable
{
    use Notifiable;
    use Traits\AvatarHelper;
    use PresentableTrait;
    use SearchableTrait;


    /* table name */

    protected $table = 'users';

    protected $presenter = 'boxue\Presenters\UserPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image_url',
        'topic_count',
        'reply_count',
        'follower_count',
        'message_count',
        'city',
        'last_activied_at',
    ];

    /**
     * Searchable rules.
     *
     * @var array
     *
     */

    protected $searchable = [
       'columns' => [
           'users.name' => 10,
       ],
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
           $user->activation_token = str_random(30);
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    // 发起的讨论
    public function topic()
    {
        return $this->hasMany(Topic::class);
    }

    public function reply()
    {
        return $this->hasMany(Reply::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    public function follow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }

    public function unfollow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }



    // 获取用户头像
//    public function gravatar($size = '100') {
//        $hash = md5(strtolower(trim($this->attributes['email'])));
//        return "http://www.gravatar.com/avatar/$hash?s=$size";
//    }
}
