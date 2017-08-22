<?php

namespace App\Http\Controllers\Student\Fee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Asession;
use App\TransportFeeCollection;
use Carbon\Carbon;
use Auth;
use PDF;

class StudentTransportFeeController extends Controller
{

     public function __construct()
    {
     
        $this->middleware(['auth:student','active']);
        $this->middleware('transporttaken')->only('transport_getsessions','transport_fee_detail','transport_fee_receipt');
            
    }


     public function transport_getsessions()
    {        
        $transports = TransportFeeCollection::selectRaw('asession_id')
                     ->orderBy('asession_id')
                     ->groupBy('asession_id')
                     ->where('student_id',Auth::id())
                      ->where('active',1)
                     ->with('asessions')
                     ->get();
        return view('student.fee.transport_fee.transport_fee_detail_getsessions',compact('transports'));
    }

    public function transport_fee_detail($asession = null, $created_at = null)
    {
         $adate=Carbon::createFromTimeStamp($created_at);

         $sessionid = Asession::where('id',$asession)
                                ->where('created_at',$adate)
                                ->select('id','name')
                                ->first();

        $transportfees = TransportFeeCollection::where('student_id',Auth::id())
                     ->where('asession_id',$sessionid->id)
                     ->where('active',1)
                     ->with('courses')->get();

        return view('student.fee.transport_fee.transport_fee_detail',compact('transportfees','sessionid'));
    }

    public function transport_fee_receipt($transportfee = null, $created_at = null)
    {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $tdate=Carbon::createFromTimeStamp($created_at);

        $transportfee = TransportFeeCollection::where('student_id',Auth::id())
                     ->where('id',$transportfee)
                     ->where('created_at',$tdate)
                      ->where('active',1)
                     ->with('courses','students','asessions','takers','stopages')->first();

         $total = collect([$transportfee->transport_fee,$transportfee->other_fee,$transportfee->late_fee])->sum();            

        return view('student.fee.transport_fee.transport_fee_receipt_view',compact('transportfee','owner','total'));
    }

    public function transport_fee_receipt_print($transportfee = null, $created_at = null)
    {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $tdate=Carbon::createFromTimeStamp($created_at);

        $transportfee = TransportFeeCollection::where('student_id',Auth::id())
                     ->where('id',$transportfee)
                     ->where('created_at',$tdate)
                      ->where('active',1)
                     ->with('courses','students','asessions','takers','stopages')->first();

                    // return $transportfee;

      $session =   $transportfee->asessions->name;

     // return $session;

      $month   =   $transportfee->month->format('F');               

      $total = collect([$transportfee->transport_fee,$transportfee->other_fee,$transportfee->late_fee])->sum();

      $pdf=PDF::loadView('student.fee.transport_fee.fee_receipt_transport_print',compact('transportfee','total','owner'));

      return $pdf->stream($transportfee->students->name.'-transport-reciept-'. $session . '-' . $month . '.' .'pdf');             

    }

    public function transport_fee_receipt_download($transportfee = null, $created_at = null)
    {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $tdate=Carbon::createFromTimeStamp($created_at);

        $transportfee = TransportFeeCollection::where('student_id',Auth::id())
                     ->where('id',$transportfee)
                     ->where('created_at',$tdate)
                      ->where('active',1)
                     ->with('courses','students','asessions','takers','stopages')->first();

      $total = collect([$transportfee->transport_fee,$transportfee->other_fee,$transportfee->late_fee])->sum();

      $session =   $transportfee->asessions->name;
      $month   =   $transportfee->month->format('F'); 

      $pdf=PDF::loadView('student.fee.transport_fee.fee_receipt_transport_print',compact('transportfee','total','owner'));

      return $pdf->download($transportfee->students->name.'-transport-reciept-'. $session . '-' . $month . '.' .'pdf');             

    }
}
