<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use Auth;
class StaffStudentProfileController extends Controller
{
     public function __construct()
    {

        $this->middleware(['auth:teacher','active']);

        $this->middleware('staffs')->except('course_profile','get_sessesion_test_mark','get_test_marks','get_sessesion_exam_mark','get_exam_marks','get_grades');            
    }

     public function course_profile($reg_no = null)
    {       
        $user = Auth::user();

        $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id','name')
                                         ->first(); 

          if (!$activesessionid) {

             if ($user->isStaff()) {

                flash()->warning('No session Active, please active current session first!');

               // return redirect()->to('');
                return redirect('/acadmic/asessions/create');
                 # code...
             }
               

               flash()->warning('No session Active, please contact to your institution admin!');

               // return redirect()->to('');
                return back();

          }                                   

        $studentacadmic = StudentAcadmic::whereHas('students',function($q) use ($reg_no){
                                             $q->where('reg_no',$reg_no)
                                                ->where('user_id',Auth::user()->owner->id);
                                          })->where('asession_id',$activesessionid->id)
                                          ->with('students','courses','courses.subjects','sections','courses.teacheracadmic.teachers')
                                          ->with(['courses.teacheracadmic' => function($q) use ($activesessionid){
                                            $q->where('asession_id',$activesessionid->id);
                                          }])->first(); 
       if (!count($studentacadmic)) {
           flash('No record found!'); 
           return back(); 
       }else{
        return view('staff.students.profile.course_profile',compact('studentacadmic','activesessionid'));
       }
        
    }

    public function get_sessesion_test_mark($reg_no)
    {
        
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->owner->id)
                            ->select('id','reg_no')
                            ->first();
        $sessions = TestMark::selectRaw('asession_id')
                     ->orderBy('asession_id')
                     ->groupBy('asession_id')
                     ->where('student_id',$student->id)
                     ->with('asessions')
                     ->get(); 

      return view('staff.students.profile.marks.test_marks.get_sessesion_test_mark',compact('sessions','student'));          
    }

    public function get_test_marks($asession = null, $created_at = null, $reg_no = null)
    {

        $created_at=Carbon::createFromTimeStamp($created_at);


        $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                         ->where('id',$asession)
                                         ->where('created_at',$created_at)
                                         ->first(); 

        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->owner->id)
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

        return view('staff.students.profile.marks.test_marks.get_test_marks',compact('activesessionid','test_marks','student'));
        
    }

    public function get_sessesion_exam_mark($reg_no = null)
    {
        
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->owner->id)
                            ->select('id','reg_no')
                            ->first();
        $sessions = ExamMark::selectRaw('asession_id')
                     ->orderBy('asession_id')
                     ->groupBy('asession_id')
                     ->where('student_id',$student->id)
                     ->with('asessions')
                     ->get(); 

      return view('staff.students.profile.marks.exam_marks.get_sessesion_exam_mark',compact('sessions','student'));          
    }

    public function get_exam_marks($asession = null, $created_at = null, $reg_no = null)
    {

        $created_at=Carbon::createFromTimeStamp($created_at);

        $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                         ->where('id',$asession)
                                         ->where('created_at',$created_at)
                                         ->first();                  
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->owner->id)
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

        return view('staff.students.profile.marks.exam_marks.get_exam_mark',compact('activesessionid','student','subjects','examnames','testnames'));            
    }

    public function get_grades($reg_no = null)
    {
         $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->owner->id)
                            ->first(); 

         return view('staff.students.profile.grades.get_grade',compact('student'));                         
    }

    public function fee_confirmation_requests($reg_no = null)
    {
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->owner->id)
                            ->first(); 

        $feeconfirmations = FeeConfirmation::where('student_id', $student->id)
                                          ->with('courses')                 
                                          ->latest()
                                          ->paginate(10);

        return view('staff.students.profile.requests.feeconfirmations.get_feeconfirmation',compact('student','feeconfirmations'));                                                    
    }

    public function fee_fee_requests($reg_no = null)
    {
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->owner->id)
                            ->first(); 

        $feerequests = FeeRequest::where('student_id', $student->id)
                                        ->with('action_taken_by','feerequestcategories')               
                                        ->latest()
                                        ->paginate(10);

        return view('staff.students.profile.requests.feerequests.get_feerequest',compact('student','feerequests'));                                                    
    }

    public function marksheet_requests($reg_no = null)
    {
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->owner->id)
                            ->first(); 

       $marksheetrequests = MarkSheetRequest::where('student_id', $student->id)
                                     ->with('courses')
                                     ->latest()
                                     ->paginate(10);

        return view('staff.students.profile.requests.marksheetrequests.get_marksheet_request',compact('student','marksheetrequests'));                                                    
    }

    public function certificate_requests($reg_no = null)
    {
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->owner->id)
                            ->first(); 

       $ccrequests = CCRequest::where('student_id', $student->id)
                                     ->with('certificatecategories')
                                     ->latest()
                                     ->paginate(10);

        return view('staff.students.profile.requests.certificaterequests.get_certificate_request',compact('student','ccrequests'));                                                    
    }

    public function log_requests($reg_no = null)
    {
        $student = Student::where('reg_no',$reg_no)
                            ->where('user_id',Auth::user()->owner->id)
                            ->first(); 

       $logrequests = LogRequest::where('student_id', $student->id)
                                     ->with('logrequestcategories')
                                     ->latest()
                                     ->paginate(10);

        return view('staff.students.profile.requests.logequests.get_log_request',compact('student','logrequests'));                                                    
    }


}
