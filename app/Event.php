<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Event extends Model
{
   protected $fillable = [
        'creater_id','title','event_body','user_id','start','end','full_day','asession_id'
    ];

    protected $dates = ['start','end'];

    protected $casts = [
        'full_day' => 'boolean',
    ];

     public function setStartAttribute($value)
    {
         
        $this->attributes['start'] = Carbon::createFromFormat('d/m/Y g:i A',$value);
    }

      public function setEndAttribute($value)
    {
         
        $this->attributes['end'] = Carbon::createFromFormat('d/m/Y g:i A',$value);
    }

      public function owner()
    {
        return $this->belongsTo(User::Class,'user_id');
    }

    public function creater()
    {
        return $this->belongsTo(Teacher::Class,'creater_id');
    }

     public function asessions()
    {
      return $this->belongsTo(Asession::Class,'asession_id');
    }

     public function scopeFilter($filterQuery, Request $request)
    {

        if ($request->from) {
            $s = str_replace('/', '-', $request->from);
            $start = date('Y-m-d', strtotime($s));

           $filterQuery->whereDate('start','>=',$start);
        }

        if ($request->to) {

            $t = str_replace('/', '-', $request->to);
            $end = date('Y-m-d', strtotime($t));

           $filterQuery->whereDate('end','<=',$end);
        }

        return $filterQuery;
    }
}
