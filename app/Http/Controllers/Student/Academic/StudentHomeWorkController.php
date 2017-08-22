<?php

namespace App\Http\Controllers\Student\Academic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Teacher\Student\StudentHomeWork;
use App\StudentAcadmic;
use App\Asession;
use Auth;

class StudentHomeWorkController extends Controller
{
     public function __construct()
    {
        
        $this->middleware(['auth:student','active']);           
    }

    public function homework_index(Request $request)
    {

        $activesessionid = Asession::where('user_id',Auth::user()->owner->id)->where('active',1)->select('id')->first();

          if ($activesessionid) {
                       $activesessionidID = $activesessionid->id;         
          }else{
               $activesessionidID = 100000000000000000000;
          } 

    	$studentacadmic = StudentAcadmic::where('student_id',Auth::id())
                                          ->where('asession_id',$activesessionidID)->first();  

         if ($studentacadmic) {
                       $CourseID  = $studentacadmic->course_id;  
                       $SectionID = $studentacadmic->section_id;        
          }else{
                       $CourseID  = 1000000000000000000000000000;  
                       $SectionID = 100000000000000000000000000000; 
          }                                   

        $homeworks = StudentHomeWork::where('asession_id',$activesessionidID)
                                     ->where('course_id',$CourseID)  
                                     ->where('section_id',$SectionID)
                                     ->with('subjects','teachers','asessions','courses','sections')
                                     ->latest()->paginate(10);  
    

       return view('student.academic.homework.homework_index',compact('homeworks'));                                               

    }

}
