<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
     protected $fillable = [
        'name','remarks'
    ];

       public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
