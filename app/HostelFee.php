<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HostelFee extends Model
{
    protected $fillable = [
        
        'hostel_fee','remarks','late_fee','other_fee','asession_id'
    ];
   
     public function hostels()
    {
    	return $this->belongsTo(Hostel::Class,'hostel_id');
    }

    public function asessions()
    {
      return $this->belongsTo(Asession::Class,'asession_id');
    }
}
