<?php

namespace App\Http\Controllers\Staff\Fee\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\DataTables\DataTableBase;
use App\TransportFeeCollection;
use App\Asession;
use Carbon\Carbon;
use Auth;

class StaffTransportTransactionsController extends Controller
{
	 public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }


    public function transport_transactions()
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
       
          $transport_fees = TransportFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->selectRaw('sum(`transport_fee`) as transport_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')->first();

            $total = $transport_fees->transport_fee+$transport_fees->late_fee+$transport_fees->other_fee;
  
                          
        //,'other_fee','late_fee'
        return view('staff.fee_analysis.transport.transport_transactions',compact('total'));
    }

    public function transport_transactions_ajax(Request $request)
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
           $query = TransportFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->where(function($q) use ($start,$end,$course){
                                        $q->whereDate('created_at','>=',$start)
                                         ->whereDate('created_at','<=',$end)
                                         ->where('course_id',$course);
                                    })->with('courses','students');


         }else {
           $query = TransportFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->where(function($q) use ($start,$end){
                                        $q->whereDate('created_at','>=',$start)
                                         ->whereDate('created_at','<=',$end);
                                    })->with('courses','students');
         }
      }elseif($course){
        $query = TransportFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->where(function($q) use ($course){
                                        $q->where('course_id',$course);
                                    })->with('courses','students');
                    
        }
      else{
             $query = TransportFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->with('courses','students');
      }

      $dataTable = Datatables::of($query)
          ->addColumn('total', function ($s) {
                 return $s->transport_fee + $s->late_fee + $s->other_fee ;
          })->addColumn('view_transport_fee', function ($q) {
                  return '<a href="/staff/student/receipt/'.$q->id.'/'.strtotime($q->created_at).'/fee/transport" class="btn btn-xs btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
          })->addColumn('print_transport_fee', function ($q) {
                  return '<a href="/staff/student/receipt/'.$q->id.'/'.strtotime($q->created_at).'/fee/transport/print" class="btn btn-xs btn-success"><i class="fa fa-download faa-vertical animated" aria-hidden="true"></i></a>';
          })->addColumn('download_transport_fee', function ($q) {
                  return '<a href="/staff/student/receipt/'.$q->id.'/'.strtotime($q->created_at).'/fee/transport/download" class="btn btn-xs btn-warning"><i class="fa fa-download faa-vertical animated" aria-hidden="true"></i></a>';
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
              return $user->remarks = 'Monthly Fee Submited';
            }
       })->rawColumns(['total','view_transport_fee','print_transport_fee','download_transport_fee','Serial_No']); 
       $columns = ['Serial_No','students.reg_no','courses.name','created_at', 'transport_fee', 'late_fee', 'other_fee','total','remarks'];
      $base = new DataTableBase($query, $dataTable, $columns);
      return $base->render(null);
    }

    

    
}
