<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TempPayment extends Model
{
   protected $fillable=['ref_number','res_number','user_id','price'];
}
