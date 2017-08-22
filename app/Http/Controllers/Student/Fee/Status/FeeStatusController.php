<?php

namespace App\Http\Controllers\Student\Fee\Status;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Staff\Fee\RegistraionFeeCollection;
use App\Model\Staff\Fee\RegistraionFee;
use App\TransportFeeCollection;
use App\TutionFeeCollection;
use App\HostelFeeCollection;
use App\TransportFee;
use App\HostelFee;
use App\TutionFee;
use App\Asession;
use Auth;

class FeeStatusController extends Controller
{
     public function __construct()
    {
     
        $this->middleware(['auth:student','active']);
            
    }


     public function fee_status()
    {   
        $user = Auth::user();

        $user->load('courses','hostels','stopages');

        $activesessionid = Asession::where('user_id',$user->owner->id)->where('active',1)->select('id','name')->first(); 

        if (!$activesessionid) {
                      
            flash()->warning('No session Active, please contact your administrative!');
            return back();

        } 

        $activesessionID  = $activesessionid->id;       
        $registraionfee   = RegistraionFee::where('asession_id',$activesessionID)->where('course_id',$user->course_id)->first();

        $registration_fee = RegistraionFeeCollection::where('asession_id',$activesessionID)
                                          ->where('student_id',$user->id)
                                          ->where('course_id',$user->course_id)->where('active',1)
                                          ->selectRaw('sum(`registraion_fee`) as registraion_fee, sum(`late_fee`) as late_fee')->first();
       if ($registration_fee) {                              
           $totalpaidRfee    = $registration_fee->registraion_fee + $registration_fee->late_fee;
        }else{
          $totalpaidRfee = 0;	
        }



        $tutionfee = TutionFee::where('asession_id',$activesessionID)
                                         ->where('course_id',$user->course_id)->first(); 
        $tution_fee= TutionFeeCollection::where('asession_id',$activesessionID)
                                          ->where('student_id',$user->id)
                                          ->where('course_id',$user->course_id)->where('active',1)
                                          ->selectRaw('sum(`tution_fee`) as tution_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')->first();
        if ($tution_fee) {                              
           $totalpaidTUfee    = $tution_fee->tution_fee + $tution_fee->late_fee + $tution_fee->other_fee;
        }else{
          $totalpaidTUfee = 0;	
        }  



        $transportfee = TransportFee::where('asession_id',$activesessionID)
                                         ->where('stopage_id',$user->stopage_id)->first(); 
        $transport_fee= TransportFeeCollection::where('asession_id',$activesessionID)
                                          ->where('student_id',$user->id)
                                          ->where('stopage_id',$user->stopage_id)->where('active',1)
                                          ->selectRaw('sum(`transport_fee`) as transport_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')->first();
         if ($transport_fee) {                              
           $totalpaidTTfee    = $transport_fee->transport_fee + $transport_fee->late_fee + $transport_fee->other_fee;
        }else{
          $totalpaidTTfee = 0;	
        }                                    


        $hostelfee = HostelFee::where('asession_id',$activesessionID)->where('hostel_id',$user->hostel_type_id)->first(); 
        $hostel_fee= HostelFeeCollection::where('asession_id',$activesessionID)
                                          ->where('student_id',$user->id)
                                          ->where('hostel_id',$user->hostel_type_id)->where('active',1)
                                          ->selectRaw('sum(`hostel_fee`) as hostel_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')->first();
         if ($hostel_fee) {                              
           $totalpaidHfee    = $hostel_fee->hostel_fee + $hostel_fee->late_fee + $hostel_fee->other_fee;
        }else{
          $totalpaidHfee = 0;	
        }                                                                            

        return view('student.fee.status.fee_status',compact('user','registraionfee','registration_fee','totalpaidRfee','tutionfee','tution_fee','totalpaidTUfee','transportfee','transport_fee','totalpaidTTfee','hostelfee','hostel_fee','totalpaidHfee','activesessionid'));
    }
}
