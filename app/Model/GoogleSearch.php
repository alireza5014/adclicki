<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoogleSearch extends Model
{
    protected $fillable = ['page_number', 'keyword','ads_id'];

    public function ads()
    {
        $this->belongsTo(Ads::class);
    }
}
