<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StudentAttendence extends Model
{
    
    protected $fillable = [
        'taker_id', 'date','marked','asession_id'
    ];

   protected $dates = ['date'];

    public function setDateAttribute($value)
    {
         //dd($value);
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y',$value);
    }

    public function taker()
    {
    	return $this->belongsTo(Teacher::Class,'taker_id');
    }

    public function students()
    {
    	return $this->belongsTo(Teacher::Class,'student_id');
    }

    public function asessions()
    {
      return $this->belongsTo(Asession::Class,'asession_id');
    }
}
