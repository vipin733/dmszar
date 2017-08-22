<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
  

    protected $fillable = [
        'user_id','student_id', 'teacher_id','by_teacher_id', 'by_owner_id','message'
    ];

      public function owner()
    {
        return $this->belongsTo(User::Class,'user_id');
    }

     public function byowner()
    {
        return $this->belongsTo(User::Class,'by_owner_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::Class,'student_id');
    }

     public function teachers()
    {
        return $this->belongsTo(Teacher::Class,'teacher_id');
    }

     public function byteacher()
    {
        return $this->belongsTo(Teacher::Class,'by_teacher_id');
    }

}
