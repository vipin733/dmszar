<?php

namespace App\Http\Controllers\Teacher\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Model\Staff\Acadmic\TimeTable;
use App\DataTables\DataTableBase;
use App\StudentAcadmic;
use App\Course;
use App\Section;
use Carbon\Carbon;
use App\Student;
use App\Asession;
use Auth;

class TeacherStudentViewController extends Controller
{

	 public function __construct()
    { 
        $this->middleware(['auth:teacher','active','teachers']);           
    }

     public function students()
    {          
    	
    	$userID = Auth::user()->owner->id;

    	$activesessionid = Asession::where('user_id',$userID)->where('active',1)->first();

        if (!$activesessionid) {              
               flash()->warning('No session Active, please contact to your institution admin!');
                return back();
          }
       
         $activesessionidID = $activesessionid->id;

          $coursessections = TimeTable::where(function($q) use($userID,$activesessionidID){
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
                                   })->groupBy(['course_id','section_id'])->with(['courses'=>function($q) {
                                            $q->orderBy('id');
                                   }])->with('sections')->select('course_id','section_id')->get();

         if (count($coursessections)) {
                      foreach ($coursessections as $key => $value) {
                         $courseID[]   = $value->course_id;
                         $sectionID[]  = $value->section_id;
                      }
         }else{
         	$courseID[]  = [null];
         	$sectionID[] = [null];
         }
                             

       $courseIDS = array_unique($courseID);
       $subjectIDS = array_unique($sectionID);

       $students = StudentAcadmic::where('asession_id',$activesessionidID)->whereIn('course_id',$courseIDS)->whereIn('section_id',$subjectIDS)->count();

       $courses  = Course::whereIn('id',$courseIDS)->pluck('name','id'); 
       $sections = Section::whereIn('id',$subjectIDS)->pluck('name','id'); 

       // return $coursessections;

        return view('teacher.student.all_students',compact('students','courses','sections'));
    }

    public function students_ajax(Request $request)
    {        
       $coursewise  = $request->course;
       $sectionwise = $request->section;

       $userID = Auth::user()->owner->id;

    	$activesessionid = Asession::where('user_id',$userID)->where('active',1)->first();

        if (!$activesessionid) {              
               flash()->warning('No session Active, please contact to your institution admin!');
                return back();
          }
       
        $activesessionidID = $activesessionid->id;

        $coursessections = TimeTable::where(function($q) use($userID,$activesessionidID){
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
                                   })->groupBy(['course_id','section_id'])->with(['courses'=>function($q) {
                                            $q->orderBy('id');
                                   }])->select('course_id','section_id')->get();
         if (count($coursessections)) {
                      foreach ($coursessections as $key => $value) {
                         $courseID[]   = $value->course_id;
                         $sectionID[]  = $value->section_id;
                      }
         }else{
         	$courseID[] = [null];
         	$sectionID[] = [null];
         }                            

       $courseIDS = array_unique($courseID);
       $subjectIDS = array_unique($sectionID);

        $start=1;
        
      if ($coursewise) {

      	if ($sectionwise) {
      		$query = StudentAcadmic::where('asession_id',$activesessionidID)
      		                         ->where('course_id',$coursewise)
      		                         ->where('section_id',$sectionwise)
      		                         ->with('students','courses','sections');
      	}else{
          
          $query = StudentAcadmic::where('asession_id',$activesessionidID)
      		                         ->where('course_id',$coursewise)
      		                         ->whereIn('section_id',$subjectIDS)
      		                         ->with('students','courses','sections');  
        }  		                                  
      }elseif($sectionwise){

          $query = StudentAcadmic::where('asession_id',$activesessionidID)
      		                         ->whereIn('course_id',$courseIDS)
      		                         ->where('section_id',$sectionwise)
      		                         ->with('students','courses','sections');
      }else{

      	    $query = StudentAcadmic::where('asession_id',$activesessionidID)
						      	    ->whereIn('course_id',$courseIDS)
						      	    ->whereIn('section_id',$subjectIDS)
						      	    ->with('students','courses','sections');
      }
      
     $dataTable = Datatables::of($query)
              ->addColumn('profile', function ($student) {
                  return '<a href="/st/student/'.$student->students->reg_no.'" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('Serial_No', function ($employee) use (&$start) {
                return $start++;
              })->addColumn('rollno', function ($q){
                return $q->sections->name.$q->roll_no;
              })->rawColumns(['profile','Serial_No','rollno']);

      $columns = ['Serial_No','students.name', 'students.reg_no', 'courses.name','sections.name','rollno','students.father_name'];
      $base = new DataTableBase($query, $dataTable, $columns);
      return $base->render(null);

    }
}
