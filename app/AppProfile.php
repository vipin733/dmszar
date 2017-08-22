<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppProfile extends Model
{
   protected $fillable = [
        'user_id','app_name','reg_prefix_student','reg_prefix_teacher'
    ];

    
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

     public function getAppNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getRegPrefixStudentAttribute($value)
    {
        return strtoupper($value);
    }

    public function getRegPrefixTeacherAttribute($value)
    {
        return strtoupper($value);
    }


    
}
