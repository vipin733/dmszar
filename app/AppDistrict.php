<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppDistrict extends Model
{
    protected $fillable = [
        'state_id','name'
    ];

    public function states()
    {
        return $this->belongsTo(State::class,'state_id');
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
}
