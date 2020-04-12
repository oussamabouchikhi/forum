<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Channel;
class Discussion extends Model
{
    protected $fillable = ['title', 'content', 'user_id', 'channel_id', 'slug' ];

    public function user() {
        # This Discussion belongs to one user
        return $this->belongsTo(User::class);
    }

    public function channel() {
        # This Discussion belongs to one Channel
        return $this->belongsTo(Channel::class);
    }

}
