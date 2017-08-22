<?php

namespace App\Http\Controllers\Teacher\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Staff\Acadmic\TimeTable;
use Illuminate\Validation\Rule;
use App\TeacherTeachingAcadmic;
use App\Asession;
use App\Student;
use App\Course;
use App\Section;
use App\Subject;
use App\TestName;
use Carbon\Carbon;
use App\TestMark;
use Auth;

class TeacherStudentTestMarkController extends Controller
{
     public function __construct()
    {
	  
        $this->middleware(['auth:teacher','active','teachers']); 

    }

    public function test_course_section_get()
    {
    	$userID = Auth::user()->owner->id;
      $activesessionid = Asession::where('user_id',$userID)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first(); 

       if ($activesessionid) {
                       $activesessionidID = $activesessionid->id;         
          }else{
               $activesessionidID = 100000000000000000000;
          } 

      $timetables = TimeTable::where(function($q) use($userID,$activesessionidID){
                                      $q->where('user_id',$userID)
                                         ->where('asession_id',$activesessionidID);
                                   })->where(function($q){
                                      $q->orWhere('sunday_teacher_id',Auth::id())
                                         ->orWhere('monday_teacher_id',Auth::id())
                                         ->orWhere('tuesday_teacher_id',Auth::id())
                                         ->orWhere('wednesday_teacher_id',Auth::id())
                                         ->orWhere('thursday_teacher_id',Auth::id())
                                         ->orWhere('friday_teacher_id',Auth::id())
                                         ->orWhere('saturday_teacher_id',Auth::id());
                                   })->groupBy(['course_id','section_id'])->with('courses','sections')->get();
                                                                        

    	return view('teacher.student.marks.test_marks_classes_section',compact('timetables'));
    }

    public function test_subject_get($course = null, $section= null)
    {
      $userID = Auth::user()->owner->id;
      $activesessionid = Asession::where('user_id',$userID)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first(); 

       if ($activesessionid) {
                       $activesessionidID = $activesessionid->id;         
          }else{
               $activesessionidID = 100000000000000000000;
          } 

    $course = Course::where('id',$course)->where('user_id', $userID)->first();
                        
    $section = Section::where('id',$section)->where('user_id', $userID)->first();   

    $testnames = TestName::where('user_id',$userID)->get(); 

    $timetables = TimeTable::where(function($q) use($userID,$activesessionidID, $course,$section){
                                      $q->where('user_id',$userID)
                                         ->where('asession_id',$activesessionidID)
                                         ->where('course_id', $course->id)
                                         ->where('section_id', $section->id);
                                   })->where(function($q){
                                      $q->orWhere('sunday_teacher_id',Auth::id())
                                         ->orWhere('monday_teacher_id',Auth::id())
                                         ->orWhere('tuesday_teacher_id',Auth::id())
                                         ->orWhere('wednesday_teacher_id',Auth::id())
                                         ->orWhere('thursday_teacher_id',Auth::id())
                                         ->orWhere('friday_teacher_id',Auth::id())
                                         ->orWhere('saturday_teacher_id',Auth::id());
                                   })->get();
       //return $timetables;
        foreach ($timetables as $key => $value)
       {
              $sundaysubjects[]    = $value->sunday_subject_id;
              $mondaysubjects[]    = $value->monday_subject_id; 
              $tuesdaysubjects[]   = $value->tuesday_subject_id; 
              $wednsedaysubjects[] = $value->wednesday_subject_id; 
              $thursdaysubjects[]  = $value->thursday_subject_id;                 
              $fridaysubjects[]    = $value->friday_subject_id; 
              $saturdaysubjects[]  = $value->saturday_subject_id; 
       }   

       $subjectswithnull = array_merge($sundaysubjects, $mondaysubjects, $tuesdaysubjects, $wednsedaysubjects, $thursdaysubjects, $fridaysubjects, $saturdaysubjects);
       $null[] = null;
       $subjectswithnullunique = array_unique($subjectswithnull);
       $subjects = array_diff($subjectswithnullunique, $null);

       $subjectnames = Subject::whereIn('id',$subjects)->get();                                                                      
     //return $subjectnames;
      return view('teacher.student.marks.test_marks_subjects',compact('testnames','subjectnames','course','section'));
    }

