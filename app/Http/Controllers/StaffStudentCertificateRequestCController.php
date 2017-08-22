<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\MarkSheetRequest;
use App\CCRequest;
use Carbon\Carbon;

class StaffStudentCertificateRequestCController extends Controller
{

	public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }

    public function mark_sheets_requests()
    { 
       $marksheetrequests = MarkSheetRequest::whereHas('asessions',function($q){
                                     $q->where('user_id',Auth::user()->owner->id);
                                    })->with('students','courses')
                                     ->latest()
                                     ->paginate(10);
        
        return view('staff.certificate_request.mark_sheet_request.mark_sheets_requests',compact('marksheetrequests'));
    }

    public function mark_sheet_view($ticket_no=null,$marksheetrequest = null, $created_at= null)
    { 
        $created_at=Carbon::createFromTimeStamp($created_at);

        $marksheetrequest = MarkSheetRequest::whereHas('asessions',function($q){
                                      $q->where('user_id',Auth::user()->owner->id);
                                    })->where('ticket_no',$ticket_no)
                                     ->where('id',$marksheetrequest)
                                     ->where('created_at',$created_at)
                                  ->with('updated_by','students','courses')
                                  ->first();
        
        return view('staff.certificate_request.mark_sheet_request.mark_sheets_request_view',compact('marksheetrequest'));
    }

    public function mark_sheet_save(Request $request, $ticket_no=null,$marksheetrequest = null, $created_at= null)
    { 
        $this->validate($request,[
            'status'              =>       'required|boolean'
        ]);

        $created_at=Carbon::createFromTimeStamp($created_at);

        $marksheetrequest = MarkSheetRequest::whereHas('asessions',function($q){
                                      $q->where('user_id',Auth::user()->owner->id);
                                    })->where('ticket_no',$ticket_no)
                                     ->where('id',$marksheetrequest)
                                     ->where('created_at',$created_at)
                                  ->first();
        
       $data = [

              'status'          => $request->status,
              'remarks'         => $request->remarks,
              'updated_by_id'   => Auth::id()
             ];  

        $marksheetrequest->update($data);

        flash()->success('Successfully Updated'); 

        return back();
    }

     public function certificate_requests()
    { 
       $ccrequests = CCRequest::whereHas('asessions',function($q){
                                     $q->where('user_id',Auth::user()->owner->id);
                                    })->with('students','certificatecategories')
                                     ->latest()
                                     ->paginate(10);
        return view('staff.certificate_request.certificate_requests.certificate_requests',compact('ccrequests'));
    }

    public function certificate_request_view($ticket_no=null,$ccrequest = null, $created_at= null)
    { 
          $created_at=Carbon::createFromTimeStamp($created_at);
         $ccrequest = CCRequest::whereHas('asessions',function($q){
                                      $q->where('user_id',Auth::user()->owner->id);
                                    })->where('ticket_no',$ticket_no)
                                     ->where('id',$ccrequest)
                                     ->where('created_at',$created_at)
                                  ->with('updated_by','students','certificatecategories')
                                ->first();  
        
        return view('staff.certificate_request.certificate_requests.certificate_request_view',compact('ccrequest'));
    }

    public function certificate_request_save(Request $request, $ticket_no=null,$ccrequest = null, $created_at= null)
    { 
        $this->validate($request,[
            'status'              =>       'required|boolean',
            'fee_status'          =>      'required|boolean'
        ]);

          $created_at=Carbon::createFromTimeStamp($created_at);
         $ccrequest = CCRequest::whereHas('asessions',function($q){
                                      $q->where('user_id',Auth::user()->owner->id);
                                    })->where('ticket_no',$ticket_no)
                                     ->where('id',$ccrequest)
                                     ->where('created_at',$created_at)
                                ->first();  
         $data = [

              'status'          => $request->status,
              'fee_status'      => $request->fee_status,
              'remarks'         => $request->remarks,
              'updated_by_id'   => Auth::id()
             ];  

        $ccrequest->update($data);

        flash()->success('Successfully Updated'); 

        return back();
    }
}
