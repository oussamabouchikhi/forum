<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class SocialAccount extends Model
{
    protected $fillable = [
        'provider_name', 'provider_is'
    ];

    public function user()
    {
        # This SocialAccount belongs to one user
        return $this->belongsTo(App::class);
    }
    
}
