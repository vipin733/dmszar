<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    
     protected $fillable = [
        'name','remarks'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class,'course_subject')->withTimestamps();
    }

     public function teachers()
    {
        return $this->belongsToMany(Teacher::class,'subject_teacher')->withTimestamps();
    }

    
    public function testmarks()
    {
        return $this->hasMany(TestMark::Class,'subject_id');
    }

     public function users()
    {
        return $this->hasMany(User::Class,'user_id');
    }

    public function exammarks()
    {
        return $this->hasMany(ExamMark::Class,'subject_id');
    }
}
