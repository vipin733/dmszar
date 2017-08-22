<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherAcadmic extends Model
{
    protected $fillable = [
        'section_id', 'course_id','asession_id'
    ];

     public function teachers()
    {
    	return $this->belongsTo(Teacher::Class,'teacher_id');
    }

     public function sections()
    {
    	return $this->belongsTo(Section::Class,'section_id');
    }

     public function courses()
    {
    	return $this->belongsTo(Course::Class,'course_id');
    }

    public function asessions()
    {
      return $this->belongsTo(Asession::Class,'asession_id');
    }
}
