<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Teacher_Staff_Attendence extends Model
{
   
   protected $fillable = [
        'teacher_id', 'date','marked','asession_id','entry_time','leave_time'
    ];

   protected $dates = ['date','entry_time','leave_time'];

    public function setDateAttribute($value)
    {
         //dd($value);
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y',$value);
    }

    // public function setEntryTimeAttribute($value)
    // {
    //      //dd($value);
    //     $this->attributes['entry_time'] = Carbon::createFromFormat('h:i A',$value);
    // }

    // public function setLeaveTimeAttribute($value)
    // {
    //      //dd($value);
    //     $this->attributes['leave_time'] = Carbon::createFromFormat('h:i A',$value);
    // }

    public function taker()
    {
    	return $this->belongsTo(Teacher::Class,'taker_id');
    }

    public function teacherstaff()
    {
    	return $this->belongsTo(Teacher::Class,'teacher_id');
    }

    public function asessions()
    {
      return $this->belongsTo(Asession::Class,'asession_id');
    }
}
