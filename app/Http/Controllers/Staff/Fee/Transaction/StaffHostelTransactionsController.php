<?php

namespace App\Http\Controllers\Staff\Fee\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\DataTables\DataTableBase;
use App\HostelFeeCollection;
use App\Asession;
use Carbon\Carbon;
use Auth;

class StaffHostelTransactionsController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }

    

    public function hostel_transactions()
    { 
      $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first(); 
         if ($activesessionid) {
                       $activesessionidID = $activesessionid->id;         
          }else{
               $activesessionidID = 100000000000000000000;
          }  
                                           
        $hostel_fees = HostelFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->selectRaw('sum(`hostel_fee`) as hostel_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')->first();
     
         $total = $hostel_fees->hostel_fee+$hostel_fees->late_fee+$hostel_fees->other_fee;                          
        
        return view('staff.fee_analysis.hostel.hostel_transactions',compact('total'));
    }

     public function hostel_transactions_ajax(Request $request)
    { 
      $starts = $request->start_at;
      $ende = $request->end_at;
      $course = $request->course;
      $dates = str_replace('/', '-', $starts);
      $datee = str_replace('/', '-', $ende);
      $start = date('Y-m-d', strtotime($dates));
      $end = date('Y-m-d', strtotime($datee));
      $start_at_no=1;
      $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first(); 

       if ($activesessionid) {
                       $activesessionidID = $activesessionid->id;         
          }else{
               $activesessionidID = 100000000000000000000;
          }                                     


      if (($starts) && ($ende))
       {
         if ($course) {

          //dd($dates);
           $query = HostelFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->where(function($q) use ($start,$end,$course){
                                        $q->whereDate('created_at','>=',$start)
                                         ->whereDate('created_at','<=',$end)
                                         ->where('course_id',$course);
                                    })->with('courses','students');


         }else {
           $query = HostelFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->where(function($q) use ($start,$end){
                                        $q->whereDate('created_at','>=',$start)
                                         ->whereDate('created_at','<=',$end);
                                    })->with('courses','students');
         }
      }elseif($course){
        $query = HostelFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->where(function($q) use ($course){
                                        $q->where('course_id',$course);
                                    })->with('courses','students');
                    
        }
      else{
             $query = HostelFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->with('courses','students');
      }

      $dataTable = Datatables::of($query)
          ->addColumn('total', function ($s) {
                 return $s->hostel_fee + $s->late_fee + $s->other_fee ;
          })->addColumn('view_hostel_fee', function ($q) {
                  return '<a href="/staff/student/receipt/'.$q->id.'/'.strtotime($q->created_at).'/fee/hostel" class="btn btn-xs btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
          })->addColumn('print_hostel_fee', function ($q) {
                  return '<a href="/staff/student/receipt/'.$q->id.'/'.strtotime($q->created_at).'/fee/hostel/print" class="btn btn-xs btn-success"><i class="fa fa-print faa-vertical animated" aria-hidden="true"></i></a>';
          })->addColumn('download_hostel_fee', function ($q) {
                  return '<a href="/staff/student/receipt/'.$q->id.'/'.strtotime($q->created_at).'/fee/hostel/download" class="btn btn-xs btn-warning"><i class="fa fa-download faa-vertical animated" aria-hidden="true"></i></a>';
          })->addColumn('Serial_No', function ($employee) use (&$start_at_no) {
                return $start_at_no++;
          })->editColumn('created_at', function ($user) {
               return $user->created_at->format('d/m/Y');
           })->editColumn('late_fee', function ($user) {
              if ($user->late_fee) {
                return $user->late_fee;
              }else {
                return $user->late_fee = 0;
              }
         })->editColumn('other_fee', function ($user) {
              if ($user->other_fee) {
                return $user->other_fee;
              }else {
                return $user->other_fee = 0;
              }
         })->editColumn('remarks', function ($user) {
            if ($user->remarks) {
              return $user->remarks;
            }else {
              return $user->remarks = 'Fee Submited';
            }
       })->rawColumns(['total','view_hostel_fee','print_hostel_fee','download_hostel_fee','Serial_No']); 
       $columns = ['Serial_No','students.reg_no','courses.name','created_at', 'hostel_fee', 'late_fee', 'other_fee','total','remarks'];
      $base = new DataTableBase($query, $dataTable, $columns);
      return $base->render(null);
    }

   
}
