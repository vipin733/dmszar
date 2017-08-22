<?php

namespace App\Model\Staff\Acadmic;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Asession;
use App\Model\Day;
use App\User;

class LunchTime extends Model
{
    protected $fillable = [
       'start','end','asession_id','remarks','day_id'
    ];

     protected $dates = ['start','end'];


     public function setStartAttribute($value)
    {
        
        $this->attributes['start'] = Carbon::createFromFormat('g:i A',$value);
    }

    public function setEndAttribute($value)
    {
         
        $this->attributes['end'] = Carbon::createFromFormat('g:i A',$value);
    }

    public function asessions()
    {
        return $this->belongsTo(Asession::class,'asession_id');
    }

     public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

     public function dayoff()
    {
        return $this->belongsTo(Day::class,'day_id');
    }
}
