<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarkSheetRequest extends Model
{
   protected $fillable = [
        
        'ticket_no','course_id','asession_id','updated_by_id','description','remarks','status'
    ];


    public function courses()
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function updated_by()
    {
        return $this->belongsTo(Teacher::class,'updated_by_id');
    }

    public function asessions()
    {
      return $this->belongsTo(Asession::Class,'asession_id');
    }
}
