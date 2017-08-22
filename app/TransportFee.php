<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportFee extends Model
{
   protected $fillable = [
        
        'transport_fee','remarks','late_fee','other_fee','asession_id'
    ];
   
     public function stopages()
    {
    	return $this->belongsTo(Stopage::Class,'stopage_id');
    }

    public function asessions()
    {
      return $this->belongsTo(Asession::Class,'asession_id');
    }
}
