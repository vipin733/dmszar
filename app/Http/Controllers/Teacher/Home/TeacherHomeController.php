<?php

namespace App\Http\Controllers\Teacher\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher_Staff_Attendence;
use App\Model\Staff\Acadmic\TimeTable;
use App\TeacherTeachingAcadmic;
use App\TeacherAcadmic;
use Carbon\Carbon;
use App\Asession;
use App\Teacher;
use App\Event;
use Auth;
use DB;

class TeacherHomeController extends Controller
{

     public function __construct()

    {
       $this->middleware(['auth:teacher','active','teachers']);
    }


     public function home(Request $request)
    {
             
        $user =Auth::user();

        $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first(); 
         
          if ($activesessionid) {
                       $activesessionidID = $activesessionid->id;         
          }else{
               $activesessionidID = 100000000000000000000;
          }    

         $today        = Carbon::today()->format('l');
         $lowertoday   =   mb_strtolower($today,'UTF-8');
         $subjectsname = $lowertoday.'subjects';
         $teachersname = $lowertoday.'teachers';
         $teacher_id   = $lowertoday.'_teacher_id';
         $remarks      = $lowertoday.'_remarks';
         

         $events = Event::where('asession_id',$activesessionidID)
                        ->whereDate('start','>=',Carbon::today()->format('Y-m-d'))->get();

         //return $events;               
        
        $timetables = TimeTable::where(function($q) use($activesessionidID,$teacher_id){
                                      $q->where('user_id',Auth::user()->owner->id)
                                         ->where('asession_id',$activesessionidID)
                                         ->where($teacher_id,Auth::id());
                                   })->with($subjectsname,$teachersname,'courses','sections')
                                    ->orderBy(DB::raw('TIME(start)'))
                                    ->get();                              


         $user->load(['messages' => function($q){
            $q->latest()->take(3);
        }],'messages.byowner','messages.byteacher');

         $user->load(['teacheracadmic' => function($q) use($activesessionidID){
         	   $q->where('asession_id',$activesessionidID);
         }],'teacheracadmic','teacheracadmic.sections','teacheracadmic.courses');

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
	                                
	        return view('teacher.teacher',compact('user','timetables','remarks','subjectsname','events')) 
	                                        ->with('date',json_encode($date))
	                                        ->with('tota',json_encode($tota));

	     }else{
	          $tota = [null];

	       return view('teacher.teacher',compact('user','timetables','remarks','subjectsname','events')) 
	                                        ->with('date',json_encode($date))
	                                        ->with('tota',json_encode($tota));
	    } 

    }

    public function profile()
    {
        $user = Auth::user();

        $user->load('stopages','permanent_district','communication_district','permanent_states','communication_states');

        return view('teacher.stuff.profile',compact('user'));
    }

    public function course_profile()
    {

       $userId = Auth::user()->owner->id;

        $activesessionid = Asession::where('user_id',$userId)
                                        ->where('active',1)
                                        ->select('id')
                                        ->first(); 

         if ($activesessionid) {
                       $activesessionidID = $activesessionid->id;         
          }else{
               $activesessionidID = 100000000000000000000;
          }                                   

       $teacherteachingacadmics = TeacherTeachingAcadmic::where('teacher_id',Auth::id())
                                                          ->where('asession_id',$activesessionidID)
                                                          ->with('subjects','courses','sections')
                                                          ->get();
       $teacheracadmic = TeacherAcadmic::where('teacher_id',Auth::id())
                                                          ->where('asession_id',$activesessionidID)
                                                          ->with('courses','sections')
                                                          ->first();                                                   
           
    return view('teacher.stuff.course_profile',compact('teacherteachingacadmics','teacheracadmic'));                      
        
    }

}
