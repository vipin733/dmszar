<?php

namespace App\Http\Controllers\Staff\Students\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\DataTables\DataTableBase;
use App\StudentAcadmic;
use App\Asession;
use App\Student;
use Auth;

class ActiveStudentsViewController extends Controller
{
    
     public function __construct()
    {
       
        $this->middleware(['auth:teacher','active','staffs']); 
            
    }

     public function activestudents()
    {    
       $userID = Auth::user()->owner->id;

       $activesessionid = Asession::where('user_id',$userID)->where('active',1)->select('id')->first();

       if (!$activesessionid) {
                      
              flash()->warning('No session Active, please active current session first!');
              return redirect('/acadmic/asessions/create');

          }

       $students = StudentAcadmic::where('asession_id',$activesessionid->id)
                                  ->whereHas('students',function($q){
						       	   $q->where('active',1);
						        })->count();  
        $asessions= Asession::where('user_id',$userID)->orderBy('name')->pluck("name","id");                          
        return view('staff.students.active_all_students',compact('students','asessions'));
    }

    public function active_students_ajax(Request $request)
    {        
        $coursewise      = $request->course;
        $sectionwise     = $request->section;
    	$sessionwise     = $request->session;
	    $userID          = Auth::user()->owner->id;
	    
        $activesessionid = Asession::where('user_id',$userID)->where('active',1)->select('id')->first();
        $activesessionID = $activesessionid->id;
        $start=1;

	    if ($coursewise && $sectionwise) {

	    	if ($sessionwise) {

	    		$query = StudentAcadmic::where('section_id',$sectionwise)                               
                                  ->where('course_id',$coursewise)
                                  ->where('asession_id',$sessionwise)
	                               ->with('asessions','courses','sections','students');
	    	    	
	    		
	    	}else{
	      
	            $query = StudentAcadmic::where('asession_id',$activesessionID)                               
                                  ->where('course_id',$coursewise)
                                  ->where('section_id',$sectionwise)
                                  ->with('asessions','courses','sections','students');

               }

		}elseif($coursewise){
                
                if ($sessionwise) {
		         $query = StudentAcadmic::where('course_id',$coursewise)
                                ->where('asession_id',$sessionwise)
                                ->with('asessions','courses','sections','students');
	    		
		    	}else{
		      
		            $query = StudentAcadmic::where('course_id',$coursewise)
	                                         ->where('asession_id',$activesessionID)
	                                         ->with('asessions','courses','sections','students');

	               }


		 }elseif($sectionwise) {

               if ($sessionwise) {

		            $query = StudentAcadmic::where('section_id',$sectionwise)
		                                    ->where('asession_id',$sessionwise)
		                                    ->with('asessions','courses','sections','students');
	    		
		    	}else{
		      
		            $query = StudentAcadmic::where('section_id',$sectionwise)
		                                    ->where('asession_id',$activesessionID)
		                                    ->with('asessions','courses','sections','students');

	            }

		}elseif ($sessionwise) {
		            $query = StudentAcadmic::where(function($q) use($sessionwise){
                                $q->where('asession_id',$sessionwise);
	                         })->with('asessions','courses','sections','students');
	    		
		}else{
		      
		            $query = StudentAcadmic::where(function($q) use($activesessionID){
	                                $q->where('asession_id',$activesessionID);
		                         })->with('students','asessions','courses','sections');

	    }


	      $dataTable = Datatables::of($query)
	             ->addColumn('profile', function ($student) {
                  return '<a href="/st/student/'.$student->students->reg_no.'" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->editColumn('date_of_admission', function ($user) {
               return $user->students->date_of_admission->format('d/m/Y');
              })->addColumn('Serial_No', function ($query) use (&$start) {
                return $start++;
              })->addColumn('rollno', function ($q){
                return $q->sections->name.$q->roll_no;
              })->rawColumns(['profile','Serial_No','rollno']);          

	      $columns = ['Serial_No','date_of_admission','students.name', 'students.reg_no', 'asessions.name','courses.name','sections.name','rollno','students.father_name'];
	      $base = new DataTableBase($query, $dataTable, $columns);
	      return $base->render(null);


    }
}
