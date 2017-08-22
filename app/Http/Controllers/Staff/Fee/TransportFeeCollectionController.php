<?php

namespace App\Http\Controllers\Staff\Fee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Student;
use App\Events\StudentTransportFeeReceived;
use App\Asession;
use App\TransportFeeCollection;
use App\TransportFee;
use Auth;
use PDF;


class TransportFeeCollectionController extends Controller
{
   public function __construct()
    {

         $this->middleware(['auth:teacher','active','staffs']);  
    }


     public function transport_fee_get($reg_no = null , $uuid = null)
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
                           ->where('transportation',1)
                           ->with('courses','stopages','stopages.transportFee')
                           ->first();

       $transport_transactions = TransportFeeCollection::where('active',1)
                                       ->whereHas('students',function($q) use($uuid,$reg_no){
                                              $q->where('reg_no',$reg_no)
                                              ->where('uuid',$uuid);
                                            })->with('asessions')
                                            ->latest()
                                            ->take(12)
                                            ->get();  

       $transport_fee_completed = TransportFeeCollection::where('active',1)
                                                   ->where('student_id', $student->id)
                                                   ->where('completed',1)
                                                   ->where('asession_id',$activesessionid->id)
                                                   ->first();                                       

       $transportfees = TransportFee::where('asession_id',$activesessionid->id)
                                ->with('stopages')
                                ->orderBy('stopage_id')
                                ->get();

       return view('staff.students.fee.pay_fee_transport',compact('student','transport_transactions','transportfees','activesessionid','transport_fee_completed'));
    }

     public function transport_fee_post(Request $request,$reg_no = null , $uuid = null)
    { 
        $user = Auth::user();

        $student = Student::where('user_id',$user->owner->id)
                           ->where('uuid',$uuid)
                           ->where('reg_no', $reg_no)
                           ->where('transportation',1)
                           ->first();


        $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                        ->first(); 
            
                 
        $this->validate($request,[

            'transport_fee'      => 'required|numeric',
            'month'              => 'required',
            'remarks'            => 'nullable|string',
            'late_fee'           => 'nullable|numeric',
            'other_fee'          => 'nullable|numeric',
            'course'             => 'required',
            'stopage'            => 'required',
            'completed'          => 'required|boolean'

   	  	]);

         $total       = $request->transport_fee + $request->late_fee + $request->other_fee;
         $number      = $student->emer_no;
         $regno       = $student->reg_no;
         $school      = $user->owner->schoolprofile->school_name;

           $reciept_no = TransportFeeCollection::where('active',1)
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
         
         'transport_fee'      => $request->transport_fee,
         'late_fee'           => $request->late_fee,
         'other_fee'          => $request->other_fee,
         'month'              => $request->month,
         'reciept_no'         => $reciept_nos += 1,
         'remarks'            => $request->remarks,
         'course_id'          => $student->course_id,
         'taker_id'           => $user->id,
         'stopage_id'         => $student->stopage_id,
         'asession_id'        => $activesessionid->id,
         'active'             => 1,
         'completed'          => $request->completed

        ];

          $student->transportfeecollections()->create($data);

          event(new StudentTransportFeeReceived($total,$number,$regno,$school));

          flash()->success('Successfully fee submited'); 
          
          return back(); 

    }


    public function fee_detail_transport($reg_no = null,$uuid = null)
    {
        $users = Auth::user();

        $user = Student::where('user_id',$users->owner->id)
                       ->where('reg_no', $reg_no)
                       ->where('uuid', $uuid)
                       ->where('transportation',1)
                       ->with('courses')
                       ->first();
      $transportfees = TransportFeeCollection::where('active',1)
                                       ->where('student_id',$user->id)
                     ->with('courses','asessions')
                     ->paginate(10);
        return view('staff.students.fee.fee_detail_transport',compact('user','transportfees'));
    }

     public function fee_receipt_transport_view($transport = null , $created_at = null )
    {
        $owner = Auth::user()->owner;
        $owner->load('schoolprofile');
        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_receipt_transport = TransportFeeCollection::whereHas('asessions',function($q)use($owner){
                                      $q->where('user_id',$owner->id);
                                    })->where('id',$transport)
                                      ->where('created_at',$created_at)
                                      ->with('students','courses','takers','asessions','stopages')
                                      ->first();
        $total = collect([$fee_receipt_transport->transport_fee,$fee_receipt_transport->late_fee, $fee_receipt_transport->other_fee])->sum();
        return view('staff.fee_analysis.transport.transport_fee_receipt_view',compact('fee_receipt_transport','total','owner'));
    }

       public function print_transport_pdf($transport_fee = null, $created_at = null)
   {
       $owner = Auth::user()->owner;
        $owner->load('schoolprofile');
        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_receipt_transport = TransportFeeCollection::whereHas('asessions',function($q)use($owner){
                                      $q->where('user_id',$owner->id);
                                    })->where('id',$transport_fee)
                                      ->where('created_at',$created_at)
                                      ->with('students','courses','takers','asessions','stopages')
                                      ->first();
        $total = collect([$fee_receipt_transport->transport_fee,$fee_receipt_transport->late_fee, $fee_receipt_transport->other_fee])->sum();

        $session =   $fee_receipt_transport->asessions->name;
        $month   =   $fee_receipt_transport->month->format('F');


      $pdf=PDF::loadView('staff.fee_analysis.transport.transport_reciept_print',compact('fee_receipt_transport','total','owner'));

      return $pdf->stream($fee_receipt_transport->students->name.'-transport-reciept-'. $session . '-' . $month . '.' .'pdf');
   }

      public function download_transport_pdf($transport_fee = null, $created_at = null)
   {
         $owner = Auth::user()->owner;
        $owner->load('schoolprofile');
        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_receipt_transport = TransportFeeCollection::whereHas('asessions',function($q)use($owner){
                                      $q->where('user_id',$owner->id);
                                    })->where('id',$transport_fee)
                                      ->where('created_at',$created_at)
                                      ->with('students','courses','takers','asessions','stopages')
                                      ->first();
        $total = collect([$fee_receipt_transport->transport_fee,$fee_receipt_transport->late_fee, $fee_receipt_transport->other_fee])->sum();

        $session =   $fee_receipt_transport->asessions->name;
        $month   =   $fee_receipt_transport->month->format('F');


      $pdf=PDF::loadView('staff.fee_analysis.transport.transport_reciept_print',compact('fee_receipt_transport','total','owner'));

      return $pdf->download($fee_receipt_transport->students->name.'-transport-reciept-'. $session . '-' . $month . '.' .'pdf');
   }


   public function delete_transport_fee($transport_fee = null , $created_at = null, $reg_no = null, $uuid = null)
   {
        $owner = Auth::user()->owner;

        $created_at = Carbon::createFromTimeStamp($created_at);

        $fee_transport = TransportFeeCollection::whereHas('students',function($q) use($owner,$reg_no,$uuid){
                                      $q->where('user_id',$owner->id)
                                      ->where('reg_no',$reg_no)
                                      ->where('uuid',$uuid);
                                    })->where('id',$transport_fee)
                                      ->where('created_at',$created_at)
                                    ->first();
         $data = [
            'active'        => 0,
            'deleted_at'    => Carbon::now(),
            'deleted_by_id' => Auth::id()
         ];

        $fee_transport->update($data);

        flash()->success('Successfully Transport Fee Deleted!');

        return back();
   }
}