    public function test_amrks_upload_get($course = null, $c_created_at= null, $section= null, $s_created_at= null, $subject = null, $su_created_at = null,$testname = null, $ts_created_at = null)
    {
    	$cdate=Carbon::createFromTimeStamp($c_created_at);

    	$sdate=Carbon::createFromTimeStamp($s_created_at);

      $sudate=Carbon::createFromTimeStamp($su_created_at);

      $tsdate=Carbon::createFromTimeStamp($ts_created_at);

      $userID = Auth::user()->owner->id;

    	$activesessionid = Asession::where('user_id', $userID)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();
      $test = TestName::where('user_id', $userID)
                                        ->where('id',$testname)
                                        ->where('created_at',$tsdate)                                       
                                         ->first();                                   

      
    $subject = Subject::where('id',$subject)
                         ->where('created_at',$sudate)
                        ->where('user_id', $userID)
                        ->select('id','name')
                        ->first();

    $course = Course::where('id',$course)
                         ->where('created_at',$cdate)
                        ->where('user_id', $userID)
                        ->select('id','name')
                        ->first();
                        
    $section = Section::where('id',$section)
                         ->where('created_at',$sdate)
                        ->where('user_id', $userID)
                        ->select('id','name')
                        ->first();

    	$students = Student::where('user_id',$userID)
                          ->where('active',1)
    	                     ->whereHas('studentacadmic',function($q) use($course){
    	                     	$q->where('course_id',$course->id);
    	                     })->whereHas('studentacadmic',function($q) use($section){
    	                     	$q->where('section_id',$section->id);
    	                     })->whereHas('studentacadmic',function($q) use($activesessionid){
    	                     	$q->where('asession_id',$activesessionid->id);
    	                     })->with('studentacadmic')->get();
    	                    

      return view('teacher.student.marks.test_marks_upload',compact('students','section','course','subject','test'));                 
    }

    public function test_amrks_upload_post(Request $r,$course = null, $c_created_at= null, $section= null, $s_created_at= null, $subject = null, $su_created_at = null,$testname = null, $ts_created_at = null)
    {
      

        $this->validate($r,[
            'score_mark'        =>      'required',
            'date'              =>      'required|date_format:d/m/Y',
            
        ]); 

    $user = Auth::user(); 
    $cdate=Carbon::createFromTimeStamp($c_created_at);
    $sdate=Carbon::createFromTimeStamp($s_created_at);
    $sudate=Carbon::createFromTimeStamp($su_created_at);
    $tsdate=Carbon::createFromTimeStamp($ts_created_at);

    $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();

    $subject = Subject::where('id',$subject)
                         ->where('created_at',$sudate)
                        ->where('user_id',$user->owner->id)
                        ->select('id')
                        ->first();

    $courseid = Course::where('id',$course)
                         ->where('created_at',$cdate)
                        ->where('user_id',$user->owner->id)
                        ->select('id')
                        ->first();
                        
    $sectionid = Section::where('id',$section)
                         ->where('created_at',$sdate)
                        ->where('user_id',$user->owner->id)
                        ->select('id')
                        ->first();   

$test = TestName::where('user_id',$user->owner->id)
                                        ->where('id',$testname)
                                        ->where('created_at',$tsdate) 
                                         ->select('id','max_mark')                                      
                                         ->first();                                                    

  $students = Student::where('user_id',$user->owner->id)
                          ->where('active',1)
                             ->whereHas('studentacadmic.courses',function($q) use($course,$cdate){
                                $q->where('id',$course)
                                ->where('created_at',$cdate);
                             })->whereHas('studentacadmic.sections',function($q) use($section,$sdate){
                                $q->where('id',$section)
                                ->where('created_at',$sdate);
                             })->whereHas('studentacadmic',function($q) use($activesessionid){
                                $q->where('asession_id',$activesessionid->id);
                             })->get();
                                        

       foreach ($students as $key => $value)
        {

          $notrepeat = TestMark::where('asession_id',$activesessionid->id)
                                 ->where('test_id',$test->id)
                                 ->where('student_id', $value->id)
                                 ->where('subject_id',$subject->id)
                                 ->first();
           if ($notrepeat) 
             {
              flash('Sorry! You already uploaded test marks, for this.', 'danger');

              return back(); 
                            
              }else{                    

             $data = [
            'asession_id'    => $activesessionid->id,
            'taker_id'       => Auth::id(),
            'test_id'        => $test->id,
            'course_id'      => $courseid->id,
            'section_id'     => $sectionid->id,
            'subject_id'     => $subject->id ,
            'date'           => $r->date,
            'max_mark'       => $test->max_mark,
            'score_mark'     => $r->score_mark [$key]
           ];
            
             $value->testmarks()->create($data);

          }                                                    
        } 

        flash()->success('Successfully marks uploaded!');     

        return back();                                                  
    }

