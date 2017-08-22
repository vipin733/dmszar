<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ExamMark extends Model
{
    protected $fillable = [
        
        'asession_id','taker_id','exam_id','course_id','section_id','student_id','subject_id','max_mark','score_mark','date'
    ];

    protected $dates = ['date'];

     public function setDateAttribute($value)
    {
        
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y',$value);
    }

    public function teachers()
    {
        return $this->belongsTo(Teacher::class,'taker_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }

    public function examnames()
    {
        return $this->belongsTo(ExamName::class,'exam_id');
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
