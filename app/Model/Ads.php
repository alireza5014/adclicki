<?php

namespace App\Model;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{


    protected $fillable=['user_id','title','link','daily_click','image_path','type','status','type'];

    public function visited_websites()
    {
        return $this->hasMany(VisitedWebsite::class);
    }

    public function view_request()
    {
        return $this->hasOne(ViewRequest::class);
    }
    public function visited_links()
    {
        return $this->hasMany(VisitedLink::class);
    }

    public function visited_links_today()
    {
        return $this->hasMany(VisitedLink::class);
    }

    public function google_search()
    {
        return $this->hasOne(GoogleSearch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getCreatedAtAttribute($value)
    {

        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
    }
}
