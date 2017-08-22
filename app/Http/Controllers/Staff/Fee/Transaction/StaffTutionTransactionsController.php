<?php

namespace App\Http\Controllers\Staff\Fee\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\DataTables\DataTableBase;
use App\TutionFeeCollection;
use App\Asession;
use Carbon\Carbon;
use Auth;

class StaffTutionTransactionsController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }

     public function tutions_transactions()
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

          $tution_fees = TutionFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->selectRaw('sum(`tution_fee`) as tution_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')->first();

            $total = $tution_fees->tution_fee+$tution_fees->late_fee+$tution_fees->other_fee;                                                                                              
              return view('staff.fee_analysis.tution.tutions_transactions',compact('total'));
    }

    public function tutions_transactions_ajax(Request $request)
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
           $query = TutionFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->where(function($q) use ($start,$end,$course){
                                        $q->whereDate('created_at','>=',$start)
                                         ->whereDate('created_at','<=',$end)
                                         ->where('course_id',$course);
                                    })->with('courses','students');


         }else {
           $query = TutionFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->where(function($q) use ($start,$end){
                                        $q->whereDate('created_at','>=',$start)
                                         ->whereDate('created_at','<=',$end);
                                    })->with('courses','students');
         }
      }elseif($course){
        $query = TutionFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->where(function($q) use ($course){
                                        $q->where('course_id',$course);
                                    })->with('courses','students');
                    
        }
      else{
             $query = TutionFeeCollection::whereHas('asessions',function($q) use($activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                      ->where('id',$activesessionidID);
                                    })->with('courses','students');
      }

      $dataTable = Datatables::of($query)
          ->addColumn('total', function ($s) {
                 return $s->tution_fee + $s->late_fee + $s->other_fee ;
          })->addColumn('view_tuition_fee', function ($tuition_fee) {
                  return '<a href="/staff/student/receipt/'.$tuition_fee->id.'/'.strtotime($tuition_fee->created_at).'/fee/tution" class="btn btn-xs btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
          })->addColumn('print_tuition_fee', function ($tuition_fee) {
                  return '<a href="/staff/student/receipt/'.$tuition_fee->id.'/'.strtotime($tuition_fee->created_at).'/fee/tution/print" class="btn btn-xs btn-success"><i class="fa fa-print faa-vertical animated" aria-hidden="true"></i></a>';
          })->addColumn('download_tuition_fee', function ($tuition_fee) {
                  return '<a href="/staff/student/receipt/'.$tuition_fee->id.'/'.strtotime($tuition_fee->created_at).'/fee/tution/download" class="btn btn-xs btn-warning"><i class="fa fa-download faa-vertical animated" aria-hidden="true"></i></a>';
          })->addColumn('Serial_No', function ($employee) use (&$start_at_no) {
                return $start_at_no++;
          })->editColumn('created_at', function ($user) {
               return $user->created_at->format('d/m/Y');
           })->editColumn('remarks', function ($user) {
            if ($user->remarks) {
              return $user->remarks;
            }else {
              return $user->remarks = 'Monthly Fee Submited';
            }
       })->rawColumns(['total','view_tuition_fee','print_tuition_fee','download_tuition_fee','Serial_No']); 
       $columns = ['Serial_No','students.reg_no','courses.name','created_at','total','remarks'];
      $base = new DataTableBase($query, $dataTable, $columns);
      return $base->render(null);
    }

    
}
