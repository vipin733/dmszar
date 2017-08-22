<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeacherTeachingAcadmic;
use App\Asession;
use App\Student;
use App\Course;
use App\Section;
use App\Subject;
use App\ExamName;
use Carbon\Carbon;
use App\ExamMark;
use Auth;

class StudentExamMarkController extends Controller
{
     public function __construct()
    {
	  
        $this->middleware(['auth:teacher','active','staffs']); 

    }

     public function manage_marks_exam_get_courses()
    { 
    	$courses = Course::where('user_id',Auth::user()->owner->id)->with('sections')->get();

       $sections = Section::where('user_id',Auth::user()->owner->id)->count();

    	return view('staff.students.marks.manage_marks_exam_get_courses',compact('courses','sections'));
    }

     public function manage_marks_exam_get_subjects($course = null, $created_at= null,$section = null, $screated_at= null)
    {
          $cdate=Carbon::createFromTimeStamp($created_at);

          $sdate=Carbon::createFromTimeStamp($screated_at);

          $course = Course::where('user_id',Auth::user()->owner->id)
                          ->where('id',$course)
                          ->where('created_at',$cdate)
                          ->with('subjects')
                          ->first();

          $section = Section::where('user_id',Auth::user()->owner->id)
                          ->where('id',$section)
                          ->where('created_at',$sdate)
                          ->first();

          $examnames = ExamName::where('user_id',Auth::user()->owner->id)->get();                                                                                            
        
        return view('staff.students.marks.manage_marks_exam_get_subjects',compact('course','section','examnames'));
    }


     public function exam_amrks_upload_get($course = null, $created_at= null,$section = null, $screated_at= null,$examname = null, $ex_created_at= null,$subject = null, $su_created_at=null)
    {
          $cdate=Carbon::createFromTimeStamp($created_at);
          
          $sdate=Carbon::createFromTimeStamp($screated_at);

          $exdate=Carbon::createFromTimeStamp($ex_created_at);

          $sudate=Carbon::createFromTimeStamp($su_created_at);

          $courseid = Course::where('user_id',Auth::user()->owner->id)
                          ->where('id',$course)
                          ->where('created_at',$cdate)
                          ->with('subjects')
                          ->first();
        $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id','name')
                                         ->first();                 

          $sectionid = Section::where('user_id',Auth::user()->owner->id)
                          ->where('id',$section)
                          ->where('created_at',$sdate)
                          ->first();

          $subjectid = Subject::where('user_id',Auth::user()->owner->id)
                          ->where('id',$subject)
                          ->where('created_at',$sudate)
                          ->first();               

          $examnameid = ExamName::where('user_id',Auth::user()->owner->id)
                                 ->where('id',$examname)
                                ->where('created_at',$exdate)
                                ->first(); 
          $students = Student::where('user_id',Auth::user()->owner->id)
                                ->where('active',1)
                                ->whereHas('studentacadmic',function($q) use($sectionid,$courseid,$activesessionid) {
                                       $q->where('section_id',$sectionid->id)
                                          ->where('course_id',$courseid->id)
                                          ->where('asession_id',$activesessionid->id);
                               })->with('studentacadmic','studentacadmic.sections')->get();
       
        return view('staff.students.marks.exam_amrks_upload',compact('courseid','sectionid','examnameid','activesessionid','subjectid','students'));
    }

