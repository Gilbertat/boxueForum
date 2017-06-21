<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['user_id', 'voteT_id', 'voteT_type'];

    protected $table = 'votes';

    public function voteT()
    {
        return $this->morphTo();
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }


}
