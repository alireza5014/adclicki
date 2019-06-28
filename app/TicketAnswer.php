<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TicketAnswer extends Model
{
    protected $table="tickets_answers";
    public function getCreatedAtAttribute($value)
    {

        return  Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
    }


    public  function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    protected $fillable=['sender_type','message','ticket_id','ip','image_path'];

}
