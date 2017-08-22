<?php

namespace App\Http\Controllers\Auth\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Asession;
use App\StudentAcadmic;
use App\TestMark;
use App\ExamMark;
use App\Student;
use App\Subject;
use App\FeeConfirmation;
use App\MarkSheetRequest;
use App\FeeRequest;
use App\CCRequest;
use App\LogRequest;
use Carbon\Carbon;
use App\StudentAttendence;
use Auth;

class AuthStudentProfileController extends Controller
{
	 public function __construct()
    {

         $this->middleware(['auth','auth_active']);           
    }
     
     public function attendence_details_students(Request $request, $reg_no = null)
    {
        $users = Auth::user();

        $student = Student::where('user_id',$users->id)
                       ->where('reg_no', $reg_no)
                       ->with('courses')
                       ->first();

           $starts = $request->from;
            $ende = $request->to;
            $dates = str_replace('/', '-', $starts);
            $datee = str_replace('/', '-', $ende);
            $start = date('Y-m-d', strtotime($dates));
            $end = date('Y-m-d', strtotime($datee));
       
         $activesessionid = Asession::where('user_id',$users->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();
            if ($starts || $ende ) {
                    
                 $attendences = StudentAttendence::where('asession_id',$activesessionid->id)
                                             ->where('student_id',$student->id)
                                             ->whereDate('date','>=',$start)
                                             ->whereDate('date','<=',$end)
                                             ->with('taker')
                                             ->latest()
                                             ->paginate(7);
              } else{
                 $attendences = StudentAttendence::where('asession_id',$activesessionid->id)
                                                ->where('student_id',$student->id)
                                                ->with('taker')
                                                ->latest()
                                                ->paginate(7);
              }                

        return view('auth.students.profile.attendance.attendence_details_students',compact('student','attendences'));
    }

     public function course_profile($reg_no = null)
    {       

        $activesessionid = Asession::where('user_id',Auth::user()->id)
                                        ->where('active',1)
                                        ->select('id','name')
                                         ->first();  

        if ($activesessionid) {
               $activesessionID  = $activesessionid->id;      
         } else{
               
               $activesessionID  = 1000000000000000000000000;
         }                                  

        $studentacadmic = StudentAcadmic::whereHas('students',function($q) use ($reg_no){
                                             $q->where('reg_no',$reg_no)
                                                ->where('user_id',Auth::user()->id);
                                          })->where('asession_id',$activesessionID)
                                          ->with('students','courses','courses.subjects','sections','courses.teacheracadmic.teachers')
                                          ->with(['courses.teacheracadmic' => function($q) use ($activesessionID){
                                            $q->where('asession_id',$activesessionID);
                                          }])->first(); 
       if (!count($studentacadmic)) {
           flash('No record found!'); 
           return back(); 
       }else{
        return view('auth.students.profile.course_profile',compact('studentacadmic','activesessionid'));
       }
        
    }

    public function get_sessesion_test_mark($reg_no)
    {
        
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->id)
                            ->select('id','reg_no')
                            ->first();
        $sessions = TestMark::selectRaw('asession_id')
                     ->orderBy('asession_id')
                     ->groupBy('asession_id')
                     ->where('student_id',$student->id)
                     ->with('asessions')
                     ->get(); 

      return view('auth.students.profile.marks.test_marks.get_sessesion_test_mark',compact('sessions','student'));          
    }

    public function get_test_marks($asession = null, $created_at = null, $reg_no = null)
    {

        $created_at=Carbon::createFromTimeStamp($created_at);


        $activesessionid = Asession::where('user_id',Auth::user()->id)
                                         ->where('id',$asession)
                                         ->where('created_at',$created_at)
                                         ->first(); 

        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->id)
                            ->with(['studentacadmic' => function($q) use($activesessionid){
                                $q->where('asession_id',$activesessionid->id)
                                ->with('courses');
                            }])->first(); 
         //return $student;
        $test_marks = TestMark::where('student_id',$student->id)
                                ->where('asession_id',$activesessionid->id)
                                ->orderBy('test_id')
                                ->with('subjects','teachers','testnames')
                                ->get();              
        
        //return $test_marks;

