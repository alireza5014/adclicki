<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $fillable = ['user_id', 'login', 'register_referer','ticket'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
