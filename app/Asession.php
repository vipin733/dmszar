<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asession extends Model
{
    protected $fillable = [
        'name','active','remarks'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function studentacadmic()
    {
        return $this->hasMany(StudentAcadmic::Class);
    }

    public function isActive()
    {
        if ($this->active) {
           return true;
        }

         return false;
    }
}
