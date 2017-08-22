<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LogRequestCategory;
use App\Asession;
use App\LogRequest;
use Auth;

class TeacherLogController extends Controller
{
     public function __construct()
    { 
        $this->middleware(['auth:teacher','active','teachers']);           
    }

     public function log_request()
    {

        return view('teacher.log.log_request');
    }

    public function log_request_save(Request $request)
    {
    	$this->validate($request,[
            'category'        =>      'required|integer',
            'subject'         =>      'required'
            
        ]); 

        $user = Auth::user();

        $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $numbers = rand(10000000, 99999999);
        $prefix = "GRA";
        $sufix = $letters[rand(0, 25)];
        $sufix1 = $letters[rand(0, 25)];
        $ticketno = $prefix . $numbers . $sufix.$sufix1;

        $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                        ->first(); 

        $logrequestcategory= LogRequestCategory::where('user_id',$user->owner->id)
                                              ->where('id',$request->category)
                                              ->select('id')
                                               ->first();

        $data = [
           'ticket_no'       => $ticketno,
           'asession_id'     => $activesessionid->id,
           'teacher_id'      => Auth::id(),
           'log_category_id' => $logrequestcategory->id,
           'subject'         => $request->subject,
           'description'     => $request->description,
           'status'          => 0
        ];

        LogRequest::create($data);

         flash()->success('Successfully Request submited'); 
          return back(); 

    }

    public function log_view()
    { 
    	 $logrequests = LogRequest::where('teacher_id',Auth::id())
    	                            ->with('action_taker','logrequestcategories')
    	                            ->latest()
    	                            ->paginate(10);
    	                            
    	 $completedlog = LogRequest::where('teacher_id',Auth::id())
    	                             ->where('status',1)
    	                             ->count();
    	 $pendinglog = LogRequest::where('teacher_id',Auth::id())
    	                             ->where('status',0)
    	                             ->count();                            

        return view('teacher.log.log_view',compact('logrequests','completedlog','pendinglog'));
    }
}
