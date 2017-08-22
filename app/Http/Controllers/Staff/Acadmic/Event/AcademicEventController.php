<?php

namespace App\Http\Controllers\Staff\Acadmic\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Asession;
use App\Event;
use Auth;


class AcademicEventController extends Controller
{
     public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);

    }

     public function event_form(Request $request)
    { 
       $activesessionid = Asession::where('user_id',Auth::user()->owner->id)->where('active',1)->select('id')->first();

        if (!$activesessionid) {
                      
              flash()->warning('No session Active, please active current session first!');

              return redirect('/acadmic/asessions/create');

          }

    	$userevents = Event::filter($request)->where('user_id',Auth::user()->owner->id)
    	                    ->where('asession_id',$activesessionid->id)->latest()
    	                    ->with('creater')->paginate(10);

        return view('staff.notification_message.events',compact('userevents'));
    }

    public function event_post(Request $r)
    {
    	
        $this->validate($r,[
            'title'             =>       'required',
            'start'             =>       'required|date_format:d/m/Y g:i A',
            'end'               =>       'required|date_format:d/m/Y g:i A',
            'event_type'        =>       'required|boolean'
        ]);
        
        $user = Auth::user();

        $activesessionid = Asession::where('user_id',$user->owner->id)->where('active',1)->select('id')->first()->id;

        $data = [

              'creater_id'     => $user->id,
              'title'          => $r->title,
              'event_body'     => $r->event_body,
              'start'          => $r->start,
              'end'            => $r->end,
              'full_day'       => $r->event_type,
              'asession_id'    => $activesessionid

            ];

            $user->owner->events()->create($data);

            flash()->success('Successfully Form Submited');

            return back();

    }

    public function event_view()
    {
    	   

    	    $userevents = Event::where('user_id',Auth::user()->owner->id)->get();

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

        return view('staff.notification_message.event.event_view',compact('calendar'));
    }

    
}
