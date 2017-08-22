<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Asession;
use App\Teacher_Staff_Attendence;
use Carbon\Carbon;
use DB;
use Auth;

class TeacherAttandanceController extends Controller
{
	
	public function __construct()
    {
       $this->middleware(['auth:teacher','active','teachers']);
    }

    public function attendance()
    {   

        $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();
         

        if ($activesessionid) {
                       $activesessionidID = $activesessionid->id;         
          }else{
               $activesessionidID = 100000000000000000000;
          }
      
        $attendences = Teacher_Staff_Attendence::where('asession_id',$activesessionidID)
                                             ->where('teacher_id',Auth::id())
                                             ->with('taker')
                                             ->latest()
                                             ->take(7)->get(); 

    	if (count($attendences)) {
    		 

       $month = Teacher_Staff_Attendence::selectRaw("month(date) as month")
                                    ->orderBy("id")
                                    ->groupBy(DB::raw('month(date)'))
                                    ->where('teacher_id',Auth::id())
                                    ->where('asession_id',$activesessionidID)
                                    ->get();
        $present = Teacher_Staff_Attendence::select(DB::raw("count(id) as tot_present,month(date) as month"))
                                        ->orderBy("id")
                                        ->groupBy(DB::raw('month(date)'))
                                        ->where('teacher_id',Auth::id())
                                        ->where('asession_id',$activesessionidID)
                                        ->where('marked',1)
                                        ->get(); 
        $total = Teacher_Staff_Attendence::selectRaw("count(id) as tot_attendance")
                                        ->orderBy("id")
                                        ->groupBy(DB::raw('month(date)'))
                                        ->where('teacher_id',Auth::id())
                                        ->where('asession_id',$activesessionidID)
                                        ->get(); 
    
                         foreach ($present as $key => $value) {                              
                          $presents[] = $value->tot_present;                              
                        }
                        foreach ($total as $key1 => $value) {               
                                $totals[] = $value->tot_attendance;
                        }  
                        foreach ($month as $key2 => $value) {
                            $date[] = Carbon::createFromDate(null,$value->month,null)->format('F');
                        }  
                      
                
                   $tota =  array_map(function ($a, $b) { return round($a / $b * 100, 2); }, $presents, $totals);                                                                                    
                    return view('teacher.attendance.attendance',compact('attendences'))
                    ->with('date',json_encode($date))
                    ->with('tota',json_encode($tota));     	
       }else{
       
        flash('No Record Found'); 
                        
           return back(); 
       }
    }

    public function attendance_details(Request $request)
    {
            $starts = $request->from;
            $ende = $request->to;
            $dates = str_replace('/', '-', $starts);
            $datee = str_replace('/', '-', $ende);
            $start = date('Y-m-d', strtotime($dates));
            $end = date('Y-m-d', strtotime($datee));
       
         $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();
           if ($activesessionid) {
                       $activesessionidID = $activesessionid->id;         
          }else{
               $activesessionidID = 100000000000000000000;
          }
                                         
            if ($starts || $ende ) {
                    
                 $attendences = Teacher_Staff_Attendence::where('asession_id',$activesessionidID)
                                             ->where('teacher_id',Auth::id())
                                             ->whereDate('date','>=',$start)
                                             ->whereDate('date','<=',$end)
                                             ->with('taker')
                                             ->latest()
                                             ->paginate(7);
              } else{
                 $attendences = Teacher_Staff_Attendence::where('asession_id',$activesessionidID)
                                             ->where('teacher_id',Auth::id())                                            
                                             ->with('taker')
                                             ->latest()
                                             ->paginate(7);
              }                            
         

        return view('teacher.attendance.attendance_details',compact('attendences'));
    }
}
