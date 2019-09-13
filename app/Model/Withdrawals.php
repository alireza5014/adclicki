<?php

namespace App\Model;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Withdrawals extends Model
{
 protected $fillable=['price','user_id','description','is_pay','is_verify','code','image_path'];
    public function getCreatedAtAttribute($value)
    {

        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {

        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
    }



    public function referrers()
    {
        return $this->hasMany(User::class, 'referer_id', 'user_id');
    }


    public function user()
    {
      return $this->belongsTo(User::class,'user_id','id');
    }
}
