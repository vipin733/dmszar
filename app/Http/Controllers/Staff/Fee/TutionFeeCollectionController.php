<?php

namespace App\Http\Controllers\Staff\Fee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Student;
use App\Events\StudentTutionFeeReceived;
use App\TutionFeeCollection;
use App\TutionFee;
use App\Asession;
use PDF;
use Auth;


class TutionFeeCollectionController extends Controller
{
    public function __construct()
    {

         $this->middleware(['auth:teacher','active','staffs']);  
    }


     public function tution_fee_get($reg_no = null , $uuid = null)
    { 

        $userId = Auth::user()->owner->id;
       

        $activesessionid = Asession::where('user_id',$userId)
                                        ->where('active',1)
                                        ->select('id','name')
                                        ->first(); 
           if (!$activesessionid) {
                      
              flash()->warning('No session Active, please active current session first!');

             // return redirect()->to('');
              return redirect('/acadmic/asessions/create');

          }                              

        $student = Student::where('user_id',$userId)
                           ->where('uuid',$uuid)
                           ->where('reg_no', $reg_no)
                           ->with(['courses.tutionfee' => function($q) use($activesessionid){
                              $q->where('asession_id',$activesessionid->id);
                           }])->with('courses','courses.tutionfee')
                           ->first();

    $tutions_transactions = TutionFeeCollection::where('active',1)
                                       ->whereHas('students',function($q) use($uuid,$reg_no){
                                              $q->where('reg_no',$reg_no)
                                              ->where('uuid',$uuid);
                                            })->with('asessions')
                                            ->latest()
                                            ->take(12)
                                            ->get();      

    $tution_fee_completed = TutionFeeCollection::where('active',1)
                                                   ->where('student_id', $student->id)
                                                   ->where('completed',1)
                                                   ->where('asession_id',$activesessionid->id)
                                                   ->first();                                                     

    $tutionfees = TutionFee::where('asession_id',$activesessionid->id)
                                ->with('courses')
                                ->orderBy('course_id')
                                ->get();
       // return $tutions_transactions;
        
        return view('staff.students.fee.pay_fee_tution',compact('student','tutions_transactions','tutionfees','activesessionid','tution_fee_completed'));
    }

     public function tution_fee_post(Request $request,$reg_no = null , $uuid = null)
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

            'tution_fee'      => 'required|numeric',
            'month'           => 'required',
            'other_fee'       => 'nullable|numeric',
            'remarks'         => 'nullable|string',
            'late_fee'        => 'nullable|numeric',
            'course'          => 'required',
            'completed'       => 'required|boolean'

   	  	]);

         $total      = $request->tution_fee + $request->other_fee +  $request->late_fee;
         $number     = $student->emer_no;
         $regno      = $student->reg_no;
         $school     = $user->owner->schoolprofile->school_name;

         $reciept_no = TutionFeeCollection::where('active',1)
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
         
         'tution_fee'      => $request->tution_fee,
         'month'           => $request->month,
         'reciept_no'      => $reciept_nos += 1,
         'remarks'         => $request->remarks,
         'other_fee'       => $request->other_fee,
         'late_fee'        => $request->late_fee,
         'course_id'       => $student->course_id,
         'taker_id'        => $user->id,
         'asession_id'     => $activesessionid->id,
         'active'          => 1,
         'completed'       => $request->completed

        ];

          $student->tutionfeecollections()->create($data);

          event(new StudentTutionFeeReceived($total,$number,$regno,$school));

          flash()->success('Successfully fee submited'); 
          return back(); 

    }


    public function fee_detail_tution($reg_no = null,$uuid = null)
    {
        $userId = Auth::user()->owner->id;

        $user = Student::where('user_id', $userId)
                       ->where('reg_no', $reg_no)
                       ->where('uuid', $uuid)
                       ->with('courses')
                       ->first();
      $tutionfees = TutionFeeCollection::where('active',1)
                                       ->where('student_id',$user->id)
                     ->with('courses','asessions')
                     ->paginate(10);
        return view('staff.students.fee.fee_detail_tution',compact('user','tutionfees'));
    }

     public function fee_receipt_tution_view($tution = null , $created_at = null)
    {
        $owner = Auth::user()->owner;
        $owner->load('schoolprofile');

        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_receipt_tution = TutionFeeCollection::whereHas('asessions',function($q) use($owner){
                                      $q->where('user_id',$owner->id);
                                    })->where('id',$tution)
                                      ->where('created_at',$created_at)
                                      ->with('students','courses','takers','asessions')
                                    ->first();
         $total = collect([$fee_receipt_tution->tution_fee,$fee_receipt_tution->late_fee,$fee_receipt_tution->other_fee])->sum();
  
         //return $owner;
        return view('staff.fee_analysis.tution.tution_fee_receipt_view',compact('fee_receipt_tution','total','owner'));
    }

      public function print_tution_pdf($tution_fee = null, $created_at = null)
   {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_receipt_tution = TutionFeeCollection::whereHas('asessions',function($q) use($owner){
                                      $q->where('user_id',$owner->id);
                                    })->where('id',$tution_fee)
                                      ->where('created_at',$created_at)
                                      ->with('students','courses','takers','asessions')
                                    ->first();

        $session =   $fee_receipt_tution->asessions->name;
        $month   =   $fee_receipt_tution->month->format('F');

         $total = collect([$fee_receipt_tution->tution_fee,$fee_receipt_tution->late_fee,$fee_receipt_tution->other_fee])->sum();

      $pdf=PDF::loadView('staff.fee_analysis.tution.tution_reciept_print',compact('fee_receipt_tution','total','owner'));

      return $pdf->stream($fee_receipt_tution->students->name.'-tuiton-reciept-'. $session . '-' . $month . '.' .'pdf');
   }

      public function download_tution_pdf($tution_fee = null, $created_at = null)
   {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_receipt_tution = TutionFeeCollection::whereHas('asessions',function($q) use($owner){
                                      $q->where('user_id',$owner->id);
                                    })->where('id',$tution_fee)
                                      ->where('created_at',$created_at)
                                      ->with('students','courses','takers','asessions')
                                    ->first();
        
        $session =   $fee_receipt_tution->asessions->name;
        $month   =   $fee_receipt_tution->month->format('F');
      $total = collect([$fee_receipt_tution->tution_fee,$fee_receipt_tution->late_fee,$fee_receipt_tution->other_fee])->sum();

      $pdf=PDF::loadView('staff.fee_analysis.tution.tution_reciept_print',compact('fee_receipt_tution','total','owner'));

      return $pdf->download($fee_receipt_tution->students->name.'-tution-reciept-'. $session . '-' . $month . '.' .'pdf');
   }


   public function delete_tution_fee($tution_fee = null , $created_at = null, $reg_no = null, $uuid = null)
   {
        $owner = Auth::user()->owner;

        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_tution = TutionFeeCollection::whereHas('students',function($q) use($owner,$reg_no,$uuid){
                                      $q->where('user_id',$owner->id)
                                      ->where('reg_no',$reg_no)
                                      ->where('uuid',$uuid);
                                    })->where('id',$tution_fee)
                                      ->where('created_at',$created_at)
                                    ->first();
         $data = [
            'active'        => 0,
            'deleted_at'    => Carbon::now(),
            'deleted_by_id' => Auth::id()
         ];

        $fee_tution->update($data);

        flash()->success('Successfully Tution Fee Deleted!');

        return back();
   }
}
