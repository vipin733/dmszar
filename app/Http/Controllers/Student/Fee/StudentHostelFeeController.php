<?php

namespace App\Http\Controllers\Student\Fee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\HostelFeeCollection;
use App\Asession;
use Carbon\Carbon;
use Auth;
use PDF;

class StudentHostelFeeController extends Controller
{
   
     public function __construct()
    {
     
        $this->middleware(['auth:student','active']);
        $this->middleware('hosteltaken')->only('hostel_fee_detail','hostel_fee_receipt');
            
    }

  

    public function hostel_fee_detail()
    {
        
        $hostelfees = HostelFeeCollection::where('student_id',Auth::id())
                     ->where('active',1)
                     ->with('courses','asessions')
                     ->get();

        return view('student.fee.hostel_fee.hostel_fee_detail',compact('hostelfees','sessionid'));
    }

    public function hostel_fee_receipt($hostelfee = null, $created_at = null)
    {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $tdate=Carbon::createFromTimeStamp($created_at);

        $hostelfee = HostelFeeCollection::where('student_id',Auth::id())
                     ->where('id',$hostelfee)
                     ->where('created_at',$tdate)
                     ->where('active',1)
                     ->with('courses','students','asessions','takers','hostels')->first();
        $total = collect([$hostelfee->hostel_fee , $hostelfee->late_fee ,$hostelfee->other_fee])->sum();

        return view('student.fee.hostel_fee.hostel_fee_receipt_view',compact('hostelfee','owner','total'));
    }


     public function hostel_fee_receipt_print($hostelfee = null, $created_at = null)
    {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $tdate=Carbon::createFromTimeStamp($created_at);

        $hostelfee = HostelFeeCollection::where('student_id',Auth::id())
                     ->where('id',$hostelfee)
                     ->where('created_at',$tdate)
                     ->where('active',1)
                     ->with('courses','students','asessions','takers','hostels')->first();
        $total = collect([$hostelfee->hostel_fee , $hostelfee->late_fee ,$hostelfee->other_fee])->sum();

       $session =   $hostelfee->asessions->name;

      $pdf=PDF::loadView('student.fee.hostel_fee.hostel_fee_receipt_print',compact('hostelfee','total','owner'));

         return $pdf->stream($hostelfee->students->name.'-hostel-reciept-'. $session . '.' .'pdf');              

    }

     public function hostel_fee_receipt_download($hostelfee = null, $created_at = null)
    {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $tdate=Carbon::createFromTimeStamp($created_at);

          $hostelfee = HostelFeeCollection::where('student_id',Auth::id())
                     ->where('id',$hostelfee)
                     ->where('created_at',$tdate)
                     ->where('active',1)
                     ->with('courses','students','asessions','takers','hostels')->first();
        $total = collect([$hostelfee->hostel_fee , $hostelfee->late_fee ,$hostelfee->other_fee])->sum();

       $session =   $hostelfee->asessions->name;

      $pdf=PDF::loadView('student.fee.hostel_fee.hostel_fee_receipt_print',compact('hostelfee','total','owner'));

      return $pdf->download($hostelfee->students->name.'-hostel-reciept-'. $session . '.' .'pdf');              

    }

}
