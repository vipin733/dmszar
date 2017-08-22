<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TeacherLeave extends Model
{
    protected $fillable = [

        'leave_type','leave_start','leave_end','leave_time_start','leave_time_end','reason','teacher_id','action_taken_by','status','remarks','asession_id'
    ];

    protected $dates = ['leave_start','leave_end','leave_time_start','leave_time_end'];

    public function actiontakenby()
    {
        return $this->belongsTo(Teacher::class,'action_taken_by');
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


        if ($request->teacher) {
           $filterQuery->where('teacher_id',$request->teacher);
        }

        if ($request->session) {
           $filterQuery->where('asession_id',$request->session);
        }

         if ($request->status) {
           $filterQuery->where('status',$request->status);
        }

        return $filterQuery;
    }

    public function scopeTeacherStaffFilter($filterQuery, Request $request)
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

         if ($request->status) {
           $filterQuery->where('status',$request->status);
        }

        return $filterQuery;
    }
}
