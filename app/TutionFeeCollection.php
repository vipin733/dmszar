<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TutionFeeCollection extends Model
{
   protected $fillable = [
        'tution_fee','other_fee','month','reciept_no','remarks','late_fee','course_id','taker_id','asession_id','active','deleted_at','deleted_by_id','completed'
    ];

    protected $dates = ['month','deleted_at'];

     public function setMonthAttribute($value)
    {
         //dd($value);
        $this->attributes['month'] = Carbon::createFromFormat('m',$value);
    }

      public function students()
    {
    	return $this->belongsTo(Student::Class,'student_id');
    }

    public function courses()
    {
        return $this->belongsTo(Course::Class,'course_id');
    }

     public function takers()
    {
      return $this->belongsTo(Teacher::Class,'taker_id');
    }

    public function asessions()
    {
      return $this->belongsTo(Asession::Class,'asession_id');
    }

      public function deletedby()
    {
      return $this->belongsTo(Teacher::Class,'deleted_by_id');
    }
}
