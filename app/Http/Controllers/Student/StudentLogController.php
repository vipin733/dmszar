<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LogRequestCategory;
use App\Asession;
use App\LogRequest;
use App\Notification;
use Auth;

class StudentLogController extends Controller
{
	 public function __construct()
    { 
        $this->middleware(['auth:student','active']);           
    }

     public function log_request()
    {

        return view('student.log.log_request');
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
        $prefix = "DMS";
        $sufix = $letters[rand(0, 25)];
        $sufix1 = $letters[rand(0, 25)];
        $ticketno = $prefix . $numbers . $sufix.$sufix1;

        $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                        ->first(); 

         if (!$activesessionid) {
                 
                 flash()->warning('No session Active, please contact to your institution admin!');
                 return back();

          }                                 

        $logrequestcategory= LogRequestCategory::where('id',$request->category)
                                              ->select('id')
                                               ->first();

        $data = [
           'ticket_no'       => $ticketno,
           'asession_id'     => $activesessionid->id,
           'student_id'      => Auth::id(),
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
    	 $logrequests = LogRequest::where('student_id',Auth::id())
    	                            ->with('action_taker','logrequestcategories')
    	                            ->latest()
    	                            ->paginate(10);
    	                            
    	 $completedlog = LogRequest::where('student_id',Auth::id())
    	                             ->where('status',1)
    	                             ->count();
    	 $pendinglog = LogRequest::where('student_id',Auth::id())
    	                             ->where('status',0)
    	                             ->count();                            

        return view('student.log.log_view',compact('logrequests','completedlog','pendinglog'));
    }

       public function notification_index(Request $request)
    { 
        $user = Auth::user();

        $notifications = Notification::filter($request)->where('user_id',$user->owner->id)
                                       ->with('notifications_categories')
                                       ->latest()
                                       ->get();
        
        return view('student.notification_message.notification_index',compact('user','notifications'));
    }

        public function notification_show($not = null, $slug = null)
    { 
        $user = Auth::user();

        $notification = Notification::where('id',$not)
                                    ->where('slug',$slug)
                                    ->where('user_id',$user->owner->id)
                                    ->with('notifications_categories')
                                    ->first();
        
        return view('student.notification_message.notification_show',compact('user','notification'));
    }
}
