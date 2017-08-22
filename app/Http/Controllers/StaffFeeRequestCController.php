<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeeRequest;
use Carbon\Carbon;
use Auth;

class StaffFeeRequestCController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }


    public function fee_extension_refund_request()
    { 
        $feerequests = FeeRequest::whereHas('asessions',function($q){
                                     $q->where('user_id',Auth::user()->owner->id);
                                    })->with('students','feerequestcategories')
                                     ->latest()
                                     ->paginate(10);
        
        return view('staff.fee_request.fee.fee_extension_refund_requests',compact('feerequests'));
    }

    public function fee_extensions_refund_request_view($ticket_no=null,$feerequest = null, $created_at= null)
    { 
         $created_at=Carbon::createFromTimeStamp($created_at);
         $feerequest = FeeRequest::whereHas('asessions',function($q){
                                      $q->where('user_id',Auth::user()->owner->id);
                                    })->where('ticket_no',$ticket_no)
                                     ->where('id',$feerequest)
                                     ->where('created_at',$created_at)
                                  ->with('action_taken_by','feerequestcategories','students')
                                  ->first();
        
        return view('staff.fee_request.fee.fee_extension_refund_request_view',compact('feerequest'));
    }

    public function fee_extensions_refund_request_save(Request $request, $ticket_no=null,$feerequest = null, $created_at= null)
    { 
    	$this->validate($request,[
            'status'        =>      'required|integer'
        ]);

         $created_at=Carbon::createFromTimeStamp($created_at);
         $feerequest = FeeRequest::whereHas('asessions',function($q){
                                      $q->where('user_id',Auth::user()->owner->id);
                                    })->where('ticket_no',$ticket_no)
                                     ->where('id',$feerequest)
                                     ->where('created_at',$created_at)
                                  ->with('action_taken_by','feerequestcategories','students')
                                  ->first();
        
       $data = [
         'status'             => $request->status,
         'remarks'            => $request->remarks,
         'action_taken_by_id' => Auth::id()
       ];

       $feerequest->update($data);

       flash()->success('Successfully Form Submited'); 

       return back();
    }
}
