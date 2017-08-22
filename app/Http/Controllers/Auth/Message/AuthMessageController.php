<?php

namespace App\Http\Controllers\Auth\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\MessageCreatedStudent;
use App\Events\MessageCreatedTeacher;
use App\Teacher;
use App\Student;
use App\Course;
use Auth;


class AuthMessageController extends Controller
{
    public function __construct()
    {

      $this->middleware(['auth','auth_active']);
         
    }

     public function send_message()
    {   
       
    	return view('auth.message.get_message_form');
    }

    public function send_message_post(Request $r)
    {
    	 
         $this->validate($r,[

            'send_to'        =>      'required|boolean',
            'course'         =>      'nullable|integer',
            'message'        =>      'required'
        ]);  
        
        $user = Auth::user();

         $message = $r->message;

        if ($r->send_to == 1) {
               
               if ($r->course) {

                  $course = Course::where('user_id',$user->id)
                                ->where('id',$r->course)
                                ->select('id','name')
                                ->first();

                   $students = Student::where('user_id',$user->id)
                                          ->where('active',1)
                                          ->where('course_id',$r->course)
                                          ->select('id','emer_no')
                                          ->get();

                        if (count($students)) {

                              event(new MessageCreatedStudent($students,$message,$user));

                        }else{

                            flash('No students found in class '.$course->name)->error();

                           return back(); 
                        }

                                        
               }else{
                 $students = Student::where('user_id',$user->id)
                                          ->where('active',1)
                                          ->select('id','emer_no')
                                          ->get();

                   if (count($students)) { 

                          event(new MessageCreatedStudent($students,$message,$user));

                   }else{
                           flash('No students found!', 'danger');

                           return back(); 
                        }      
               } 
           
        }else{

             $teachers= Teacher::where('user_id',$user->id)
                               ->where('type',0)
                               ->where('active',1)
                               ->select('id','mob_no')
                               ->get();

                    if (count($teachers)) {
                           
                          event(new MessageCreatedTeacher($message,$user,$teachers)); 
                      
                    }else{
                           flash('No teachers found!', 'danger');
                           return back(); 
                    }      
        }
        
        flash()->success('Successfully Message Send'); 

        return back();
    }

   
}
