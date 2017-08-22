<?php

namespace App\Http\Controllers\Auth\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Asession;
use App\Event;
use Auth;

class EventViewController extends Controller
{
	 public function __construct()
    {
         $this->middleware(['auth','auth_active']);
    }

    public function event_view(Request $request)
    { 
       $activesessionid = Asession::where('user_id',Auth::id())->where('active',1)->select('id')->first();

        if (!$activesessionid) {
                      
              flash()->warning('No session Active, please contact to administrative!');

              return back();

          }

    	$userevents = Event::filter($request)->where('user_id',Auth::id())
    	                    ->where('asession_id',$activesessionid->id)->latest()
    	                    ->with('creater')->paginate(10);

        return view('auth.notification_message.event_view',compact('userevents'));
    }

   
    public function event_view_calendor()
    {
    	   
    	    $userevents = Event::where('user_id',Auth::id())->get();

            $events = [];
           
           foreach ($userevents as $userevent) {
           	  
               $events[] = \Calendar::event(
			     $userevent->title, //event title
			     $userevent->full_day, //full day event?
			     $userevent->start, //start time (you can also use Carbon instead of DateTime)
			     $userevent->end, //end time (you can also use Carbon instead of DateTime)
				 $userevent->id //optionally, you can specify an event ID
			);

           }
			

			$calendar = \Calendar::addEvents($events) //add an array with addEvents
			    ->setOptions([ //set fullcalendar options
					'firstDay' => 1
				])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
			        
			    ]); 

        return view('auth.notification_message.event_view_calendor',compact('calendar'));
    }
}
