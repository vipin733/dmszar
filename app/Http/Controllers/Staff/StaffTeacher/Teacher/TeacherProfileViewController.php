<?php

namespace App\Http\Controllers\Staff\StaffTeacher\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Teacher\Student\StudentHomeWork;
use App\Model\Staff\Acadmic\TimeTable;
use App\Model\Staff\Acadmic\LunchTime;
use App\TeacherAcadmic;
use App\Model\Day;
use App\Asession;
use App\Teacher;
use Auth;
use PDF;
use DB;


class TeacherProfileViewController extends Controller
{
	public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }

     public function teacher_academic_profile(Request $request, $reg_no = null)
    {
        $userID = Auth::user()->owner->id;
        $teacher = Teacher::where('reg_no',$reg_no)->where('user_id',$userID)->first();
        $teacheracadmics = TeacherAcadmic::where('teacher_id',$teacher->id)
                                        ->with('sections','courses','asessions','teachers.subjects')->latest()->get();

      return view('staff.teachers_staff.profile.academic.teacher_academic_profile',compact('teacheracadmics','teacher'));
    }

     public function teacher_timetable(Request $request, $reg_no = null)
    {
        $userID = Auth::user()->owner->id;
        $teacher = Teacher::where('reg_no',$reg_no)->where('user_id',$userID)->first();
        $timetables = TimeTable::where('user_id',$userID)->where(function($q) use($teacher){
                                      $q->orWhere('sunday_teacher_id',$teacher->id)
                                         ->orWhere('monday_teacher_id',$teacher->id)
                                         ->orWhere('tuesday_teacher_id',$teacher->id)
                                         ->orWhere('wednesday_teacher_id',$teacher->id)
                                         ->orWhere('thursday_teacher_id',$teacher->id)
                                         ->orWhere('friday_teacher_id',$teacher->id)
                                         ->orWhere('saturday_teacher_id',$teacher->id);
                                   })->groupBy('asession_id')->with('asessions')->latest()->get();

	    if (!count($timetables)) {
	              
	      flash()->warning('No time table found!');
	      
	       return back();

	      } 

      return view('staff.teachers_staff.profile.timetable.teacher_timetable',compact('timetables','teacher'));
    }

    public function teacher_timetableview($asession = null,$reg_no = null)
    {   
        $userID  = Auth::user()->owner->id;
        $days = Day::select('name')->get();  
        $session = Asession::where('id',$asession)->where('user_id',$userID)->select('id','name')->first();
        $teacher = Teacher::where('reg_no',$reg_no)->where('user_id',$userID)->first();                         
        $lunchtime = LunchTime::where('asession_id',$session->id)->first();

        $timetables = TimeTable::where('asession_id',$session->id)->where(function($q) use($teacher){
                                      $q->orWhere('sunday_teacher_id',$teacher->id)
                                         ->orWhere('monday_teacher_id',$teacher->id)
                                         ->orWhere('tuesday_teacher_id',$teacher->id)
                                         ->orWhere('wednesday_teacher_id',$teacher->id)
                                         ->orWhere('thursday_teacher_id',$teacher->id)
                                         ->orWhere('friday_teacher_id',$teacher->id)
                                         ->orWhere('saturday_teacher_id',$teacher->id);
                                   })->with('sundaysubjects','mondaysubjects','tuesdaysubjects','wednesdaysubjects','thursdaysubjects','fridaysubjects','saturdaysubjects','courses','sections')->orderBy(DB::raw('TIME(start)'))->get();                          

        return view('staff.teachers_staff.profile.timetable.teacher_timetable_view',compact('days','lunchtime','timetables','session','teacher'));
    }

    public function teacher_timetable_print($asession = null,$reg_no = null)
    {
        $userID  = Auth::user()->owner->id;
        $days = Day::select('name')->get();  
        $session = Asession::where('id',$asession)->where('user_id',$userID)->select('id','name')->first();
        $teacher = Teacher::where('reg_no',$reg_no)->where('user_id',$userID)->first();                         
        $lunchtime = LunchTime::where('asession_id',$session->id)->first();

        $timetables = TimeTable::where('asession_id',$session->id)->where(function($q) use($teacher){
                                      $q->orWhere('sunday_teacher_id',$teacher->id)
                                         ->orWhere('monday_teacher_id',$teacher->id)
                                         ->orWhere('tuesday_teacher_id',$teacher->id)
                                         ->orWhere('wednesday_teacher_id',$teacher->id)
                                         ->orWhere('thursday_teacher_id',$teacher->id)
                                         ->orWhere('friday_teacher_id',$teacher->id)
                                         ->orWhere('saturday_teacher_id',$teacher->id);
                                   })->with('sundaysubjects','mondaysubjects','tuesdaysubjects','wednesdaysubjects','thursdaysubjects','fridaysubjects','saturdaysubjects','courses','sections')->orderBy(DB::raw('TIME(start)'))->get();

          $pdf=PDF::loadView('staff.teachers_staff.profile.timetable.teacher_timetable_print',compact('timetables','days','lunchtime','session','teacher'))->setOrientation('landscape')->setOption('margin-bottom', 0)->setOption('margin-left', 0)->setOption('margin-right', 0);

          return $pdf->stream('time-table-'. $session['name'] .'.' .'pdf');

    }


    public function teacher_homeworks(Request $request,$reg_no = null)
    {   
        $userID  = Auth::user()->owner->id;
        $teacher = Teacher::where('reg_no',$reg_no)->where('user_id',$userID)->first();   
        $homework = StudentHomeWork::filter($request)->where('teacher_id',$teacher->id)
                                    ->with('courses','sections','subjects','asessions')->latest(); 
        $homeworks = $homework->paginate(10);
        $homeworkcount = $homework->get()->count();

        return view('staff.teachers_staff.profile.homework.teacher_homeworks',compact('homeworks','homeworkcount','teacher'));                                                                 
    }
}
