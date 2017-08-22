<?php

namespace App\Http\Controllers\Staff\Fee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\StudentRegistraionFeeReceived;
use App\Model\Staff\Fee\RegistraionFeeCollection;
use App\Model\Staff\Fee\RegistraionFee;
use Carbon\Carbon;
use App\Asession;
use App\Student;
use Auth;
use PDF;

class RegistraionFeeCollectionController extends Controller
{
    public function __construct()
    {

         $this->middleware(['auth:teacher','active','staffs']);  
    }


     public function registraion_fee_get($reg_no = null , $uuid = null)
    { 

        $userId = Auth::user()->owner->id;
       

        $activesessionid = Asession::where('user_id',$userId)->where('active',1)->select('id','name')->first(); 
          if (!$activesessionid) {
                      
              flash()->warning('No session Active, please active current session first!');

             // return redirect()->to('');
              return redirect('/acadmic/asessions/create');

          }                                                              

        $student = Student::where('user_id',$userId)->where('uuid',$uuid)->where('reg_no', $reg_no)
                            ->with(['courses.registraionfee' => function($q) use($activesessionid){
                              $q->where('asession_id',$activesessionid->id);
                           }])->with('courses','courses.registraionfee')->first();

       $registraion_transactions = RegistraionFeeCollection::where('active',1)
                                       ->whereHas('students',function($q) use($uuid,$reg_no){
                                              $q->where('reg_no',$reg_no)
                                              ->where('uuid',$uuid);
                                            })->with('asessions')->latest()->get();   

     $registraion_fee_completed = RegistraionFeeCollection::where('active',1)
                                                   ->where('student_id', $student->id)
                                                   ->where('completed',1)
                                                   ->where('asession_id',$activesessionid->id)->first();                                                 
    $registraionfees = RegistraionFee::where('asession_id',$activesessionid->id)->with('courses')->orderBy('course_id')->get();
       // return $tutions_transactions;
        
        return view('staff.students.fee.registraion.pay_fee_registraion',compact('student','registraion_transactions','registraionfees','activesessionid','registraion_fee_completed'));
    }

     public function registraion_fee_post(Request $request,$reg_no = null , $uuid = null)
    {

        $user= Auth::user();

        $student = Student::where('user_id',$user->owner->id)
                           ->where('uuid',$uuid)
                           ->where('reg_no', $reg_no)
                           ->first();

        $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                        ->first(); 
                           
        $this->validate($request,[

            'registraion_fee' => 'required|numeric',
            'late_fee'        => 'nullable|numeric',
            'fee_details'     => 'required',
            'remarks'         => 'nullable',
            'course'          => 'required',
            'completed'       => 'required|boolean'

   	  	]);

         $total       = $request->registraion_fee +  $request->late_fee;
         $number      = $student->emer_no;
         $regno       = $student->reg_no;
         $school      = $user->owner->schoolprofile->school_name;

         $reciept_no = RegistraionFeeCollection::where('active',1)
                                              ->where('asession_id',$activesessionid->id)
                                              ->whereHas('students',function($q) use($user){
                                            $q->where('user_id',$user->owner->id);
                                             })->orderBy('reciept_no','desc')
                                            ->select('reciept_no')
                                            ->first(); 
        if ($reciept_no) {
          $reciept_nos=$reciept_no->reciept_no;
        }else{
            $reciept_nos = 0;
        }

        $data= [
         
         'registraion_fee'      => $request->registraion_fee,
         'late_fee'             => $request->late_fee,
         'fee_details'          => $request->fee_details,
         'remarks'              => $request->remarks,
         'reciept_no'           => $reciept_nos += 1,
         'course_id'            => $student->course_id,
         'taker_id'             => $user->id,
         'asession_id'          => $activesessionid->id,
         'active'               => 1,
         'completed'            => $request->completed

        ];

          $student->registraionfeecollections()->create($data);

          event(new StudentRegistraionFeeReceived($total,$number,$regno,$school));

          flash()->success('Successfully fee submited'); 
          return back(); 

    }


    public function fee_detail_registraion($reg_no = null,$uuid = null)
    {
        $userId = Auth::user()->owner->id;

        $user = Student::where('user_id', $userId)
                       ->where('reg_no', $reg_no)
                       ->where('uuid', $uuid)
                       ->with('courses')
                       ->first();
      $registraionfees = RegistraionFeeCollection::where('active',1)
                                       ->where('student_id',$user->id)
                     ->with('courses','asessions')
                     ->paginate(10);
        return view('staff.students.fee.registraion.fee_detail_registraion',compact('user','registraionfees'));
    }

    
     public function fee_receipt_registraion_view($registraion = null , $created_at = null )
    {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_receipt_registraion = RegistraionFeeCollection::whereHas('asessions',function($q)use($owner){
                                      $q->where('user_id',$owner->id);
                                    })->where('id',$registraion)
                                      ->where('created_at',$created_at)
                                      ->with('students','courses','takers','asessions')
                                    ->first();
        $total = collect([$fee_receipt_registraion->registraion_fee , $fee_receipt_registraion->late_fee ])->sum();
        return view('staff.fee_analysis.registraion.registraion_fee_receipt_view',compact('fee_receipt_registraion','total','owner'));
    }


        public function print_registration_pdf($registration_fee = null, $created_at = null)
   {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_receipt_registraion = RegistraionFeeCollection::whereHas('asessions',function($q)use($owner){
                                      $q->where('user_id',$owner->id);
                                    })->where('id',$registration_fee)
                                      ->where('created_at',$created_at)
                                      ->with('students','courses','takers','asessions')
                                    ->first();
        $total = collect([$fee_receipt_registraion->registraion_fee , $fee_receipt_registraion->late_fee ])->sum();

        $session =   $fee_receipt_registraion->asessions->name;


      $pdf=PDF::loadView('staff.fee_analysis.registraion.registraion_reciept_print',compact('fee_receipt_registraion','total','owner'));

      return $pdf->stream($fee_receipt_registraion->students->name.'-registration-reciept-'. $session .'.' .'pdf');
   }

      public function download_registration_pdf($registration_fee = null, $created_at = null)
   {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_receipt_registraion = RegistraionFeeCollection::whereHas('asessions',function($q)use($owner){
                                      $q->where('user_id',$owner->id);
                                    })->where('id',$registration_fee)
                                      ->where('created_at',$created_at)
                                      ->with('students','courses','takers','asessions')
                                    ->first();
        $total = collect([$fee_receipt_registraion->registraion_fee , $fee_receipt_registraion->late_fee ])->sum();

        $session =   $fee_receipt_registraion->asessions->name;


      $pdf=PDF::loadView('staff.fee_analysis.registraion.registraion_reciept_print',compact('fee_receipt_registraion','total','owner'));

      return $pdf->download($fee_receipt_registraion->students->name.'-registration-reciept-'. $session .'.' .'pdf');
   }


   public function delete_registration_fee($registration_fee = null , $created_at = null, $reg_no = null, $uuid = null)
   {
        $owner = Auth::user()->owner;

        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_registration = RegistraionFeeCollection::whereHas('students',function($q) use($owner,$reg_no,$uuid){
                                      $q->where('user_id',$owner->id)
                                      ->where('reg_no',$reg_no)
                                      ->where('uuid',$uuid);
                                    })->where('id',$registration_fee)
                                      ->where('created_at',$created_at)
                                    ->first();
         $data = [
            'active'        => 0,
            'deleted_at'    => Carbon::now(),
            'deleted_by_id' => Auth::id()
         ];

        $fee_registration->update($data);

        flash()->success('Successfully Registraion Fee Deleted!');

        return back();
   }
}
