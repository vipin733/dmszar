<?php

namespace App\Model\Staff\Acadmic;

use Illuminate\Database\Eloquent\Model;
use App\Model\Staff\Acadmic\TimeTable;
use Carbon\Carbon;
use App\Model\Day;
use App\Subject;
use App\Teacher;
use App\User;
use App\Course;
use App\Section;
use App\Asession;

class TimeTable extends Model
{
 
   // protected $fillable = [
   //     'start','end','subject_id','teacher_id','asession_id','section_id','course_id','room_id','remarks','day_id'
   //  ];
   //   //'break_start','break_end',
   //   protected $dates = ['break_start','break_end','start','end'];

   //   public function setBreakStartAttribute($value)
   //  {
        
   //      $this->attributes['break_start'] = Carbon::createFromFormat('h:i A',$value);
   //  }

   //  public function setBreakEndAttribute($value)
   //  {
         
   //      $this->attributes['break_end'] = Carbon::createFromFormat('h:i A',$value);
   //  }


    protected $fillable = [
       'start','end','asession_id','section_id','course_id','sunday_subject_id','sunday_teacher_id','monday_subject_id','monday_teacher_id','tuesday_subject_id','tuesday_teacher_id','wednesday_subject_id','wednesday_teacher_id','thursday_subject_id','thursday_teacher_id','friday_subject_id','friday_teacher_id','saturday_subject_id','saturday_teacher_id','sunday_remarks', 'monday_remarks' ,'tuesday_remarks','wednesday_remarks' ,'thursday_remarks' ,'friday_remarks', 'saturday_remarks'
    ];
     //'break_start','break_end',
     protected $dates = ['start','end'];


     public function setStartAttribute($value)
    {
        
        $this->attributes['start'] = Carbon::createFromFormat('g:i A',$value);
    }

    public function setEndAttribute($value)
    {
         
        $this->attributes['end'] = Carbon::createFromFormat('g:i A',$value);
    }

    // public function days()
    // {
    //     return $this->belongsTo(Day::class,'day_id');
    // }

    public function sundaysubjects()
    {
        return $this->belongsTo(Subject::class,'sunday_subject_id');
    }

    public function sundayteachers()
    {
        return $this->belongsTo(Teacher::class,'sunday_teacher_id');
    }

    public function mondaysubjects()
    {
        return $this->belongsTo(Subject::class,'monday_subject_id');
    }

    public function mondayteachers()
    {
        return $this->belongsTo(Teacher::class,'monday_teacher_id');
    }

    public function tuesdaysubjects()
    {
        return $this->belongsTo(Subject::class,'tuesday_subject_id');
    }

    public function tuesdayteachers()
    {
        return $this->belongsTo(Teacher::class,'tuesday_teacher_id');
    }

    public function wednesdaysubjects()
    {
        return $this->belongsTo(Subject::class,'wednesday_subject_id');
    }

    public function wednesdayteachers()
    {
        return $this->belongsTo(Teacher::class,'wednesday_teacher_id');
    }

    public function thursdaysubjects()
    {
        return $this->belongsTo(Subject::class,'thursday_subject_id');
    }

    public function thursdayteachers()
    {
        return $this->belongsTo(Teacher::class,'thursday_teacher_id');
    }

    public function fridaysubjects()
    {
        return $this->belongsTo(Subject::class,'friday_subject_id');
    }

    public function fridayteachers()
    {
        return $this->belongsTo(Teacher::class,'friday_teacher_id');
    }

    public function saturdaysubjects()
    {
        return $this->belongsTo(Subject::class,'saturday_subject_id');
    }

    public function saturdayteachers()
    {
        return $this->belongsTo(Teacher::class,'saturday_teacher_id');
    }



    public function sections()
    {
        return $this->belongsTo(Section::class,'section_id');
    }

    public function courses()
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    public function asessions()
    {
        return $this->belongsTo(Asession::class,'asession_id');
    }

     public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
