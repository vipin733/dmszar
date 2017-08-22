<?php

namespace App\Http\Controllers\Teacher\Academic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Staff\Acadmic\TimeTable;
use App\Model\Staff\Acadmic\LunchTime;
use App\Model\Day;
use App\Asession;
use Auth;
use PDF;
use DB;

class TeacherAcademicController extends Controller
{
     public function __construct()
    {
        
        $this->middleware(['auth:teacher','active','teachers']);         
    }

    public function timetableview()
    {
    
        $userID  = Auth::user()->owner->id;

        $days = Day::select('name')->get();     

        $activesessionid = Asession::where('user_id',$userID)->where('active',1)->select('id','name')->first(); 

              
            if (!$activesessionid) {
                      
              flash()->warning('No time table found!');
              return back();

          }   

        $activesessionidID = $activesessionid->id;                         

        $lunchtime = LunchTime::where('asession_id',$activesessionidID)->first();

        $timetables = TimeTable::where(function($q) use($userID,$activesessionidID){
                                      $q->where('user_id',$userID)
                                         ->where('asession_id',$activesessionidID);
                                   })->where(function($q){
                                      $q->orWhere('sunday_teacher_id',Auth::id())
                                         ->orWhere('monday_teacher_id',Auth::id())
                                         ->orWhere('tuesday_teacher_id',Auth::id())
                                         ->orWhere('wednesday_teacher_id',Auth::id())
                                         ->orWhere('thursday_teacher_id',Auth::id())
                                         ->orWhere('friday_teacher_id',Auth::id())
                                         ->orWhere('saturday_teacher_id',Auth::id());
                                   })->with('sundaysubjects','mondaysubjects','tuesdaysubjects','wednesdaysubjects','thursdaysubjects','fridaysubjects','saturdaysubjects','courses','sections')->orderBy(DB::raw('TIME(start)'))->get();


       //return $timetables; 

          if (!count($timetables)) {
                      
              flash()->warning('No time table found!');
              
               return back();

          }                           

        return view('teacher.academic.time_table_view',compact('days','lunchtime','timetables','activesessionid'));
    }

    public function print_timetable()
    {
         
          $userID  = Auth::user()->owner->id;    

          $days = Day::select('name')->get();      

         $activesessionid = Asession::where('user_id',$userID)->where('active',1)->select('id','name')->first(); 

          if (!$activesessionid) {
                      
              flash()->warning('No time table found!');
               return back();

          }   

         $activesessionidID = $activesessionid->id; 

         $lunchtime = LunchTime::where('asession_id',$activesessionidID)->first();
 

        $timetables = TimeTable::where(function($q) use($userID,$activesessionidID){
                                      $q->where('user_id',$userID)
                                         ->where('asession_id',$activesessionidID);
                                   })->where(function($q){
                                      $q->orWhere('sunday_teacher_id',Auth::id())
                                         ->orWhere('monday_teacher_id',Auth::id())
                                         ->orWhere('tuesday_teacher_id',Auth::id())
                                         ->orWhere('wednesday_teacher_id',Auth::id())
                                         ->orWhere('thursday_teacher_id',Auth::id())
                                         ->orWhere('friday_teacher_id',Auth::id())
                                         ->orWhere('saturday_teacher_id',Auth::id());
                                   })->with('sundaysubjects','mondaysubjects','tuesdaysubjects','wednesdaysubjects','thursdaysubjects','fridaysubjects','saturdaysubjects','courses','sections')->orderBy(DB::raw('TIME(start)'))->get();

          $pdf=PDF::loadView('teacher.academic.time_table_print',compact('timetables','days','lunchtime','activesessionid'))->setOrientation('landscape')->setOption('margin-bottom', 0)->setOption('margin-left', 0)->setOption('margin-right', 0);

          return $pdf->stream('time-table-'. $activesessionid['name'] .'.' .'pdf');

    }
}
