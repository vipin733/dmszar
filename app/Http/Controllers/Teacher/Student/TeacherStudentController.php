<?php

namespace App\Http\Controllers\Teacher\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\StudentAcadmic;
use App\Student;
use App\StudentAttendence;
use App\Events\StudentAbsent;
use App\Asession;
use Carbon\Carbon;
use Storage;
use Tzsk\Sms\Facade\Sms;

class TeacherStudentController extends Controller
{
    
    public function __construct()
    {
     
       $this->middleware(['auth:teacher','active','teachers']);
    }
    
    public function student_take_attendence_get()
    {

    	 $user = Auth::user();

       $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first(); 

        
        if (!$activesessionid) {
               

               flash()->warning('No session Active, please contact to your institution admin!');

               // return redirect()->to('');
                return back();

          }                                  

       if ($user->teacheracadmic) {
         $students = Student::where('active',1)
                       ->whereHas('studentacadmic.courses.teacheracadmic',
                           function($q) use($user,$activesessionid ){                               
                               $q->where('teacher_id', $user->id)
                               ->where('asession_id',$activesessionid->id);                               
                             })->whereHas('studentacadmic', function($q) use($user,$activesessionid){
                              $q->where('section_id',$user->teacheracadmic->section_id)
                              ->where('asession_id',$activesessionid->id);
                             })->with('studentacadmic','studentacadmic.sections')->get();

            return view('teacher.student.student_take_attendence',compact('students'));
       }else{

        flash('No student found'); 

          return back();
       }
      
                           
    }  

    public function student_take_attendence_post(Request $r)
    {
          $this->validate($r,[

            'date'   =>      'required|date_format:d/m/Y',
            'marked' =>      'required',
        ]);

    	   $user = Auth::user();

        $user->load('owner.schoolprofile');

        $today = Carbon::now()->format('Y-m-d');  

        $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first(); 

        $students = Student::where('user_id',$user->owner->id)
                                 ->where('active',1)
                              ->whereHas('studentacadmic.courses.teacheracadmic',
            	             function($q) use($user,$activesessionid){
                               
                               $q->where('teacher_id', $user->id)
                               ->where('asession_id',$activesessionid->id);
                               
                             })->whereHas('studentacadmic', function($q) use($user,$activesessionid){
                             	$q->where('section_id',$user->teacheracadmic->section_id)
                                ->where('asession_id',$activesessionid->id);;
                             })->get();



               $d = $r->date; 

        $dates = str_replace('/', '-', $d);

        $date = date('Y-m-d', strtotime($dates));
                   
            foreach ($students as $key => $value) {
            	$ids = $value->id;
                //dd($ids);
             $todayattendence = StudentAttendence::
                           where('student_id', $ids)
                           ->whereDate('date' , $date)->first();
            }

      if ($date > $today ) {

           flash('Sorry! You can not take attendence of future date.', 'danger'); 
                        
           return back();
                              
        }else{
            
            if ($todayattendence) {

          flash('You already marked attendence for date of '. $d ); 
                        
           return back();        

        } else{
            
             foreach ($students as $key => $value)
         { 
           $data = [

            'date'       => $r->date,
            'marked'     => $r->marked [$key],
            'taker_id'   => $user->id,
            'asession_id'=> $activesessionid->id
           ];

           $value->studentattendence()->create($data);

         }  

         $studentss = Student::whereHas('studentattendence',function($q) use($date){
                                   $q->whereDate('date',$date)
                                     ->where('marked',0);
                               })->select('parent_no','name')->get()->toArray();

          $numbers = array_pluck($studentss, 'parent_no');
       
          //return $numbers;
         if ($studentss) {
           event(new StudentAbsent($numbers,$d,$user)); 
         }

          flash()->success('Successfully attendence marked'); 
          return back(); 
           
          } 

        }                                      
                   
    }                      
}