        return view('auth.students.profile.marks.test_marks.get_test_marks',compact('activesessionid','test_marks','student'));
        
    }

    public function get_sessesion_exam_mark($reg_no = null)
    {
        
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->id)
                            ->select('id','reg_no')
                            ->first();
        $sessions = ExamMark::selectRaw('asession_id')
                     ->orderBy('asession_id')
                     ->groupBy('asession_id')
                     ->where('student_id',$student->id)
                     ->with('asessions')
                     ->get(); 

      return view('auth.students.profile.marks.exam_marks.get_sessesion_exam_mark',compact('sessions','student'));          
    }

    public function get_exam_marks($asession = null, $created_at = null, $reg_no = null)
    {

        $created_at=Carbon::createFromTimeStamp($created_at);

        $activesessionid = Asession::where('user_id',Auth::user()->id)
                                         ->where('id',$asession)
                                         ->where('created_at',$created_at)
                                         ->first();                  
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->id)
                            ->with(['studentacadmic' => function($q) use($activesessionid){
                                $q->where('asession_id',$activesessionid->id)
                                ->with('courses');
                            }])->first();              
        $subjects = Subject::whereHas('exammarks',function($q) use($activesessionid,$student){
                                    $q->where('asession_id',$activesessionid->id)
                                  ->where('student_id',$student->id);
                              })->whereHas('testmarks',function($q) use($activesessionid,$student){
                                  $q->where('asession_id',$activesessionid->id)
                                  ->where('student_id',$student->id);
                              })->with(['exammarks'=>function($q) use($activesessionid,$student){
                                 $q->where('asession_id',$activesessionid->id)
                                  ->where('student_id',$student->id);
                              }])->with(['testmarks'=>function($q) use($activesessionid,$student){
                                 $q->where('asession_id',$activesessionid->id)
                                  ->where('student_id',$student->id);
                              }])->get();
                                                                 
          $examnames = ExamMark::selectRaw('exam_id')
                     ->orderBy('exam_id')
                     ->groupBy('exam_id')
                     ->where('student_id',$student->id)
                     ->where('asession_id',$activesessionid->id)
                     ->with('examnames')
                     ->get(); 

           $testnames = TestMark::selectRaw('test_id')
                     ->orderBy('test_id')
                     ->groupBy('test_id')
                     ->where('student_id',$student->id)
                     ->where('asession_id',$activesessionid->id)
                     ->with('testnames')
                     ->get(); 

              //return $subjects; 

        return view('auth.students.profile.marks.exam_marks.get_exam_mark',compact('activesessionid','student','subjects','examnames','testnames'));            
    }

    public function get_grades($reg_no = null)
    {
         $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->id)
                            ->first(); 

         return view('auth.students.profile.grades.get_grade',compact('student'));                         
    }

    public function fee_confirmation_requests($reg_no = null)
    {
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->id)
                            ->first(); 

        $feeconfirmations = FeeConfirmation::where('student_id', $student->id)
                                          ->with('courses')                 
                                          ->latest()
                                          ->paginate(10);

        return view('auth.students.profile.requests.feeconfirmations.get_feeconfirmation',compact('student','feeconfirmations'));                                                    
    }

    public function fee_fee_requests($reg_no = null)
    {
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->id)
                            ->first(); 

        $feerequests = FeeRequest::where('student_id', $student->id)
                                        ->with('action_taken_by','feerequestcategories')               
                                        ->latest()
                                        ->paginate(10);

        return view('auth.students.profile.requests.feerequests.get_feerequest',compact('student','feerequests'));                                                    
    }

    public function marksheet_requests($reg_no = null)
    {
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->id)
                            ->first(); 

       $marksheetrequests = MarkSheetRequest::where('student_id', $student->id)
                                     ->with('courses')
                                     ->latest()
                                     ->paginate(10);

        return view('auth.students.profile.requests.marksheetrequests.get_marksheet_request',compact('student','marksheetrequests'));                                                    
    }

    public function certificate_requests($reg_no = null)
    {
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->id)
                            ->first(); 

       $ccrequests = CCRequest::where('student_id', $student->id)
                                     ->with('certificatecategories')
                                     ->latest()
                                     ->paginate(10);

        return view('auth.students.profile.requests.certificaterequests.get_certificate_request',compact('student','ccrequests'));                                                    
    }

    public function log_requests($reg_no = null)
    {
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->id)
                            ->first(); 

       $logrequests = LogRequest::where('student_id', $student->id)
                                     ->with('logrequestcategories')
                                     ->latest()
                                     ->paginate(10);

        return view('auth.students.profile.requests.logequests.get_log_request',compact('student','logrequests'));                                                    
    }
}
