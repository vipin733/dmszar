<?php

namespace App\Http\Controllers\Student\Academic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Staff\Acadmic\TimeTable;
use App\Model\Staff\Acadmic\LunchTime;
use App\StudentAcadmic;
use App\Model\Day;
use App\Asession;
use Auth;
use PDF;
use DB;

class StudentAcademicController extends Controller
{
    public function __construct()
    {
        
        $this->middleware(['auth:student','active']);           
    }

    public function timetableview()
    {
        $userID  = Auth::user()->owner->id;
        $days = Day::select('name')->get();     
        $activesessionid = Asession::where('user_id',$userID)->where('active',1)->select('id')->first(); 

         if (!$activesessionid) {
                      
              flash()->warning('No time table found!');
               return back();

          }   

        $activesessionidID = $activesessionid->id;                               

        $lunchtime = LunchTime::where('asession_id',$activesessionidID)->first();

        $studentacadmic = StudentAcadmic::where('student_id',Auth::id())
                                          ->where('asession_id',$activesessionidID)
                                          ->with('courses','sections','asessions')
                                          ->first();  

          if ($studentacadmic) {
             $CourseID  = $studentacadmic->course_id;
             $SectionID = $studentacadmic->section_id;
          }else{
             $CourseID = 10000000000000000000000000000000;
             $SectionID = 10000000000000000000000000000000;
          }

        $timetables = TimeTable::where(function($q) use($userID, $CourseID,$SectionID,$activesessionidID){
                                      $q->where('user_id',$userID)
                                         ->where('course_id',$CourseID)
                                         ->where('section_id',$SectionID)
                                         ->where('asession_id',$activesessionidID);
                                   })->with('sundaysubjects','sundayteachers','mondaysubjects','mondayteachers','tuesdaysubjects','tuesdayteachers','wednesdaysubjects','wednesdayteachers','thursdaysubjects','thursdayteachers','fridaysubjects','fridayteachers','saturdaysubjects','saturdayteachers','courses','sections')->orderBy(DB::raw('TIME(start)'))->get();         


         if (!count($timetables)) {
                      
              flash()->warning('No time table found!');
              
               return back();

          } 

        return view('student.academic.timetable.time_table_view',compact('days','lunchtime','studentacadmic','timetables'));
    }

    public function print_timetable()
    {
         
        $userID  = Auth::user()->owner->id;    
        $days = Day::select('name')->get();      
        $activesessionid = Asession::where('user_id',$userID)->where('active',1)->select('id')->first(); 
             
        if (!$activesessionid) {
                      
              flash()->warning('No time table found!');
               return back();
          }   

         $activesessionidID = $activesessionid->id; 

         $lunchtime = LunchTime::where('asession_id',$activesessionidID)->first();

        $studentacadmic = StudentAcadmic::where('student_id',Auth::id())
                                          ->where('asession_id',$activesessionidID)
                                          ->with('courses','sections','asessions')
                                          ->first();  

        $timetables = TimeTable::where(function($q) use($userID, $studentacadmic,$activesessionidID){
                                      $q->where('user_id',$userID)
                                         ->where('course_id',$studentacadmic->course_id)
                                         ->where('section_id',$studentacadmic->section_id)
                                         ->where('asession_id',$activesessionidID);
                                   })->with('sundaysubjects','sundayteachers','mondaysubjects','mondayteachers','tuesdaysubjects','tuesdayteachers','wednesdaysubjects','wednesdayteachers','thursdaysubjects','thursdayteachers','fridaysubjects','fridayteachers','saturdaysubjects','saturdayteachers','courses','sections')->orderBy(DB::raw('TIME(start)'))->get();

          $pdf=PDF::loadView('student.academic.timetable.time_table_print',compact('timetables','studentacadmic','days','lunchtime'))->setOrientation('landscape')->setOption('margin-bottom', 0)->setOption('margin-left', 0)->setOption('margin-right', 0);

          return $pdf->stream($studentacadmic->courses['name'].'-'. $studentacadmic->sections['name'].'-time-table-'. $studentacadmic->asessions['name'] .'.' .'pdf');

    }
  
}
