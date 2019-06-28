<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ViewRequest extends Model
{

    protected $fillable=['user_id','ads_id','count','status'];
     public function visited_links()
    {
        return $this->hasMany(VisitedLink::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ad()
    {
        return $this->belongsTo(Ads::class,'ads_id','id');
    }

    public function visited_websites()
    {
        return $this->hasMany(VisitedWebsite::class);
    }
}
