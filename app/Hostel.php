<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
     protected $fillable = [
        'name','remarks'
    ];

    
     public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function hostelfee()
    {
        return $this->hasOne(HostelFee::Class);
    }

}
