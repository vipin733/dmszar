<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CCRequest extends Model
{
   protected $fillable = [
        
        'ticket_no','asession_id','student_id','certificate_category_id','description','remarks','updated_by_id','status','fee_status'
    ];

     public function updated_by()
    {
        return $this->belongsTo(Teacher::class,'updated_by_id');
    }

    public function certificatecategories()
    {
        return $this->belongsTo(CCategory::class,'certificate_category_id');
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
