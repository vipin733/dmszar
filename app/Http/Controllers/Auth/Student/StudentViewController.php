<?php

namespace App\Http\Controllers\Auth\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\DataTables\DataTableBase;
use App\Student;
use App\Asession;
use Auth;

class StudentViewController extends Controller
{

	public function __construct()
    {
       
        $this->middleware(['auth','auth_active']);
            
    }
    

     public function students()
    {        
        $students = Student::where('user_id',Auth::id())
                      ->with('courses','created_courses')->count();

        $sessions = Student::where('user_id',Auth::id())
                            ->groupBy('created_asession_id')
                            ->orderBy('created_asession_id')
                            ->with('asessions')->get();  

        //return $sessions;            

        return view('auth.students.students',compact('students','sessions'));
    }


    public function students_ajax(Request $request )
    {
    	$created_coursew = $request->created_course;
    	$sessionwise     = $request->session;

	    $userID = Auth::user()->id;

	    $activesessionids = Asession::where('user_id',$userID)->select('id')->get(); 
	    $start=1;


	    if ($sessionwise) {

	    	if ($created_coursew) {

	    		$query = Student::where(function($q) use($sessionwise,$created_coursew, $userID){
                                $q->where('created_asession_id',$sessionwise)
                                ->where('created_course_id',$created_coursew)
                                ->where('user_id',$userID);
	                         })->with('asessions','created_courses');
	    		
	    	}else{
	      
	            $query = Student::where(function($q) use($sessionwise,$userID){
                                $q->where('created_asession_id',$sessionwise)
                                ->where('user_id',$userID);
	                         })->with('asessions','created_courses');

               }

		}elseif($created_coursew){

		        $query = Student::where(function($q) use($userID,$created_coursew){
	                                $q->where('user_id',$userID)
	                                ->where('created_course_id',$created_coursew);
		                         })->with('asessions','created_courses');
		 }else {


		        $query = Student::where(function($q) use($userID){
	                                $q->where('user_id',$userID);
		                         })->with('asessions','created_courses');

		    } 


	      $dataTable = Datatables::of($query)
	             ->addColumn('profile', function ($student) {
                  return '<a href="/student/'.$student->reg_no.'" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->editColumn('date_of_admission', function ($user) {
               return $user->date_of_admission->format('d/m/Y');
              })->editColumn('active', function ($user) {
	               if ($user->active == 1) {
	                return 'Active';
	              }else {
	                return 'DeActivede';
	              };
              })->addColumn('Serial_No', function ($query) use (&$start) {
                return $start++;
              })->rawColumns(['profile','Serial_No']);          

	      $columns = ['Serial_No','date_of_admission','name', 'reg_no', 'asessions.name','created_courses.name','father_name', 'mother_name','active'];
	      $base = new DataTableBase($query, $dataTable, $columns);
	      return $base->render(null);

    }

}
