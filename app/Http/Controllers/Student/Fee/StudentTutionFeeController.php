<?php

namespace App\Http\Controllers\Student\Fee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TutionFeeCollection;
use Carbon\Carbon;
use App\Asession;
use Auth;
use PDF;


class StudentTutionFeeController extends Controller
{
    
	 public function __construct()
    {
     
        $this->middleware(['auth:student','active']);
            
    }

     public function tution_getsessions()
    {        
        $tutions = TutionFeeCollection::selectRaw('asession_id')
                     ->orderBy('asession_id')
                     ->groupBy('asession_id')
                     ->where('student_id',Auth::id())
                      ->where('active',1)
                     ->with('asessions')
                     ->get();

                     //return $tutions;
        return view('student.fee.tution_fee.tution_fee_detail_getsessions',compact('tutions'));
    }

    public function tution_fee_detail($asession = null, $created_at = null)
    {
         $adate=Carbon::createFromTimeStamp($created_at);

         $sessionid = Asession::where('id',$asession)
                                ->where('created_at',$adate)
                                ->select('id','name')
                                ->first();

        $tutionfees = TutionFeeCollection::where('student_id',Auth::id())
                     ->where('asession_id',$sessionid->id)
                      ->where('active',1)
                     ->with('courses')
                     ->get();

        return view('student.fee.tution_fee.tution_fee_detail',compact('tutionfees','sessionid'));
    }

    public function tution_fee_receipt($tutionfee = null, $created_at = null)
    {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $tdate=Carbon::createFromTimeStamp($created_at);

        $tutionfee = TutionFeeCollection::where('student_id',Auth::id())
                     ->where('id',$tutionfee)
                     ->where('created_at',$tdate)
                      ->where('active',1)
                     ->with('courses','students','asessions','takers')->first();

        $total = collect([$tutionfee->tution_fee,$tutionfee->other_fee,$tutionfee->late_fee])->sum();

        return view('student.fee.tution_fee.fee_receipt_tution_view',compact('tutionfee','owner','total'));
    }

    public function tution_fee_receipt_print($tutionfee = null, $created_at = null)
    {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $tdate=Carbon::createFromTimeStamp($created_at);

        $tutionfee = TutionFeeCollection::where('student_id',Auth::id())
                     ->where('id',$tutionfee)
                     ->where('created_at',$tdate)
                      ->where('active',1)
                     ->with('courses','students','asessions','takers')->first();

      $session =   $tutionfee->asessions->name;
      $month   =   $tutionfee->month->format('F');               

      $total = collect([$tutionfee->tution_fee,$tutionfee->other_fee,$tutionfee->late_fee])->sum();

      $pdf=PDF::loadView('student.fee.tution_fee.fee_receipt_tution_print',compact('tutionfee','total','owner'));

      return $pdf->stream($tutionfee->students->name.'-tuiton-reciept-'. $session . '-' . $month . '.' .'pdf');             

    }

    public function tution_fee_receipt_download($tutionfee = null, $created_at = null)
    {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $tdate=Carbon::createFromTimeStamp($created_at);

        $tutionfee = TutionFeeCollection::where('student_id',Auth::id())
                     ->where('id',$tutionfee)
                     ->where('created_at',$tdate)
                      ->where('active',1)
                     ->with('courses','students','asessions','takers')->first();

      $total = collect([$tutionfee->tution_fee,$tutionfee->other_fee,$tutionfee->late_fee])->sum();

      $session =   $tutionfee->asessions->name;
      $month   =   $tutionfee->month->format('F'); 

      $pdf=PDF::loadView('student.fee.tution_fee.fee_receipt_tution_print',compact('tutionfee','total','owner'));

      return $pdf->download($tutionfee->students->name.'-tuiton-reciept-'. $session . '-' . $month . '.' .'pdf');             

    }
}