    public function test_amrks_edit($course = null, $c_created_at= null, $section= null, $s_created_at= null, $subject = null, $su_created_at = null,$testname = null, $ts_created_at = null)
    {
      $cdate=Carbon::createFromTimeStamp($c_created_at);
      $sdate=Carbon::createFromTimeStamp($s_created_at);
      $sudate=Carbon::createFromTimeStamp($su_created_at);
      $tsdate=Carbon::createFromTimeStamp($ts_created_at);

      $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();
                                   
      $testmarks = TestMark::where('asession_id',$activesessionid->id)
                                 ->whereHas('testnames',function($q) use($testname,$tsdate){
                                  $q->where('id',$testname)
                                     ->where('created_at',$tsdate);
                                 })->whereHas('subjects',function($q) use($subject,$sudate){
                                  $q->where('id',$subject)
                                     ->where('created_at',$sudate);
                                   })->whereHas('courses',function($q) use($course,$cdate){
                                  $q->where('id',$course)
                                     ->where('created_at',$cdate);
                                   })->whereHas('sections',function($q) use($section,$sdate){
                                  $q->where('id',$section)
                                     ->where('created_at',$sdate);
                                   })->with('courses','subjects','testnames','sections','students','students.studentacadmic','students.studentacadmic.sections')
                                   ->get();                        
       
      return view('teacher.student.marks.test_amrks_edit',compact('testmarks'));                 
    }

    public function test_amrks_update(Request $r,$course = null, $c_created_at= null, $section= null, $s_created_at= null, $subject = null, $su_created_at = null,$testname = null, $ts_created_at = null)
    {
       $this->validate($r,[
            'score_mark'        =>      'required',
            'date'              =>      'required|date_format:d/m/Y',
            
        ]);
      $cdate=Carbon::createFromTimeStamp($c_created_at);
      $sdate=Carbon::createFromTimeStamp($s_created_at);
      $sudate=Carbon::createFromTimeStamp($su_created_at);
      $tsdate=Carbon::createFromTimeStamp($ts_created_at);
      $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();
      $testmarks = TestMark::where('asession_id',$activesessionid->id)
                                 ->whereHas('testnames',function($q) use($testname,$tsdate){
                                  $q->where('id',$testname)
                                     ->where('created_at',$tsdate);
                                 })->whereHas('subjects',function($q) use($subject,$sudate){
                                  $q->where('id',$subject)
                                     ->where('created_at',$sudate);
                                   })->whereHas('courses',function($q) use($course,$cdate){
                                  $q->where('id',$course)
                                     ->where('created_at',$cdate);
                                   })->whereHas('sections',function($q) use($section,$sdate){
                                  $q->where('id',$section)
                                     ->where('created_at',$sdate);
                                   })->get();

        foreach ($testmarks as $key => $value) 
        {
                 $data = [
            'date'           => $r->date,
            'score_mark'     => $r->score_mark [$key]
           ];
            
             $value->update($data);                    # code...
        }                           
         
       flash()->success('Successfully marks updated!');     

        return back();  
    }
}
