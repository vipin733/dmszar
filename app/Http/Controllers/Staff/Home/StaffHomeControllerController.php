<?php

namespace App\Http\Controllers\Staff\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher_Staff_Attendence;
use Carbon\Carbon;
use App\Asession;
use App\Event;
use Auth;
use DB;

class StaffHomeControllerController extends Controller
{
    
      public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }

    public function home()
    {
        $user =Auth::user();

        $user->load('messages');
        //return $user->id;

         $user->load(['messages' => function($q){
            $q->latest()->take(3);
        }],'messages.byowner','messages.byteacher');

        $activesessionid = Asession::where('user_id',$user->owner->id)->where('active',1)->select('id')->first();

        if ($activesessionid) {
                       $activesessionidID = $activesessionid->id;         
          }else{
               $activesessionidID = 100000000000000000000;
          }    

        $events = Event::where('asession_id',$activesessionidID)
                        ->whereDate('start','>=',Carbon::today()->format('Y-m-d'))->get();                           

        $month = Teacher_Staff_Attendence::where('teacher_id',Auth::id())
                                    ->where('asession_id',$activesessionidID)
                                    ->selectRaw("month(date) as month")
                                    ->orderBy('id','asc')
                                    //->groupBy('id')
                                    ->groupBy(DB::raw('month(date)'))
                                    ->get();
       
        $present = Teacher_Staff_Attendence::where('teacher_id',Auth::id())
                                        ->where('asession_id',$activesessionidID)
                                        ->where('marked',1)
                                        ->select(DB::raw("count(id) as tot_present,month(date) as month"))
                                        ->orderBy('id','asc')
                                        //->groupBy('id')
                                        ->groupBy(DB::raw('month(date)'))
                                        ->get(); 

        $total = Teacher_Staff_Attendence::where('teacher_id',Auth::id())
                                        ->where('asession_id',$activesessionidID)
                                        ->selectRaw("count(id) as tot_attendance")
                                        ->orderBy('id','asc')
                                        //->groupBy('id')
                                        ->groupBy(DB::raw('month(date)'))
                                        ->get();                                   

       

     if (count($month)) {
            foreach ($month as $key2 => $value) {
            $date[] = Carbon::createFromDate(null,$value->month,null)->format('F');
          } 
        }else{
            $date = [null];
        }   

        //return $date;


	        if (count($present)) {                                   
	                                 
	        foreach ($present as $key => $value) {                              
	                    $presents[] = $value->tot_present;                              
	        } 
	        foreach ($total as $key1 => $value) {               
	                $totals[] = $value->tot_attendance;
	        }  
	         

	       $tota =  array_map(function ($a, $b) { return round($a / $b * 100, 2); }, $presents, $totals);
	                                
	        return view('staff.staff',compact('user','events')) 
	                                        ->with('date',json_encode($date))
	                                        ->with('tota',json_encode($tota));

	     }else{
	          $tota = [null];

	       return view('staff.staff',compact('user','events')) 
	                                        ->with('date',json_encode($date))
	                                        ->with('tota',json_encode($tota));
	    }          
      

    }  

    public function profile()
    { 
    	  $user = Auth::user();

        return view('staff.profile',compact('user'));
    }
}
