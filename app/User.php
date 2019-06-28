<?php

namespace App;

use App\Model\Ads;

use App\Model\Message;
use App\Model\Notification;
use App\Model\Payment;
use App\Model\ViewRequest;
use App\Model\VisitedLink;
use App\Model\Withdrawals;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
        [
            'fname',
            'lname',
            'mobile',
            'email',
            'ip',
            'referer_id',
            'code_melli',
            'password',
            'address',
            'image_path',
            'type',
            'activity_type',
            'device',
            'is_admin',
            'is_active',
            'bank_name',
            'card_number',
            'shaba_number',
            'country',
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function messages()
    {
        return $this->belongsToMany(Message::class);
    }


    public function notification()
    {
        return $this->hasOne(Notification::class);
    }

    public function referers()
    {
        return $this->hasMany(User::class, 'referer_id', 'id');
    }

    public function r_visited_link()
    {
        return $this->hasOne(VisitedLink::class, 'visited_id', 'id');
    }



    public function r_visited_price()
    {
        return $this->hasOne(VisitedLink::class, 'visited_id', 'id')->where('price','>',0);
    }

    public function r_visited_referer_price()
    {
        return $this->hasOne(VisitedLink::class, 'visited_id', 'id')->where('referer_price','>',0);;
    }



    public function scopeSearchByKeyword($query, $keyword)
    {

        if ($keyword != '') {
          $query->where(function ($q) use ($keyword) {
                 $q->where("lname", "LIKE", "%$keyword%")
                    ->orWhere("fname", "LIKE", "%$keyword%")
                    ->orWhere("referer_id", "=", $keyword)
                    ->orWhere("email", "LIKE", "%$keyword%")
                    ->orWhere("code_melli", "LIKE", "%$keyword%");
            });
        }

        return $query;
    }


    public function addNew($input)

    {

        $check = static::where('google_id', $input['google_id'])->first();


        if (is_null($check)) {

            return static::create($input);

        }


        return $check;

    }


    public function ads()
    {
        return $this->hasMany(Ads::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function view_requests()
    {
        return $this->hasMany(ViewRequest::class);
    }

    public function visited_links()
    {
        return $this->hasMany(VisitedLink::class, 'visited_id', 'id');
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawals::class);
    }


}





