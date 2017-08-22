<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAcadmic extends Model
{
    protected $fillable = [
        'section_id','course_id','asession_id','roll_no','student_id',
    ];

    protected $table = 'student_acadmics';


     public function students()
    {
    	return $this->belongsTo(Student::Class,'student_id');
    }

    public function courses()
    {
        return $this->belongsTo(Course::Class,'course_id');
    }

     public function sections()
    {
    	return $this->belongsTo(Section::Class,'section_id');
    }

    public function asessions()
    {
      return $this->belongsTo(Asession::Class,'asession_id');
    }
}
