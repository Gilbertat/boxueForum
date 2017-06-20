<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    protected $fillable = [
        'title',
        'content_raw',
        'content_html',
        'slug',
        'user_id',
        'category_id',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reply()
    {
        return $this->hasMany(Reply::class);
    }


    public function lastReplyUser()
    {
        return $this->belongsTo(User::class, 'last_reply_user_id');
    }



}
