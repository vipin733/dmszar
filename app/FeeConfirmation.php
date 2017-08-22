<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FeeConfirmation extends Model
{
    protected $fillable = [
        
        'ticket_no','deposit_date','asession_id','bank_name_id','app_name_id','course_id','transaction_no','tution_fee','hostel_fee','transport_fee','registration_fee','late_fee','other_fee','status','taken_by_id','remarks','reply'
    ];

    protected $dates = ['deposit_date'];

     public function setDepositDateAttribute($value)
    {
        $this->attributes['deposit_date'] = Carbon::createFromFormat('d/m/Y',$value);
    }

    public function appnames()
    {
        return $this->belongsTo(AppName::class,'app_name_id');
    }

     public function banknames()
    {
        return $this->belongsTo(BankName::class,'bank_name_id');
    }

    public function action_taken_by()
    {
        return $this->belongsTo(Teacher::class,'taken_by_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function courses()
    {
      return $this->belongsTo(Course::Class,'course_id');
    }

    public function asessions()
    {
      return $this->belongsTo(Asession::Class,'asession_id');
    }
}
