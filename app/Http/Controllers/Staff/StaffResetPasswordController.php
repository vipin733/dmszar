<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use App\Student;
use App\Teacher;

class StaffResetPasswordController extends Controller
{
     public function __construct()
    {
       
       $this->middleware(['auth:teacher','active','staffs']);  
            
    }

     public function auth_student_reset()
    { 
        
        return view('staff.reset.students.resete_password');
    }

     public function auth_student_reset_update(Request $r)
    {
    	$this->validate($r,[

            'reg_no'             => 'required',
   	  	]);

    	  $student = Student::where('user_id',Auth::user()->owner->id)
                             ->where('reg_no',$r->reg_no)
                              ->first();  

          if ($student) {
            $data = ['password' => Hash::make($student->reg_no)];

            $student->update($data);

            flash('Succesfully password reset!, New password is student Registration no.')->success()->important();                         
           
          }else{
             
              flash('Oops! Check registration no. or its not belongs to you.')->error(); 

          }


          return back(); 
                           
    }

    public function auth_teacher_staff_reset()
    { 
        
        return view('staff.reset.teachers_staff.resete_password');
    }

     public function auth_teacher_staff_reset_update(Request $r)
    {
    	$this->validate($r,[

            'reg_no'             => 'required',
   	  	]);

    	  $teacher_staff = Teacher::where('user_id',Auth::user()->owner->id)
                             ->where('reg_no',$r->reg_no)
                              ->first();  

          if ($teacher_staff) {

             $data = ['password' => Hash::make($teacher_staff->reg_no)];

                $teacher_staff->update($data);

                flash('Succesfully password reset!, New password is same Registration no.')->success()->important();                         
               
              }else{
                 
                  flash('Oops! Check registration no. or its not belongs to you.')->error(); 

              } 

          return back(); 
                           
    }
}


