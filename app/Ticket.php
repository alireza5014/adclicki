<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'subject', 'message', 'ticket_id','ip','status','image_path','user_id','seen'
    ];

    public function getCreatedAtAttribute($value)
    {

        return  Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
    }

    public  function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public  function tickets_answers()
    {
        return $this->hasMany(TicketAnswer::class,'ticket_id','id');
    }



    public function scopeGetTicket($query, $status)
    {

        if ($status!='all') {
            $query->where(function ($query) use ($status) {
                $query->where("status", $status)   ;
            });
        }

        return $query;
    }


}
