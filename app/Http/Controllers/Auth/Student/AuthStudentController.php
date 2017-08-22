<?php

namespace App\Http\Controllers\Auth\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\RegisterStudentForm;
use App\Http\Requests\EditStudentForm;
use Carbon\Carbon;
use App\Student;
use Auth;

class AuthStudentController extends Controller
{
	public function __construct()

    {
       
        $this->middleware(['auth','auth_active']);
            
    }

     public function register()
    {
        $user = Auth::user();
        $user->load('appprofile','schoolprofile');
        $characters = $user->appprofile['reg_prefix_student'];
        $year = Carbon::now()->year;
        $regno = $characters.$year. mt_rand(10000, 99999);
        $pass = str_random(8);
        return view('student.student_register',compact('regno','pass','user'));
     }

    public function postregister(RegisterStudentForm $form)
    {
    
       $form->storing();
       return back();

    }

    
     public function students_profile($reg_no = null)
    {        
        $student = Student::where('reg_no',$reg_no)
                   ->where('user_id',Auth::id())
                   ->with('courses','created_courses','permanent_states','permanent_district','communication_district','communication_states','stopages')->first();

        return view('auth.students.students_profile',compact('student'));
    }

     public function profile_edit($uuid = null, $reg_no = null)
    {
       $user = Auth::user();
        $user->load('schoolprofile');
        $student = Student::where('uuid',$uuid)
                          ->where('reg_no',$reg_no)
                          ->with('courses','created_courses','permanent_states','permanent_district','communication_district','communication_states','stopages')
                          ->where('user_id',Auth::id())->first();

        return view('student.student_edit',compact('student','user'));
    }

     public function profile_update(EditStudentForm $r)
    { 
            $r->storing();

           return redirect()->to('/auth/all_students'); 
    }

}
