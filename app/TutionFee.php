<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutionFee extends Model
{
    protected $fillable = [
        
        'tution_fee','remarks','other_fee','late_fee','asession_id'
    ];


     public function courses()
    {
    	return $this->belongsTo(Course::Class,'course_id');
    }

    public function asessions()
    {
      return $this->belongsTo(Asession::Class,'asession_id');
    }
}
