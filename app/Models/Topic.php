<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Topic extends Model
{
    use SearchableTrait;

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

    /* search */
    protected $searchable = [
      'columns' => [
          'topics.title' => 10,
          'topics.content_raw' => 5,
      ],
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

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteT');
    }


    public function lastReplyUser()
    {
        return $this->belongsTo(User::class, 'last_reply_user_id');
    }



}
