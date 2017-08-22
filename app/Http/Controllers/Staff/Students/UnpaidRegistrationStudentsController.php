<?php

namespace App\Http\Controllers\Staff\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\DataTables\DataTableBase;
use App\Student;
use App\Asession;
use Carbon\Carbon;
use Auth;

class UnpaidRegistrationStudentsController extends Controller
{
     public function __construct()
    {
       
        $this->middleware(['auth:teacher','active','staffs']); 
            
    } 

      public function unpaid_registraion()
    { 
      
        return view('staff.students.fee.unpaid_registraion');
    }

    public function unpaid_registraion_ajax(Request $request)
    {
	   $coursewise = $request->course;
	   //return $month;
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
                                            
	    $start=1;


	    if ($coursewise) {
	      
	            $query = Student::where(function($q) use($coursewise,$userID){
                                $q->where('active',1)
                                ->where('course_id',$coursewise)
                                ->where('user_id',$userID);
	                         })->whereDoesntHave('registraionfeecollections', function ($q) use($activesessionidID) {
                                $q->where('asession_id',$activesessionidID)
                                ->where('completed',1)
                                ->where('active',1);
                             })->with('courses');
		    }else{

		        $query = Student::where(function($q) use($userID){
	                                $q->where('active',1)
	                                ->where('user_id',$userID);
		                         })->whereDoesntHave('registraionfeecollections', function ($q) use($activesessionidID) {
                                     $q->where('asession_id',$activesessionidID)
                                     ->where('completed',1)
                                     ->where('active',1);
                                    })->with('courses');
		    }    

	   


	      $dataTable = Datatables::of($query)
	             ->addColumn('profile', function ($student) {
                  return '<a href="/st/student/'.$student->reg_no.'" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('pay_registration_fee', function ($student) {
                  return '<a href="/student/'.$student->reg_no.'/'.$student->uuid.'/registraion_fee/take" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('details_registration_fee', function ($student) {
                  return '<a href="/student/registraion_fee/'.$student->reg_no.'/'.$student->uuid.'/details" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('Serial_No', function ($employee) use (&$start) {
                return $start++;
              })->rawColumns(['profile','pay_registration_fee','details_registration_fee','Serial_No']);          

	      $columns = ['Serial_No','name', 'reg_no', 'courses.name','father_name', 'mother_name'];
	      $base = new DataTableBase($query, $dataTable, $columns);
	      return $base->render(null);

    }
}
