<?php

namespace App\Http\Controllers\Teacher\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Staff\Acadmic\TimeTable;
use App\Events\MessageCreatedStudentByStaff;
use App\Events\MessageCreatedStudentSingle;
use App\TeacherTeachingAcadmic;
use App\Section;
use App\Asession;
use App\Student;
use Auth;

class SendMessageToStudentController extends Controller
{
     public function __construct()
    { 
        $this->middleware(['auth:teacher','active']);
         $this->middleware(['teachers'])->except('post_s_form');           
    }
    
     public function get_form()
    {   
      $userID = Auth::user()->owner->id;
       $activesessionid = Asession::where('user_id',$userID)
                                      ->where('active',1)
                                        ->select('id')
                                         ->first(); 	

        if (!$activesessionid) {
               
               flash()->warning('No session Active, please contact to your institution admin!');

                return back();

          }                                  

       $courses = TimeTable::selectRaw('course_id')->where(function($q) use($userID,$activesessionid){
                                      $q->where('user_id',$userID)
                                         ->where('asession_id',$activesessionid->id);
                                   })->where(function($q){
                                      $q->orWhere('sunday_teacher_id',Auth::id())
                                         ->orWhere('monday_teacher_id',Auth::id())
                                         ->orWhere('tuesday_teacher_id',Auth::id())
                                         ->orWhere('wednesday_teacher_id',Auth::id())
                                         ->orWhere('thursday_teacher_id',Auth::id())
                                         ->orWhere('friday_teacher_id',Auth::id())
                                         ->orWhere('saturday_teacher_id',Auth::id());
                                   })->groupBy('course_id')->orderBy('course_id')->with('courses')->get();

      // return $courses;                                            

    	return view('teacher.student.message.get_message_form',compact('courses'));
    }

     public function get_course_ajax($id = null)
    {
        $user = Auth::user();

        $session = Asession::where('user_id',Auth::user()->owner->id)
                                      ->where('active',1)
                                        ->select('id')
                                         ->first();

        $sections = Section::where('user_id',$user->owner->id)
                              ->whereHas('timetables', function($q) use($id,$session){
                              $q->where('course_id',$id)
                              ->where('asession_id',$session->id);
                            })->pluck('name','id');

        return json_encode($sections);        
    }


     public function post_form(Request $r)
    {
    	$this->validate($r, [
        'send_to'   => 'required|boolean',
        'course'    => 'required|integer',
        'section'   => 'required_if:send_to,0|integer',
        'message'   => 'required'
       ]);

       $message        = $r->message;

       $user = Auth::user();

       $session = Asession::where('user_id',$user->owner->id)
                                      ->where('active',1)
                                        ->select('id')
                                         ->first();
    	if ($r->send_to == 1) {
            
    		$students = Student::where('user_id',$user->owner->id)->where('active',1)
    		                     ->whereHas('studentacadmic', function($q) use($r,$session){
                                   $q->where('course_id',$r->course)
                                     ->where('asession_id',$session->id);
    		                     })->select('id','emer_no')->get();
    		                 
    	}else{

    		$students = Student::where('user_id',$user->owner->id)->where('active',1)
    		                     ->whereHas('studentacadmic', function($q) use($r,$session){
                                   $q->where('course_id',$r->course)
                                   ->where('section_id',$r->section)
                                     ->where('asession_id',$session->id);
    		                     })->select('id','emer_no')->get();
    		                    
    	}
        
        //return $students;

    	if (count($students)) {

        event(new MessageCreatedStudentByStaff($students,$message,$user));
            
         }else{

          flash('No Students found in this class', 'danger');
            return back(); 
        }          


        flash()->success('Successfully Message Send'); 

        return back();
    	
    }

    public function post_s_form(Request $r,$reg_no = null)
    {
        $this->validate($r, [
        'message'   => 'required'
       ]);

       $user = Auth::user();
       
       $student = Student::where('user_id',$user->owner->id)->where('reg_no',$reg_no)->select('id','emer_no')->first();
      
       $data = [
                             
                'student_id'    => $student->id,
                'teacher_id'    => null,
                'by_owner_id'   => null,
                'by_teacher_id' => Auth::id(),
                'message'       => $r->message

            ];
        
        $message        = $r->message;

        $numbers        = $student->emer_no;

        $user->owner->messages()->create($data); 

        event(new MessageCreatedStudentSingle($message,$numbers)); 

        flash()->success('Successfully Message Send'); 

        return back();   
    }

}
