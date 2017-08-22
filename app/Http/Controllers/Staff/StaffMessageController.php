<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\MessageCreatedStudentByStaff;
use App\Events\MessageCreatedTeacherByStaff;
use App\Student;
use App\Teacher;
use App\Course;
use Auth;

class StaffMessageController extends Controller
{
	  public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }

   public function message_form()
    { 
        $user = Auth::user();
        
        return view('staff.notification_message.message',compact('user'));
    }

    public function message_post(Request $r)
    { 
        $user = Auth::user();

         $this->validate($r,[

            'send_to'        =>      'required|boolean',
            'course'         =>      'nullable|integer',
            'message'        =>      'required'
        ]);  

         $message = $r->message;
        
        if ($r->send_to == 1) {
               
               if ($r->course) {

                  $course = Course::where('user_id',$user->owner->id)
                                ->where('id',$r->course)
                                ->select('id','name')
                                ->first();

                   $students = Student::where('user_id',$user->owner->id)
                                          ->where('active',1)
                                          ->where('course_id',$course->id)
                                          ->select('id','emer_no')
                                          ->get();

                        if (count($students)) {                           

                                  event(new MessageCreatedStudentByStaff($students,$message,$user));

                        }else{
                           flash('No students found in class '.$course->name)->error();

                           return back(); 
                        }

                                        
               }else{
                 $students = Student::where('user_id',$user->owner->id)
                                          ->where('active',1)
                                          ->select('id','emer_no')
                                          ->get();

                    //return $students;                      
                   
                   if (count($students)) {
                       
                       event(new MessageCreatedStudentByStaff($students,$message,$user));

                   }else{
                           flash('No students found!', 'danger');

                           return back(); 
                        }
                  
               } 
           
        }else{

             $teachers= Teacher::where('user_id',$user->owner->id)
                               ->where('type',0)
                               ->where('active',1)
                               ->select('id','mob_no')
                               ->get();

                    if (count($teachers)) {

                        event(new MessageCreatedTeacherByStaff($message,$user,$teachers)); 
                      
                    }else{
                           flash('No teachers found!', 'danger');
                           return back(); 
                    }
                          
        }
        
        flash()->success('Successfully Message Send'); 

        return back();
    }
}
