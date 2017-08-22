<?php

namespace App\Http\Controllers\Teacher\Student\HomeWork;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Teacher\Student\StudentHomeWork;
use App\Model\Staff\Acadmic\TimeTable;
use App\StudentAcadmic;
use App\Asession;
use App\Section;
use App\Subject;
use App\Course;
use Auth;

class StudentHomeWorkController extends Controller
{
	 public function __construct()
    {
	  
        $this->middleware(['auth:teacher','active','teachers']); 

    }


     public function homework_course_section_get()
    {
    	$userID = Auth::user()->owner->id;
        $activesessionid = Asession::where('user_id',$userID)->where('active',1)->select('id')->first(); 

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

          if (!count($timetables)) {
                      
              flash()->warning('Class Section not found!');

              return back();

          }                           
                                                                        

    	return view('teacher.student.homework.get_class_section_for_homework',compact('timetables'));
    }

    public function homework_subject_get($course = null, $section= null)
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
      return view('teacher.student.homework.homework_subjects',compact('subjectnames','course','section'));
    }

    public function homework_upload_form(Request $request, $course = null, $section = null, $subject = null)
    {
    	  $userID = Auth::user()->owner->id;
        $activesessionID = Asession::where('user_id',$userID)->where('active',1)->select('id')->first()->id; 
    	  $course = Course::where('id',$course)->where('user_id', $userID)->first();                        
        $section = Section::where('id',$section)->where('user_id', $userID)->first();  
        $subject = Subject::where('id',$subject)->where('user_id', $userID)->first();

        $homeworks = StudentHomeWork::whereHas('teachers',function($q) use($userID){
                                          $q->where('user_id',$userID) ;
                                       })->where('teacher_id',Auth::id())->latest()->take(2)->get();

         //return$homeworks;                                             
       
       return view('teacher.student.homework.upload_homework',compact('subject','course','section','homeworks'));                                 
    }

   
    public function homework_upload(Request $r, $course = null, $section = null, $subject = null)
    {
    	$this->validate($r,[
            
            'homework'                => 'required',
            'submission_date_time'    => 'required|date_format:d/m/Y h:i A',

   	  	]);

    	$userID = Auth::user()->owner->id;

    	$courseID  = Course::where('id',$course)->where('user_id', $userID)->select('id')->first()->id;
    	$sectionID = Section::where('id',$section)->where('user_id', $userID)->select('id')->first()->id;  
        $subjectID = Subject::where('id',$subject)->where('user_id', $userID)->select('id')->first()->id;

        $activesessionID = Asession::where('user_id',$userID)->where('active',1)->select('id')->first()->id; 

         $data = [

              'course_id'             => $courseID,
              'section_id'            => $sectionID,
              'subject_id'            => $subjectID,
              'asession_id'           => $activesessionID,
              'homework'              => $r->homework,
              'remarks'               => $r->remarks,
              'submit_at'             => $r->submission_date_time,

            ];

            Auth::user()->homeworks()->create($data);

            flash()->success('Successfully Submitted!');
       
            return back();                        
      
    }

    public function homework_update(Request $r, $homework = null)
    {
    	$this->validate($r,[
            
            'homework'                => 'required',
            'submission_date_time'    => 'required|date_format:d/m/Y h:i A',

   	  	]);
      
        $homework = StudentHomeWork::where('id',$homework)->whereHas('teachers',function($q){
                                        $q->where('id',Auth::id())
                                           ->where('user_id',Auth::user()->owner->id);
                                        })->first(); 

         $data = [
              'homework'              => $r->homework,
              'remarks'               => $r->remarks,
              'submit_at'             => $r->submission_date_time,

            ];

            $homework->update($data);

            flash()->success('Successfully Homework Updated!');
       
            return back();                        
      
    }

    public function homework_delete(Request $r, $homework = null)
    {
      
        $homework = StudentHomeWork::where('id',$homework)->whereHas('teachers',function($q){
                                        $q->where('id',Auth::id())
                                           ->where('user_id',Auth::user()->owner->id);
                                        })->first(); 

        $homework->delete();

        flash()->success('Successfully Homework Deleted!'); 

        return back();                        
    }


}
