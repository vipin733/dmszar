<?php

namespace App\Http\Controllers\Staff\Records;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Staff\Fee\RegistraionFeeCollection;
use App\TransportFeeCollection;
use App\TutionFeeCollection;
use App\HostelFeeCollection;
use App\Asession;
use App\Student;
use Auth;
use DB;

class SchoolCureentRecordsController extends Controller
{
     public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }

    public function records()
    {
    	$user = Auth::user()->owner;
    	$user->load('schoolprofile','students','teachers');

        $activesessionid = Asession::where('user_id',$user->id)->where('active',1)->select('id')->first();

        if ($activesessionid) {
               $activesessionID  = $activesessionid->id;      
         } else{
               
               $activesessionID  = 100000000000000000;
         } 

        $tution_fees= TutionFeeCollection::where('asession_id',$activesessionID)->where('active',1)
                                      ->selectRaw('sum(`tution_fee`) as tution_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')
                                      ->first();

        $total_tution_fee = $tution_fees->tution_fee +  $tution_fees->late_fee +  $tution_fees->other_fee;

        $registration_fees= RegistraionFeeCollection::where('asession_id',$activesessionID)->where('active',1)
                                     ->selectRaw('sum(`registraion_fee`) as registraion_fee, sum(`late_fee`) as late_fee')->first();

        $total_registration_fee = $registration_fees->registraion_fee +  $registration_fees->late_fee ;

        $transport_fees= TransportFeeCollection::where('asession_id',$activesessionID)->where('active',1)
                                               ->selectRaw('sum(`transport_fee`) as transport_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')->first();
        $total_transport_fee = $transport_fees->transport_fee +  $transport_fees->late_fee +  $transport_fees->other_fee;

        $hostel_fees= HostelFeeCollection::where('asession_id',$activesessionID)->where('active',1)
                                         ->selectRaw('sum(`hostel_fee`) as hostel_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')->first();

        $total_hostel_fee = $hostel_fees->hostel_fee +  $hostel_fees->late_fee +  $hostel_fees->other_fee;

    	$students = Student::where('user_id',$user->id)
    	                    ->select(DB::raw('count(*) as studentcount, course_id'))
    	                    ->groupBy('course_id')
    	                    ->orderBy('course_id')
    	                    ->with('courses')
    	                    ->get();

    	$totalactivestudent    = $user->students()->where('active',1)->count();
    	$totalstudent          = $user->students()->count();
    	$totalstudenttransport = $user->students()->where('active',1)->where('transportation',1)->count();
        $totalstudenthostel    = $user->students()->where('active',1)->where('hostel',1)->count();

        $totalteacher          = $user->teachers()->where('type',0)->count();
        $totalactiveteacher    = $user->teachers()->where('type',0)->where('active',1)->count();
    	$totalstaff            = $user->teachers()->where('type',1)->count();
        $totalactivestaff      = $user->teachers()->where('type',1)->where('active',1)->count();                                                           
    	return view('staff.records.view_records',compact('user','students','totalactivestudent','totalstudent','totalstudenttransport','totalstudenthostel','total_tution_fee','total_transport_fee','total_hostel_fee','total_registration_fee','totalteacher','totalactiveteacher','totalstaff','totalactivestaff'));

    }
}
