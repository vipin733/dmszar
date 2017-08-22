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

class UnpaidTutionStudentsController extends Controller
{
    public function __construct()
    {
       
        $this->middleware(['auth:teacher','active','staffs']); 
            
    } 

      public function unpaid_tution()
    { 
        
        return view('staff.students.fee.unpaid_tution');
    }

    public function unpaid_tution_ajax(Request $request)
    {
	   $coursewise = $request->course;
	   $month = $request->month;
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

	   $current_month = Carbon::now()->month;

	   if ($month) {

	    if ($coursewise) {
	      
	            $query = Student::where(function($q) use($coursewise,$userID){
                                $q->where('active',1)
                                ->where('course_id',$coursewise)
                                ->where('user_id',$userID);
	                         })->whereDoesntHave('tutionfeecollections', function ($q) use($month,$activesessionidID) {
                                $q->whereMonth('month','=',$month)
                                 ->where('asession_id',$activesessionidID)
                                 ->where('active',1);
                             })->with('courses');
		    }else{

		        $query = Student::where(function($q) use($userID){
	                                $q->where('active',1)
	                                ->where('user_id',$userID);
		                         })->whereDoesntHave('tutionfeecollections', function ($q) use($month,$activesessionidID) {
                                     $q->whereMonth('month','=',$month)
                                     ->where('asession_id',$activesessionidID)
                                     ->where('active',1);
                                    })->with('courses');
		    }    

	   }elseif ($coursewise) {
	            $query = Student::where(function($q) use($coursewise,$userID){
                                $q->where('active',1)
                                ->where('course_id',$coursewise)
                                ->where('user_id',$userID);
	                        })->whereDoesntHave('tutionfeecollections', function ($q) use($current_month,$activesessionidID) {
                                  $q->whereMonth('month','=',$current_month)
                                  ->where('asession_id',$activesessionidID)
                                  ->where('active',1);
	                             })->with('courses');
	   }else {

	            $query = Student::where(function($q) use($userID){
	                                $q->where('active',1)
	                                ->where('user_id',$userID);
		                         })->whereDoesntHave('tutionfeecollections', function ($q) use($current_month,$activesessionidID) {
                                    $q->whereMonth('month','=',$current_month)
                                    ->where('asession_id',$activesessionidID)
                                    ->where('active',1);
                                 })->with('courses');
	      }


	      $dataTable = Datatables::of($query)
	             ->addColumn('profile', function ($student) {
                  return '<a href="/st/student/'.$student->reg_no.'" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('pay_tutuion_fee', function ($student) {
                  return '<a href="/student/'.$student->reg_no.'/'.$student->uuid.'/tution_fee/take" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('details_tutuion_fee', function ($student) {
                  return '<a href="/student/tution_fee/'.$student->reg_no.'/'.$student->uuid.'/details" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('Serial_No', function ($employee) use (&$start) {
                return $start++;
              })->rawColumns(['profile','pay_tutuion_fee','details_tutuion_fee','Serial_No']);          

	      $columns = ['Serial_No','name', 'reg_no', 'courses.name','father_name', 'mother_name'];
	      $base = new DataTableBase($query, $dataTable, $columns);
	      return $base->render(null);

    }

}
