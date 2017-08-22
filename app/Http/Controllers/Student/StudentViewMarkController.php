<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TestMark;
use App\ExamMark;
use App\TestName;
use App\ExamName;
use App\Subject;
use App\Course;
use Carbon\Carbon;
use Auth;
use App\Asession;

class StudentViewMarkController extends Controller
{
    
     public function __construct()

    {
  
        $this->middleware(['auth:student','active']);
            
    }

    public function get_asessions()
    {
        $user = Auth::user();

        $asessions = ExamMark::selectRaw('asession_id')
                     ->orderBy('asession_id')
                     ->groupBy('asession_id')
                     ->where('student_id',Auth::id())
                     ->with('asessions')
                     ->get();
                     //dd($course);                    

        return view('student.marks.get_asessions',compact('user','asessions'));
    }

    public function get_marks($course = null, $created_at = null)
    {
        $user = Auth::user();

        $cdate=Carbon::createFromTimeStamp($created_at);

        $asessionid = Asession::where('id',$course)
                          ->where('created_at',$cdate)
                          ->where('user_id',$user->owner->id)
                          ->first();
                       
        $subjects = Subject::whereHas('exammarks',function($q) use($asessionid){
                                    $q->where('asession_id',$asessionid->id)
                                     ->where('student_id',Auth::id());
                              })->with(['exammarks'=>function($q) use($asessionid){
                                $q->where('asession_id',$asessionid->id)
                                     ->where('student_id',Auth::id());
                              }])->whereHas('testmarks',function($q) use($asessionid){
                                  $q->where('asession_id',$asessionid->id)
                                  ->where('student_id',Auth::id());
                              })->with(['testmarks'=>function($q) use($asessionid){
                                $q->where('asession_id',$asessionid->id)
                                     ->where('student_id',Auth::id());
                              }])->get();
                                                                 
        $examnames = ExamMark::selectRaw('exam_id')
                     ->orderBy('exam_id')
                     ->groupBy('exam_id')
                     ->where('student_id',Auth::id())
                     ->where('asession_id',$asessionid->id)
                     ->with('examnames')
                     ->get(); 

        $testnames = TestMark::selectRaw('test_id')
                     ->orderBy('test_id')
                     ->groupBy('test_id')
                     ->where('student_id',Auth::id())
                     ->where('asession_id',$asessionid->id)
                     ->with('testnames')
                     ->get();

        return view('student.marks.get_marks',compact('user','asessionid','subjects','examnames','testnames'));
    }

     public function get_asessions_fortest()
    {
    
        $asessions = TestMark::selectRaw('asession_id')
                     ->orderBy('asession_id')
                     ->groupBy('asession_id')
                     ->where('student_id',Auth::id())
                     ->with('asessions')
                     ->get();                 

        return view('student.marks.get_asessions_fortest',compact('asessions'));
    }

     public function test_marks($course = null, $created_at = null)
    {
        $user = Auth::user();

         $cdate=Carbon::createFromTimeStamp($created_at);
         
         $asessionid = Asession::where('id',$course)
                          ->where('created_at',$cdate)
                          ->where('user_id',$user->owner->id)
                          ->first();                                
        $test_marks = TestMark::where('student_id',Auth::id())
                                ->where('asession_id',$asessionid->id)
                                ->orderBy('test_id')
                                ->with('subjects','teachers','testnames')
                                ->get();
        return view('student.marks.get_test_marks',compact('asessionid','test_marks'));
    }
}
