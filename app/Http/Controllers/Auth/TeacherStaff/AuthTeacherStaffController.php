<?php

namespace App\Http\Controllers\Auth\TeacherStaff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\RegisterTeacherForm;
use App\Http\Requests\EditTeacherForm;
use Carbon\Carbon;
use Auth;
use App\Teacher;

class AuthTeacherStaffController extends Controller
{

	public function __construct()
    {
       
        $this->middleware(['auth','auth_active']);
            
    }

     public function register()
    {
        $user = Auth::user();
        $user->load('appprofile','schoolprofile');
        $characters = $user->appprofile['reg_prefix_teacher'];
        $year = Carbon::now()->year;
        $regno = $characters.$year. mt_rand(10000, 99999);
        $pass = str_random(8);
        return view('teacher.teacher_register',compact('regno','pass','user'));
     }

    public function postregister(RegisterTeacherForm $form)
    {
        $form->storing();

   	  	return back();
    }

  

     public function teachers_profile($reg_no = null)
    {        
        $teacher = Teacher::where('reg_no',$reg_no)
                   ->where('user_id',Auth::id())
                   ->with('permanent_states','permanent_district','communication_district','communication_states','stopages')->first();

        return view('auth.teachers.teacher_profile',compact('teacher'));
    }

     public function profile_edit($uuid = null, $reg_no = null)
    {
        $teacher = Teacher::where('uuid',$uuid)
                          ->where('reg_no',$reg_no)
                          ->with('permanent_states','permanent_district','communication_district','communication_states','stopages')
                          ->where('user_id',Auth::id())->first();

        return view('teacher.teacher_edit',compact('teacher'));
    }

     public function profile_update(EditTeacherForm $r)
    { 
            $r->storing();

           return redirect()->to('/auth/all_teachers_staff'); 
    }

}