    public function exam_amrks_upload_post(Request $r, $course = null, $created_at= null,$section = null, $screated_at= null,$examname = null, $ex_created_at= null,$subject = null, $su_created_at=null)
    {
          $this->validate($r,[
            'score_mark'        =>      'required',
            'date'              =>      'required|date_format:d/m/Y',
            
        ]); 

          $cdate=Carbon::createFromTimeStamp($created_at);
          
          $sdate=Carbon::createFromTimeStamp($screated_at);

          $exdate=Carbon::createFromTimeStamp($ex_created_at);

          $sudate=Carbon::createFromTimeStamp($su_created_at);

          $courseid = Course::where('user_id',Auth::user()->owner->id)
                          ->where('id',$course)
                          ->where('created_at',$cdate)
                          ->with('subjects')
                          ->first();
        $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id','name')
                                         ->first();                 

          $sectionid = Section::where('user_id',Auth::user()->owner->id)
                          ->where('id',$section)
                          ->where('created_at',$sdate)
                          ->first();

          $subjectid = Subject::where('user_id',Auth::user()->owner->id)
                          ->where('id',$subject)
                          ->where('created_at',$sudate)
                          ->first();               

          $examnameid = ExamName::where('user_id',Auth::user()->owner->id)
                                 ->where('id',$examname)
                                ->where('created_at',$exdate)
                                ->first(); 
          $students = Student::where('user_id',Auth::user()->owner->id)
                               ->where('active',1)
                               ->whereHas('studentacadmic',function($q) use($sectionid,$courseid,$activesessionid) {
                                       $q->where('section_id',$sectionid->id)
                                          ->where('course_id',$courseid->id)
                                          ->where('asession_id',$activesessionid->id);
                               })->get();

          foreach ($students as $key => $value)
           {
              $notrepeat = ExamMark::where('asession_id',$activesessionid->id)
                                 ->where('exam_id',$examnameid->id)
                                 ->where('student_id', $value->id)
                                 ->where('subject_id',$subjectid->id)
                                 ->first();
             if ($notrepeat) 
             {
              flash('Sorry! You already uploaded exam marks, for this.', 'danger');

              return back(); 
                            
              }else{ 

               $data = [
              'asession_id'    => $activesessionid->id,
              'taker_id'       => Auth::id(),
              'exam_id'        => $examnameid->id,
              'course_id'      => $courseid->id,
              'section_id'     => $sectionid->id,
              'subject_id'     => $subjectid->id ,
              'date'           => $r->date,
              'max_mark'       => $examnameid->max_mark,
              'score_mark'     => $r->score_mark [$key]
           ];

           $value->exammarks()->create($data);
          }
        }

        flash()->success('Successfully marks uploaded!');     

        return back();                     
       
    }

    public function exam_amrks_edit($course = null, $created_at= null,$section = null, $screated_at= null,$examname = null, $ex_created_at= null,$subject = null, $su_created_at=null)
    {
      $cdate=Carbon::createFromTimeStamp($created_at);
          
          $sdate=Carbon::createFromTimeStamp($screated_at);

          $exdate=Carbon::createFromTimeStamp($ex_created_at);

          $sudate=Carbon::createFromTimeStamp($su_created_at);

      $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id','name')
                                         ->first();
                                   
      $exammarks = ExamMark::where('asession_id',$activesessionid->id)
                                 ->whereHas('examnames',function($q) use($examname,$exdate){
                                  $q->where('id',$examname)
                                     ->where('created_at',$exdate);
                                 })->whereHas('subjects',function($q) use($subject,$sudate){
                                  $q->where('id',$subject)
                                     ->where('created_at',$sudate);
                                   })->whereHas('courses',function($q) use($course,$cdate){
                                  $q->where('id',$course)
                                     ->where('created_at',$cdate);
                                   })->whereHas('sections',function($q) use($section,$sdate){
                                  $q->where('id',$section)
                                     ->where('created_at',$sdate);
                                   })->with('courses','subjects','examnames','sections','students','students.studentacadmic','students.studentacadmic.sections')
                                   ->get();

                                 
      //dd($exammarks);                        
       
      return view('staff.students.marks.exam_amrks_edit',compact('exammarks','activesessionid'));                 
    }

     public function exam_amrks_update(Request $r, $course = null, $created_at= null,$section = null, $screated_at= null,$examname = null, $ex_created_at= null,$subject = null, $su_created_at=null)
    {
          $cdate=Carbon::createFromTimeStamp($created_at);
          
          $sdate=Carbon::createFromTimeStamp($screated_at);

          $exdate=Carbon::createFromTimeStamp($ex_created_at);

          $sudate=Carbon::createFromTimeStamp($su_created_at);

      $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();
                                   
      $exammarks = ExamMark::where('asession_id',$activesessionid->id)
                                 ->whereHas('examnames',function($q) use($examname,$exdate){
                                  $q->where('id',$examname)
                                     ->where('created_at',$exdate);
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

        foreach ($exammarks as $key => $value) 
        {
                 $data = [
            'date'           => $r->date,
            'score_mark'     => $r->score_mark [$key]
           ];
            
             $value->update($data);                   
        }                           
         
       flash()->success('Successfully marks updated!');     

        return back();                 
    }
}
