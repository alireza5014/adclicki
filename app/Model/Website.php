<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Website extends Authenticatable
{
    protected $fillable = ['user_id', 'url', 'type', 'status'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function visited_websites()
    {
        return $this->hasMany(VisitedWebsite::class);
    }
    public function visited_website()
    {
        return $this->hasOne(VisitedWebsite::class);
    }


}
