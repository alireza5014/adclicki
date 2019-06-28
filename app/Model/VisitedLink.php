<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class VisitedLink extends Model
{


    protected $fillable=['id','referer_price','visited_id','view_request_id','price','ads_id','type','ip','os','browser'];

    public function user()
    {
        return $this->belongsTo(User::class,'id','visited_id');
    }

    public function view_request()
    {
        return $this->belongsTo(ViewRequest::class);
    }

    public function ad()
    {
        return $this->belongsTo(Ads::class);
    }

}
