<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VisitedWebsite extends Model
{
    protected $fillable = ['website_id', 'view_request_id', 'ads_id', 'type', 'price', 'referrer_price', 'ip', 'os', 'browser'];

    public function website()
    {
       return $this->belongsTo(Website::class);
    }
    public function ad()
    {
       return $this->belongsTo(Ads::class);
    }

    public function view_request()
    {
       return $this->belongsTo(ViewRequest::class);
    }

}
