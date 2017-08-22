<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LogRequest extends Model
{
    protected $fillable = [
        
        'ticket_no','asession_id','teacher_id','student_id','action_taker_id','log_category_id','subject','description','remarks','status'
    ];

    public function action_taker()
    {
        return $this->belongsTo(Teacher::class,'action_taker_id');
    }

    public function logrequestcategories()
    {
        return $this->belongsTo(LogRequestCategory::class,'log_category_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function teachers()
    {
        return $this->belongsTo(Teacher::class,'teacher_id');
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

           $filterQuery->whereDate('created_at','>=',$start);
        }

        if ($request->to) {

            $t = str_replace('/', '-', $request->to);
            $end = date('Y-m-d', strtotime($t));

           $filterQuery->whereDate('created_at','<=',$end);
        }

        if ($request->session) {
           $filterQuery->where('asession_id',$request->session);
        }

         if ($request->category) {
           $filterQuery->where('log_category_id',$request->category);
        }

        return $filterQuery;
    }
}
