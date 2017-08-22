<?php

namespace App\Http\Controllers\Student\Fee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Staff\Fee\RegistraionFeeCollection;
use App\Asession;
use Carbon\Carbon;
use Auth;
use PDF;

class StudentRegistrationFeeController extends Controller
{
	  public function __construct()
    {
     
        $this->middleware(['auth:student','active']);
            
    }
  
    public function registraion_fee_detail()
    {

        $registraionfees = RegistraionFeeCollection::where('student_id',Auth::id())
                                                  ->where('active',1)
                                                  ->with('courses','asessions')
                                                  ->get();
             // return $registraionfees;
        return view('student.fee.registraion_fee.registraion_fee_detail',compact('registraionfees'));
    }

    public function registraion_fee_receipt($registraionfee = null, $created_at = null)
    {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $tdate=Carbon::createFromTimeStamp($created_at);

        $registraionfee = RegistraionFeeCollection::where('student_id',Auth::id())
                     ->where('id',$registraionfee)
                     ->where('created_at',$tdate)
                     ->where('active',1)
                     ->with('courses','students','asessions')->first();

        return view('student.fee.registraion_fee.registraion_fee_receipt_view',compact('registraionfee','owner'));
    }

     public function registraion_fee_receipt_print($registraionfee = null, $created_at = null)
    {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $tdate=Carbon::createFromTimeStamp($created_at);

        $registraionfee = RegistraionFeeCollection::where('student_id',Auth::id())
                     ->where('id',$registraionfee)
                     ->where('created_at',$tdate)
                     ->where('active',1)
                     ->with('courses','students','asessions')->first();

      $total = collect([$registraionfee->registraion_fee,$registraionfee->late_fee])->sum();

       $session =   $registraionfee->asessions->name;

      $pdf=PDF::loadView('student.fee.registraion_fee.registraion_fee_receipt_print',compact('registraionfee','total','owner'));

         return $pdf->stream($registraionfee->students->name.'-registraion-reciept-'. $session . '.' .'pdf');              

    }

     public function registraion_fee_receipt_download($registraionfee = null, $created_at = null)
    {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $tdate=Carbon::createFromTimeStamp($created_at);

        $registraionfee = RegistraionFeeCollection::where('student_id',Auth::id())
                     ->where('id',$registraionfee)
                     ->where('created_at',$tdate)
                     ->where('active',1)
                     ->with('courses','students','asessions')->first();

      $total = collect([$registraionfee->registraion_fee,$registraionfee->late_fee])->sum();

       $session =   $registraionfee->asessions->name;

      $pdf=PDF::loadView('student.fee.registraion_fee.registraion_fee_receipt_print',compact('registraionfee','total','owner'));

      return $pdf->download($registraionfee->students->name.'-registraion-reciept-'. $session . '.' .'pdf');              

    }

    
}
