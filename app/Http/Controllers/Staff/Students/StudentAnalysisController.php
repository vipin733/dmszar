<?php

namespace App\Http\Controllers\Staff\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StudentAcadmic;
use App\TutionFeeCollection;
use App\TransportFeeCollection;
use App\HostelFeeCollection;
use App\Model\Staff\Fee\RegistraionFeeCollection;
use App\Asession;
use Auth;

class StudentAnalysisController extends Controller
{
	 public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }


      public function mix_analysis()
    { 
    	$user = Auth::user();

        $activesession = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('name','id')
                                        ->first();
          if (!$activesession) {
                      
              flash()->warning('No session Active, please active current session first!');

             // return redirect()->to('');
              return redirect('/acadmic/asessions/create');

          }                                   
        //return $activesession;
    	$total_students = StudentAcadmic::selectRaw("count(id) as tot_student")
    	                                ->where('asession_id',$activesession->id)
                                        ->whereHas('students',function($q) use($user){
                                          $q->where('user_id',$user->owner->id)
                                             ->where('active',1);
                                        })->orderBy('course_id')
                                        //->groupBy('id')
                                        ->groupBy('course_id')
                                        ->get();
        if (count($total_students)) {
                        foreach ($total_students as $key => $value) {                              
                          $totalstudents[] = $value->tot_student; 

                        }
	        }else{
	            $totalstudents[] = [null];
	    }  





	                                     
        $total_students_male = StudentAcadmic::selectRaw("count(id) as tot_student")
    	                                ->where('asession_id',$activesession->id)
                                        ->whereHas('students',function($q) use($user){
                                          $q->where('user_id',$user->owner->id)
                                             ->where('active',1)
                                             ->where('gender',1);
                                        })->orderBy('course_id')
                                        //->groupBy('id')
                                        ->groupBy('course_id')
                                        ->get();
        if (count($total_students_male)) {
                        foreach ($total_students_male as $key => $value) {                              
                          $totalstudentsmale[] = $value->tot_student; 

                        }
	        }else{
	            $totalstudentsmale[] = [null];
	    }                                  
        $total_students_female = StudentAcadmic::selectRaw("count(id) as tot_student")
    	                                ->where('asession_id',$activesession->id)
                                        ->whereHas('students',function($q) use($user){
                                          $q->where('user_id',$user->owner->id)
                                             ->where('active',1)
                                             ->where('gender',2);
                                        })->orderBy('course_id')
                                        //->groupBy('id')
                                        ->groupBy('course_id')
                                        ->get();
        
        if (count($total_students_female)) {
                        foreach ($total_students_female as $key => $value) {                              
                          $totalstudentsfemale[] = $value->tot_student; 

                        }
	        }else{
	            $totalstudentsfemale[] = [null];
	    }  

         $total_students_other = StudentAcadmic::selectRaw("count(id) as tot_student")
    	                                ->where('asession_id',$activesession->id)
                                        ->whereHas('students',function($q) use($user){
                                          $q->where('user_id',$user->owner->id)
                                             ->where('active',1)
                                             ->where('gender',3);
                                        })->orderBy('course_id')
                                        //->groupBy('id')
                                        ->groupBy('course_id')
                                        ->get();   

        if (count($total_students_other)) {
                        foreach ($total_students_other as $key => $value) {                              
                          $totalstudentsother[] = $value->tot_student; 

                        }
	        }else{
	            $totalstudentsother[] = [null];
	    }                                                                                                                               
         //return $total_students;
         $total_courses = StudentAcadmic::whereHas('students',function($q) use($user){
                                          $q->where('user_id',$user->owner->id)
                                             ->where('active',1);
                                        })->orderBy('course_id')
                                        //->groupBy('id')
                                         ->groupBy('course_id')
                                         ->with('courses')
                                         ->get();

                                         

          if (count($total_courses)) {
                        foreach ($total_courses as $key => $value) {                              
                          $totalcourses[] = $value->courses->name; 

                        }
	        }else{
	            $totalcourses[] = [null];
	        } 

          



          $total_students_sessions = StudentAcadmic::selectRaw("count(id) as tot_student")
                                        ->whereHas('students',function($q) use($user){
                                          $q->where('user_id',$user->owner->id);
                                        })->orderBy('asession_id')
                                        ->groupBy('asession_id')
                                        ->get(); 
          $total_sessions = StudentAcadmic::whereHas('students',function($q) use($user){
                                          $q->where('user_id',$user->owner->id);
                                        })->orderBy('asession_id')
                                         ->groupBy('asession_id')
                                         ->with('asessions')
                                         ->get();

         if (count($total_students_sessions)) {
                        foreach ($total_students_sessions as $key => $value) {                              
                          $totalstudentssessions[] = $value->tot_student; 

                        }
          }else{
              $totalstudentssessions[] = [null];
          } 


         if (count($total_sessions)) {
                        foreach ($total_sessions as $key => $value) {                              
                          $sessions[] = $value->asessions->name; 

                        }
          }else{
              $sessions[] = [null];
          }


          

        $chart_tution_fees= TutionFeeCollection::whereHas('asessions',function($q) use($user){
                                      $q->where('user_id',$user->owner->id);
                                    })->selectRaw('sum(`tution_fee`) as tution_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')
                                    ->groupBy('asession_id')
                                    ->orderBy('asession_id')
                                    ->get();

        $total_sessions_fees = TutionFeeCollection::whereHas('students',function($q) use($user){
                                          $q->where('user_id',$user->owner->id);
                                        })->orderBy('asession_id')
                                         ->groupBy('asession_id')
                                         ->with('asessions')
                                         ->get();                            
                           
                   if (count($chart_tution_fees)) {
                        foreach ($chart_tution_fees as $key => $value) {                              
                          $charttutionfees[] = $value->tution_fee + $value->late_fee + $value->other_fee; 

                        }
                    }else{
                        $charttutionfees[] = [null];
                    }

           if (count($total_sessions_fees)) {
                        foreach ($total_sessions_fees as $key => $value) {                              
                          $fee_sessions[] = $value->asessions->name; 

                        }
          }else{
              $fee_sessions[] = [null];
          }

        $chart_transport_fees= TransportFeeCollection::whereHas('asessions',function($q) use($user){
                                      $q->where('user_id',$user->owner->id);
                                    })->selectRaw('sum(`transport_fee`) as transport_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')
                                    ->groupBy('asession_id')
                                    ->orderBy('asession_id')
                                    ->get();
                            
                   if (count($chart_transport_fees)) {
                        foreach ($chart_transport_fees as $key => $value) {                              
                          $charttransportfees[] = $value->transport_fee + $value->late_fee + $value->other_fee; 

                        }
                    }else{
                        $charttransportfees[] = [null];
                    }


        $chart_registraion_fees= RegistraionFeeCollection::whereHas('asessions',function($q) use($user){
                                      $q->where('user_id',$user->owner->id);
                                    })->selectRaw('sum(`registraion_fee`) as registraion_fee, sum(`late_fee`) as late_fee')
                                    ->groupBy('asession_id')
                                    ->orderBy('asession_id')
                                    ->get();
                           
                   if (count($chart_registraion_fees)) {
                        foreach ($chart_registraion_fees as $key => $value) {                              
                          $chartregistraionfees[] = $value->registraion_fee + $value->late_fee; 

                        }
                    }else{
                        $chartregistraionfees[] = [null];
                    }


        $chart_hostel_fees= HostelFeeCollection::whereHas('asessions',function($q) use($user){
                                      $q->where('user_id',$user->owner->id);
                                    })->selectRaw('sum(`hostel_fee`) as hostel_fee, sum(`late_fee`) as late_fee')
                                    ->groupBy('asession_id')
                                    ->orderBy('asession_id')
                                    ->get();
                            
                   if (count($chart_hostel_fees)) {
                        foreach ($chart_hostel_fees as $key => $value) {                              
                          $charthostelfees[] = $value->hostel_fee + $value->late_fee; 

                        }
                    }else{
                        $charthostelfees[] = [null];
                    }
    
             // return $charthostelfeesfirstsession;


        $fees = array_map(function () {
                    return array_sum(func_get_args());
                }, $charttutionfees, $charttransportfees, $chartregistraionfees, $charthostelfees);

        $fees =  array_map(function ($a) { return round($a / 1000, 2); }, $fees);

          //return $sessions;
        
        return view('staff.analysis.mix_anaylsis',compact('user','activesession'))
                    ->with('totalstudents',json_encode($totalstudents))
                    ->with('totalcourses',json_encode($totalcourses))
                    ->with('totalstudentsmale',json_encode($totalstudentsmale))
                    ->with('totalstudentsfemale',json_encode($totalstudentsfemale))
                    ->with('totalstudentsother',json_encode($totalstudentsother))
                    ->with('totalstudentssessions',json_encode($totalstudentssessions))
                    ->with('sessions',json_encode($sessions))
                    ->with('fees',json_encode($fees))
                    ->with('fee_sessions',json_encode($fee_sessions));
    }
}
