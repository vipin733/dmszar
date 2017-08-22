<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeeConfirmation;
use Carbon\Carbon;
use Auth;


class StaffFeeConfirmationCController extends Controller
{
	   public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }

     public function confirmation_request()
    { 
         $feeconfirmations = FeeConfirmation::whereHas('asessions',function($q){
                                              $q->where('user_id',Auth::user()->owner->id);
                                          })->with('courses','students','banknames','appnames')
                                          ->latest()
                                          ->paginate(10);
        
        return view('staff.fee_request.confirmation.confirmation_request',compact('feeconfirmations'));
    }

     public function confirmation_request_view($ticket_no=null, $feeconfirmation=null,$created_at=null)
    { 
    	  $created_at=Carbon::createFromTimeStamp($created_at);
        $feeconfirmation = FeeConfirmation::whereHas('asessions',function($q){
                                              $q->where('user_id',Auth::user()->owner->id);
                                          })->where('ticket_no',$ticket_no)
                                            ->where('id',$feeconfirmation)
                                            ->where('created_at',$created_at)
                                             ->with('courses','students','action_taken_by','banknames','appnames')
                                             ->first();
        
        return view('staff.fee_request.confirmation.confirmation_request_view',compact('feeconfirmation'));
    }

      public function confirmation_request_save(Request $request, $ticket_no=null, $feeconfirmation=null,$created_at=null)
    { 
       

    	 $this->validate($request,[
            'status'            =>      'required|boolean'
        ]);

    	$created_at=Carbon::createFromTimeStamp($created_at);
        $feeconfirmation = FeeConfirmation::whereHas('asessions',function($q){
                                              $q->where('user_id',Auth::user()->owner->id);
                                          })->where('ticket_no',$ticket_no)
                                            ->where('id',$feeconfirmation)
                                            ->where('created_at',$created_at)
                                             ->first();
         $data = [
           'status'      => $request->status,
           'taken_by_id' => Auth::id(),
           'reply'       => $request->reply
         ];

         $feeconfirmation->update($data);

         flash()->success('Successfully Form Submited'); 

            return back();                                    
        
       
    }
}
