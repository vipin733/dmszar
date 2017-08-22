<?php

namespace App\Http\Controllers\Staff\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\DataTables\DataTableBase;
use Carbon\Carbon;
use App\Student;
use App\Asession;
use App\StudentAttendence;
use Auth;

class UnpaidHostelStudentsController extends Controller
{
    public function __construct()
    {
       
        $this->middleware(['auth:teacher','active','staffs']); 
            
    } 

     public function unpaid_hostel()
    { 
       
        
        return view('staff.students.fee.hostel.unpaid_hostel');
    }

    public function unpaid_hostel_ajax(Request $request)
    {
	   $coursewise = $request->course;
	   $hostel = $request->hostel;
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

         if ($hostel) {

              $query = Student::where(function($q) use($coursewise,$userID,$hostel){
                                $q->where('active',1)
                                ->where('course_id',$coursewise)
                                ->where('user_id',$userID)
                                ->where('hostel_type_id',$hostel)
                                ->where('hostel',1);
                           })->whereDoesntHave('hostelfeecollections', function ($q) use($activesessionidID) {
                                $q->where('asession_id',$activesessionidID)
                                ->where('completed',1)
                                ->where('active',1);
                             })->with('courses','hostels');
         }
	      
	            $query = Student::where(function($q) use($coursewise,$userID){
                                $q->where('active',1)
                                ->where('course_id',$coursewise)
                                ->where('user_id',$userID)
                                ->where('hostel',1);
	                         })->whereDoesntHave('hostelfeecollections', function ($q) use($activesessionidID) {
                                $q->where('asession_id',$activesessionidID)
                                ->where('completed',1)
                                ->where('active',1);
                             })->with('courses','hostels');
		    }elseif($hostel){

		        $query = Student::where(function($q) use($userID,$hostel){
	                                $q->where('active',1)
	                                ->where('hostel_type_id',$hostel)
                                  ->where('user_id',$userID)
	                                ->where('hostel',1);
		                         })->whereDoesntHave('hostelfeecollections', function ($q) use($activesessionidID) {
                                     $q->where('asession_id',$activesessionidID)
                                     ->where('completed',1)
                                     ->where('active',1);
                                    })->with('courses','hostels');
		    }else{

           $query = Student::where(function($q) use($userID){
                                  $q->where('active',1)
                                  ->where('user_id',$userID)
                                  ->where('hostel',1);
                             })->whereDoesntHave('hostelfeecollections', function ($q) use($activesessionidID) {
                                     $q->where('asession_id',$activesessionidID)
                                     ->where('completed',1)
                                     ->where('active',1);
                                    })->with('courses','hostels');

        }    

	    $dataTable = Datatables::of($query)
	             ->addColumn('profile', function ($student) {
                  return '<a href="/st/student/'.$student->reg_no.'" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('pay_hostel_fee', function ($student) {
                  return '<a href="/student/'.$student->reg_no.'/'.$student->uuid.'/hostel_fee/take" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('details_hostel_fee', function ($student) {
                  return '<a href="/student/hostel_fee/'.$student->reg_no.'/'.$student->uuid.'/details" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('Serial_No', function ($employee) use (&$start) {
                return $start++;
              })->rawColumns(['profile','pay_hostel_fee','details_hostel_fee','Serial_No']);          

	      $columns = ['Serial_No','name', 'reg_no', 'courses.name','hostels.name','father_name', 'mother_name'];
	      $base = new DataTableBase($query, $dataTable, $columns);
	      return $base->render(null);

    }

}
