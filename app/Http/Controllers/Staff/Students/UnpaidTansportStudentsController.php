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

class UnpaidTansportStudentsController extends Controller
{
    public function __construct()
    {
       
        $this->middleware(['auth:teacher','active','staffs']); 
            
    } 

      public function unpaid_transport()
    { 
    
        return view('staff.students.fee.unpaid_transport');
    }

    public function unpaid_transport_ajax(Request $request)
    {
	   $coursewise = $request->course;
     $month = $request->month;
     $stopage = $request->stopage;

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

     if ($month && $stopage) {

      if ($coursewise) {
        
              $query = Student::where(function($q) use($coursewise,$stopage,$userID){
                                $q->where('active',1)
                                ->where('transportation',1)
                                ->where('course_id',$coursewise)
                                ->where('stopage_id',$stopage)
                                 ->where('user_id',$userID);
                           })->whereDoesntHave('transportfeecollections', function ($q) use($month,$activesessionidID) {
                                $q->whereMonth('month','=',$month)
                                 ->where('asession_id',$activesessionidID)
                                  //->where('completed',1)
                                  ->where('active',1);
                             })->with('courses','stopages');
        }else{

            $query = Student::where(function($q) use($stopage,$userID){
                                  $q->where('active',1)
                                  ->where('transportation',1)
                                   ->where('stopage_id',$stopage)
                                    ->where('user_id',$userID);
                             })->whereDoesntHave('transportfeecollections', function ($q) use($month,$activesessionidID) {
                                     $q->whereMonth('month','=',$month)
                                     ->where('asession_id',$activesessionidID)
                                      //->where('completed',1)
                                      ->where('active',1);
                                    })->with('courses','stopages');
        }    

     }elseif ($coursewise) {

        if ($month) {
                  

              $query = Student::where(function($q) use($coursewise,$userID){
                                $q->where('active',1)
                                ->where('transportation',1)
                                ->where('course_id',$coursewise)
                                 ->where('user_id',$userID);
                          })->whereDoesntHave('transportfeecollections', function ($q) use($month,$activesessionidID) {
                                  $q->whereMonth('month','=',$month)
                                  ->where('asession_id',$activesessionidID)
                                  // ->where('completed',1)
                                  ->where('active',1);
                               })->with('courses','stopages');
        }

         else{

              $query = Student::where(function($q) use($coursewise,$userID){
                                $q->where('active',1)
                                ->where('transportation',1)
                                ->where('course_id',$coursewise)
                                 ->where('user_id',$userID);
                          })->whereDoesntHave('transportfeecollections', function ($q) use($current_month,$activesessionidID) {
                                  $q->whereMonth('month','=',$current_month)
                                  ->where('asession_id',$activesessionidID)
                                  // ->where('completed',1)
                                  ->where('active',1);
                               })->with('courses','stopages');

         }

     }elseif($stopage) {

            if ($coursewise) {

              $query = Student::where(function($q) use($coursewise, $stopage,$userID){
                                  $q->where('active',1)
                                  ->where('transportation',1)
                                  ->where('course_id',$coursewise)
                                ->where('stopage_id',$stopage)
                                 ->where('user_id',$userID);
                             })->whereDoesntHave('transportfeecollections', function ($q) use($current_month,$activesessionidID) {
                                    $q->whereMonth('month','=',$current_month)
                                    ->where('asession_id',$activesessionidID)
                                     //->where('completed',1)
                                     ->where('active',1);
                                 })->with('courses','stopages');
             
            }else{


              $query = Student::where(function($q) use($stopage,$userID){
                                  $q->where('active',1)
                                  ->where('transportation',1)
                                ->where('stopage_id',$stopage)
                                 ->where('user_id',$userID);
                             })->whereDoesntHave('transportfeecollections', function ($q) use($current_month,$activesessionidID) {
                                    $q->whereMonth('month','=',$current_month)
                                    ->where('asession_id',$activesessionidID)
                                     //->where('completed',1)
                                     ->where('active',1);
                                 })->with('courses','stopages');

            }


        }elseif($month){
        
              $query = Student::where(function($q) use($userID){
                                  $q->where('active',1)
                                  ->where('transportation',1)
                                   ->where('user_id',$userID);
                             })->whereDoesntHave('transportfeecollections', function ($q) use($month,$activesessionidID) {
                                    $q->whereMonth('month','=',$month)
                                    ->where('asession_id',$activesessionidID)
                                     //->where('completed',1)
                                     ->where('active',1);
                                 })->with('courses','stopages');
        }else{

          $query = Student::where(function($q) use($userID){
                                  $q->where('active',1)
                                  ->where('transportation',1)
                                   ->where('user_id',$userID);
                             })->whereDoesntHave('transportfeecollections', function ($q) use($current_month,$activesessionidID) {
                                    $q->whereMonth('month','=',$current_month)
                                    ->where('asession_id',$activesessionidID)
                                     //->where('completed',1)
                                     ->where('active',1);
                                 })->with('courses','stopages');
        }

	      $dataTable = Datatables::of($query)
	             ->addColumn('profile', function ($student) {
                  return '<a href="/st/student/'.$student->reg_no.'" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('pay_transport_fee', function ($student) {
                  return '<a href="/student/'.$student->reg_no.'/'.$student->uuid.'/transport_fee/take" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('details_transport_fee', function ($student) {
                  return '<a href="/student/transport_fee/'.$student->reg_no.'/'.$student->uuid.'/details" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('Serial_No', function ($employee) use (&$start) {
                return $start++;
              })->rawColumns(['profile','pay_transport_fee','details_transport_fee','Serial_No']);          

	      $columns = ['Serial_No','name', 'reg_no', 'courses.name','stopages.name','father_name', 'mother_name'];
	      $base = new DataTableBase($query, $dataTable, $columns);
	      return $base->render(null);

    }
}


   