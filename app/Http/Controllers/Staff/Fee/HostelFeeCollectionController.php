<?php

namespace App\Http\Controllers\Staff\Fee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use App\Student;
use App\Events\StudentHostelFeeReceived;
use App\HostelFee;
use App\HostelFeeCollection;
use App\Asession;
use PDF;

class HostelFeeCollectionController extends Controller
{
   public function __construct()
    {

         $this->middleware(['auth:teacher','active','staffs']);  
    }


     public function hostel_fee_get($reg_no = null , $uuid = null)
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
                           ->where('hostel',1)
                           ->with('courses','hostels','hostels.hostelfee')
                           ->first();
       
      $hostel_fee_completed = HostelFeeCollection::where('active',1)
                                                   ->where('student_id', $student->id)
                                                   ->where('completed',1)
                                                   ->where('asession_id',$activesessionid->id)
                                                   ->first(); 
    //return $hostel_fee_completed;
      $hostel_transactions = HostelFeeCollection::where('active',1)
                                                 ->where('student_id', $student->id)
                                                  ->latest()
                                                  ->take(12)
                                                  ->with('asessions')
                                                  ->get();                                            
      $hostelfees = HostelFee::where('asession_id',$activesessionid->id)
                                ->with('hostels')
                                ->orderBy('hostel_id')
                                ->get();         
       return view('staff.students.fee.pay_fee_hostel',compact('hostel_transactions','student','hostelfees','activesessionid','hostel_fee_completed'));
    }

     public function hostel_fee_post(Request $request,$reg_no = null , $uuid = null)
    { 
        $user = Auth::user();

        $student = Student::where('user_id',$user->owner->id)
                           ->where('uuid',$uuid)
                           ->where('reg_no', $reg_no)
                           ->where('hostel',1)
                           ->first();

      $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                        ->first(); 
            
                 
        $this->validate($request,[

            'hostel_fee'         => 'required|numeric',
            'completed'          => 'required|boolean',
            'remarks'            => 'nullable|string',
            'late_fee'           => 'nullable|numeric',
            'other_fee'          => 'nullable|numeric',
            'course'             => 'required',
            'hostel_type'        => 'required'

   	  	]);

         $total      = $request->hostel_fee + $request->late_fee + $request->other_fee;
         $number     = $student->emer_no;
         $regno      = $student->reg_no;
         $school     = $user->owner->schoolprofile->school_name;

           $reciept_no = HostelFeeCollection::where('active',1)
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
         
         'hostel_fee'         => $request->hostel_fee,
         'late_fee'           => $request->late_fee,
         'other_fee'          => $request->other_fee,
         'completed'          => $request->completed,
         'reciept_no'         => $reciept_nos += 1,
         'remarks'            => $request->remarks,
         'course_id'          => $student->course_id,
         'taker_id'           => $user->id,
         'hostel_id'          => $student->hostel_type_id,
         'asession_id'        => $activesessionid->id,
         'active'             => 1

        ];

          $student->hostelfeecollections()->create($data);

          event(new StudentHostelFeeReceived($total,$number,$regno,$school));

          flash()->success('Successfully fee submited');

          return back(); 

    }


    public function fee_detail_hostel($reg_no = null,$uuid = null)
    {
        $users = Auth::user();

        $user = Student::where('user_id',$users->owner->id)
                       ->where('reg_no', $reg_no)
                       ->where('uuid', $uuid)
                       ->where('hostel',1)
                       ->with('courses')
                       ->first();
        $hostelfees = HostelFeeCollection::where('active',1)
                                       ->where('student_id',$user->id)
                     ->with('courses','asessions')
                     ->paginate(10);
        return view('staff.students.fee.fee_detail_hostel',compact('user','hostelfees'));
    }

      public function fee_receipt_hostel_view($hostel = null , $created_at = null )
    {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_receipt_hostel = HostelFeeCollection::whereHas('asessions',function($q)use($owner){
                                      $q->where('user_id',$owner->id);
                                    })->where('id',$hostel)
                                      ->where('created_at',$created_at)
                                      ->with('students','courses','takers','asessions','hostels')
                                    ->first();
        $total = collect([$fee_receipt_hostel->hostel_fee , $fee_receipt_hostel->late_fee ,$fee_receipt_hostel->other_fee])->sum();
        return view('staff.fee_analysis.hostel.hostel_fee_receipt_view',compact('fee_receipt_hostel','total','owner'));
    }

        public function print_hostel_pdf($hostel_fee = null, $created_at = null)
   {
        $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_receipt_hostel = HostelFeeCollection::whereHas('asessions',function($q)use($owner){
                                      $q->where('user_id',$owner->id);
                                    })->where('id',$hostel_fee)
                                      ->where('created_at',$created_at)
                                      ->with('students','courses','takers','asessions','hostels')
                                    ->first();
        $total = collect([$fee_receipt_hostel->hostel_fee , $fee_receipt_hostel->late_fee ,$fee_receipt_hostel->other_fee])->sum();

        $session =   $fee_receipt_hostel->asessions->name;


      $pdf=PDF::loadView('staff.fee_analysis.hostel.hostel_reciept_print',compact('fee_receipt_hostel','total','owner'));

      return $pdf->stream($fee_receipt_hostel->students->name.'-hostel-reciept-'. $session . '.' .'pdf');
   }

      public function download_hostel_pdf($hostel_fee = null, $created_at = null)
   {
       $owner = Auth::user()->owner;

        $owner->load('schoolprofile');

        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_receipt_hostel = HostelFeeCollection::whereHas('asessions',function($q)use($owner){
                                      $q->where('user_id',$owner->id);
                                    })->where('id',$hostel_fee)
                                      ->where('created_at',$created_at)
                                      ->with('students','courses','takers','asessions','hostels')
                                    ->first();
        $total = collect([$fee_receipt_hostel->hostel_fee , $fee_receipt_hostel->late_fee ,$fee_receipt_hostel->other_fee])->sum();

        $session =   $fee_receipt_hostel->asessions->name;


      $pdf=PDF::loadView('staff.fee_analysis.hostel.hostel_reciept_print',compact('fee_receipt_hostel','total','owner'));

      return $pdf->download($fee_receipt_hostel->students->name.'-hostel-reciept-'. $session . '.' .'pdf');
   }


   public function delete_hostel_fee($hostel_fee = null , $created_at = null, $reg_no = null, $uuid = null)
   {
        $owner = Auth::user()->owner;

        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_hostel = HostelFeeCollection::whereHas('students',function($q) use($owner,$reg_no,$uuid){
                                      $q->where('user_id',$owner->id)
                                      ->where('reg_no',$reg_no)
                                      ->where('uuid',$uuid);
                                    })->where('id',$hostel_fee)
                                      ->where('created_at',$created_at)
                                    ->first();
         $data = [
            'active'        => 0,
            'deleted_at'    => Carbon::now(),
            'deleted_by_id' => Auth::id()
         ];

        $fee_hostel->update($data);

        flash()->success('Successfully Hostel Fee Deleted!');

        return back();
   }
}
