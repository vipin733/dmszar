<?php

namespace App\Model\Teacher\Student;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Asession;
use App\Section;
use App\Teacher;
use App\Course;
use App\Subject;
use Auth;

class StudentHomeWork extends Model
{
    
     protected $fillable = [

         'course_id','section_id','subject_id', 'asession_id','submit_at','homework','remarks'

    ];

    protected $dates = ['submit_at'];

     public function setSubmitAtAttribute($value)
    {
        $this->attributes['submit_at'] = Carbon::createFromFormat('d/m/Y h:i A',$value);
    }

     public function teachers()
    {
    	return $this->belongsTo(Teacher::Class,'teacher_id');
    }

     public function courses()
    {
        return $this->belongsTo(Course::Class,'course_id');
    }

     public function sections()
    {
    	return $this->belongsTo(Section::Class,'section_id');
    }

     public function subjects()
    {
        return $this->belongsTo(Subject::Class,'subject_id');
    }

    public function asessions()
    {
      return $this->belongsTo(Asession::Class,'asession_id');
    }

    // public function scopeFilter($filterQuery, StudentHomeWorkFilter $studenthomeworkfilter)
    // {
    //     $studenthomeworkfilter->apply($filterQuery);
    // }

    public function scopeFilter($filterQuery, Request $request)
    {
        if ($request->course) {
           $filterQuery->where('course_id',$request->course);
        }

        if ($request->section) {
           $filterQuery->where('section_id',$request->section);
        }

        if ($request->subject) {
           $filterQuery->where('subject_id',$request->subject);
        }

        if ($request->session) {
           $filterQuery->where('asession_id',$request->session);
        }

        return $filterQuery;
    }

}
