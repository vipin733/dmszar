<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StaffRegisterStudentForm;
use App\Http\Requests\StaffEditStudentForm;
use App\StudentAttendence;
use Carbon\Carbon;
use App\Student;
use App\Asession;
use Auth;

class StaffStudentController extends Controller
{
    public function __construct()
    {
       
        $this->middleware(['auth:teacher','active']); 
        $this->middleware('staffs')->except('students_profile','attendence_st_students','attendence_details_students'); 
            
    } 

     public function register()
    {
        $owner = Auth::user()->owner;
        $owner->load('appprofile','schoolprofile');
        $characters = $owner->appprofile['reg_prefix_student'];
        $year = Carbon::now()->year;
        $regno = $characters.$year. mt_rand(10000, 99999);
        $pass = str_random(8);
        return view('staff.students.create.student_register',compact('regno','pass','owner'));
     }

    public function postregister(StaffRegisterStudentForm $form)
    {
    
       $form->storing();
       return back();

    }

     public function students_profile($reg_no = null)
    {        
        $student = Student::where('reg_no',$reg_no)
                   ->where('user_id',Auth::user()->owner->id)
                   ->with('courses','created_courses','permanent_states','permanent_district','communication_district','communication_states','stopages','studentacadmic.sections','studentacadmic','hostels')->first();

        return view('staff.students.students_profile',compact('student'));
    }

     public function profile_edit($uuid = null, $reg_no = null)
    {
        $owner = Auth::user()->owner;
        $owner->load('schoolprofile');
        $student = Student::where('uuid',$uuid)
                          ->where('reg_no',$reg_no)
                          ->with('courses','created_courses','permanent_states','permanent_district','communication_district','communication_states','stopages')
                          ->where('user_id',Auth::user()->owner->id)->first();

        return view('staff.students.edit.student_edit',compact('student','owner'));
    }

     public function profile_update(StaffEditStudentForm $r)
    { 
            $r->storing();

           return redirect()->to('/st/all_students'); 
    }


    
    public function attendence_st_students($reg_no = null)
    {
        $users = Auth::user();

        $user = Student::where('user_id',$users->owner->id)
                       ->where('reg_no', $reg_no)
                       ->with('courses')
                       ->first();

        return view('staff.students.attendance.attendence_st_students',compact('user'));
    }

    public function attendence_details_students(Request $request, $reg_no = null)
    {
        $users = Auth::user();

        $user = Student::where('user_id',$users->owner->id)
                       ->where('reg_no', $reg_no)
                       ->with('courses')
                       ->first();

            $starts = $request->from;
            $ende = $request->to;
            $dates = str_replace('/', '-', $starts);
            $datee = str_replace('/', '-', $ende);
            $start = date('Y-m-d', strtotime($dates));
            $end = date('Y-m-d', strtotime($datee));
       
         $activesessionid = Asession::where('user_id',$users->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();
          if (!$activesessionid) {

            if (!$users->isStaff()) {
                 
                 flash()->warning('No session Active, please contact to your institution admin!');

             // return redirect()->to('');
                 return back();
            }
                      
              flash()->warning('No session Active, please active current session first!');

             // return redirect()->to('');
              return redirect('/acadmic/asessions/create');

          } 
                                        
            if ($starts || $ende ) {
                    
                 $attendences = StudentAttendence::where('asession_id',$activesessionid->id)
                                             ->where('student_id',$user->id)
                                             ->whereDate('date','>=',$start)
                                             ->whereDate('date','<=',$end)
                                             ->with('taker')
                                             ->latest()
                                             ->paginate(7);
              } else{
                 $attendences = StudentAttendence::where('asession_id',$activesessionid->id)
                                                ->where('student_id',$user->id)
                                                ->with('taker')
                                                ->latest()
                                                ->paginate(7);
              }                

        return view('staff.students.attendance.attendence_details_students',compact('user','attendences'));
    }

    
}
