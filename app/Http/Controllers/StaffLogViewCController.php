<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\LogRequest;
use Carbon\Carbon;

class StaffLogViewCController extends Controller
{

	 public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }
   
    public function logs(Request $request)
    { 

     $logrequests = LogRequest::Filter($request)->whereHas('asessions',function($q){
                                      $q->where('user_id',Auth::user()->owner->id);
                                    })->with('action_taker','logrequestcategories','students','teachers','asessions')
    	                            ->latest()
    	                            ->paginate(10);
    //return $logrequests->count();                            
        
        return view('staff.log_control.logs',compact('logrequests'));
    }

    public function log_view($ticket_no=null,$logrequest = null, $created_at= null)
    { 
    	$created_at=Carbon::createFromTimeStamp($created_at);

        $logrequest = LogRequest::whereHas('asessions',function($q){
                                      $q->where('user_id',Auth::user()->owner->id);
                                    })->where('ticket_no',$ticket_no)
                                     ->where('id',$logrequest)
                                     ->where('created_at',$created_at)
                                  ->with('action_taker','logrequestcategories','students','teachers','asessions')
                                  ->first();
                  // return $logrequest;               
        
        return view('staff.log_control.log_view',compact('logrequest'));
    }

    public function log_reply_save(Request $request, $ticket_no=null,$logrequest = null, $created_at= null)
    { 
    	$this->validate($request,[
            'status'              =>       'required|boolean'
        ]);
    	$created_at=Carbon::createFromTimeStamp($created_at);

        $logrequest = LogRequest::whereHas('asessions',function($q){
                                      $q->where('user_id',Auth::user()->owner->id);
                                    })->where('ticket_no',$ticket_no)
                                     ->where('id',$logrequest)
                                     ->where('created_at',$created_at)        
                                  ->first();
             $data = [

              'status'          => $request->status,
              'remarks'         => $request->remarks,
              'action_taker_id' => Auth::id()
             ];                   
        $logrequest->update($data);

        flash()->success('Successfully Updated'); 

        return back();
    }
}
