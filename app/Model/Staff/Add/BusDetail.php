<?php

namespace App\Model\Staff\Add;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Teacher;
use App\Stopage;

class BusDetail extends Model
{
    protected $fillable = [
       'name','driver_id','bus_no','remarks'
    ];


     public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function drivers()
    {
        return $this->belongsTo(Teacher::class,'driver_id');
    }

    public function stopages()
    {
        return $this->hasMany(Stopage::Class,'bus_id');
    }
}
