<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeRequest extends Model
{
    protected $fillable = [
        
        'fee_request_category_id','asession_id','action_taken_by_id','status','description','remarks','ticket_no'
    ];

    public function action_taken_by()
    {
        return $this->belongsTo(Teacher::class,'action_taken_by_id');
    }

    public function feerequestcategories()
    {
        return $this->belongsTo(FeeRequestCategory::class,'fee_request_category_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function asessions()
    {
      return $this->belongsTo(Asession::Class,'asession_id');
    }
}
