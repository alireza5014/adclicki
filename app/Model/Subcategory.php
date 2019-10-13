<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['user_id', 'referrer_id', 'price', 'refresh_count', 'expire_date'];


    public function user()
    {
        return $this->belongsTo(User::class,'referrer_id','id');

    }

    public function visited_links()
    {
        return $this->hasMany(VisitedLink::class,'visited_id','referrer_id');

    }
}
