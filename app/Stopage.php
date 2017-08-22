<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Model\Staff\Add\BusDetail;

class Stopage extends Model
{
   protected $fillable = [
        'name','bus_id','remarks'
    ];

     public function transportFee()
    {
        return $this->hasOne(TransportFee::Class);
    }

     public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }


     public function buses()
    {
        return $this->belongsTo(BusDetail::class,'bus_id');
    }

    public function transportfeecollections()
    {
        return $this->hasMany(TransportFeeCollection::Class,'stopage_id');
    }
}
