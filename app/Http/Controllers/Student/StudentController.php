<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Model\Teacher\Student\StudentHomeWork;
use App\Model\Staff\Acadmic\TimeTable;
use App\TransportFeeCollection;
use App\TutionFeeCollection;
use App\HostelFeeCollection;
use App\StudentAttendence;
use App\StudentAcadmic;
use Carbon\Carbon;
use App\Asession;
use App\Student;
use App\Event;
use Auth;
use Hash;
use DB;

class StudentController extends Controller
{
   
     public function __construct()
    {
        $this->middleware('guest:student')->only('login','postlogin');
        $this->middleware(['auth:student','active'])->except('login','postlogin');           
    }
  
    public function login()
    {
    	return view('student.student_login');
     }

     public function postlogin(Request $r)
     {
         $this->validate($r,[

            'reg_no' =>       'required',
            'password' =>      'required|min:6'
   	  	]);

         $crendential = [        
         'reg_no' => $r->reg_no,
         'password' => $r->password,
         ];

         if (Auth::guard('student')->attempt($crendential ,$r->remember)) {
         	flash()->success('Successfully Login');
         	return redirect()->intended('/student');
         }

         flash('Reg. No./Password wrong or Account not activated.', 'danger');

         return redirect()->back()->withInput($r->only('reg_no','remember'));
     }

    public function index()
    {

        $user = Auth::user();

        $tution_fee = TutionFeeCollection::where('student_id',Auth::id())->latest()->take(5)->select('tution_fee','created_at')->get();
        $transport_fee = TransportFeeCollection::where('student_id',Auth::id())->latest()->take(5)->select('transport_fee','created_at')->get();
        $hostel_fee = HostelFeeCollection::where('student_id',Auth::id())->latest()->take(5)->select('hostel_fee','created_at')->get();

        $collection = collect([$tution_fee, $transport_fee, $hostel_fee]);

        $collapsed = $collection->collapse()->sortByDesc('created_at')->take(5);

        //return $collapsed;

        $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id','name')
                                         ->first();

        
          if ($activesessionid) {
                       $activesessionidID = $activesessionid->id;         
          }else{
               $activesessionidID = 100000000000000000000;
          } 

          $events = Event::where('asession_id',$activesessionidID)
                        ->whereDate('start','>=',Carbon::today()->format('Y-m-d'))->get();

         $today = Carbon::today()->format('l');
         $lowertoday =   mb_strtolower($today,'UTF-8');
         $subjectsname = $lowertoday.'subjects';
         $teachersname = $lowertoday.'teachers';
         $remarks = $lowertoday.'_remarks';


        $studentacadmic = StudentAcadmic::where('student_id',Auth::id())
                                          ->where('asession_id',$activesessionidID)
                                          ->with('courses','sections')
                                          ->first();  

         if ($studentacadmic) {
                       $CourseID  = $studentacadmic->course_id;  
                       $SectionID = $studentacadmic->section_id;        
          }else{
                       $CourseID  = 1000000000000000000000000000;  
                       $SectionID = 100000000000000000000000000000; 
          }                                   

        $homework = StudentHomeWork::where('asession_id',$activesessionidID)
                                     ->where('course_id',$CourseID)  
                                     ->where('section_id',$SectionID)
                                     ->with('subjects','teachers')
                                     ->latest()->first();                         

    
        
        $timetables = TimeTable::where(function($q) use($CourseID,$SectionID,$activesessionidID){
                                      $q->where('user_id',Auth::user()->owner->id)
                                         ->where('course_id',$CourseID)
                                         ->where('section_id',$SectionID)
                                         ->where('asession_id',$activesessionidID);
                                   })->has($subjectsname)->has($teachersname)
                                    ->with($subjectsname,$teachersname)
                                    ->orderBy(DB::raw('TIME(start)'))
                                    ->get();
       //return $timetables;                                                              

       $month = StudentAttendence::selectRaw("month(date) as month")
                                    ->orderBy('id','asc')
                                    //->groupBy('id')
                                    ->groupBy(DB::raw('month(date)'))
                                    ->where('student_id',Auth::id())
                                    ->where('asession_id',$activesessionidID)
                                    ->get();
        $present = StudentAttendence::select(DB::raw("count(id) as tot_present,month(date) as month"))
                                        ->orderBy('id','asc')
                                        //->groupBy('id')
                                        ->groupBy(DB::raw('month(date)'))
                                        ->where('student_id',Auth::id())
                                        ->where('asession_id',$activesessionidID)
                                        ->where('marked',1)
                                        ->get(); 
        $total = StudentAttendence::selectRaw("count(id) as tot_attendance")
                                        ->orderBy('id','asc')
                                        //->groupBy('id')
                                        ->groupBy(DB::raw('month(date)'))
                                        ->where('student_id',Auth::id())
                                        ->where('asession_id',$activesessionidID)
                                        ->get(); 


        $user->load(['messages' => function($q){
            $q->take(3)->latest();
        }],'messages.byowner','messages.byteacher');

     if (count($month)) {
            foreach ($month as $key2 => $value) {
            $date[] = Carbon::createFromDate(null,$value->month,null)->format('F');
          } 
        }else{
            $date = [null];
        }   
       
                                                                           
    if (count($present)) {                                   
                                 
        foreach ($present as $key => $value) {                              
                    $presents[] = $value->tot_present;                              
        } 
        foreach ($total as $key1 => $value) {               
                $totals[] = $value->tot_attendance;
        }  
         

       $tota =  array_map(function ($a, $b) { return round($a / $b * 100, 2); }, $presents, $totals);
                                
        return view('student.student',compact('user','studentacadmic','activesessionid','timetables','remarks','subjectsname','teachersname','homework','events')) 
                                        ->with('date',json_encode($date))
                                        ->with('tota',json_encode($tota));

     }else{
          $tota = [null];

       return view('student.student',compact('user','studentacadmic','activesessionid','timetables','remarks','subjectsname','teachersname','homework','events')) 
                                        ->with('date',json_encode($date))
                                        ->with('tota',json_encode($tota));
     }                        

    }


    public function profile()
    {
        $user = Auth::user();

        $user->load('courses','created_courses','stopages','permanent_district','permanent_states','communication_district','communication_states');

        return view('student.profile',compact('user'));
    }

     public function course_profile()
    {

        $user = Auth::user();

        $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();  
        if ($activesessionid) {
                       $activesessionidID = $activesessionid->id;         
          }else{
               $activesessionidID = 100000000000000000000;
          }                                   

       $studentacadmic = StudentAcadmic::where('student_id',Auth::id())
                                          ->where('asession_id',$activesessionidID)
                                          ->with('courses','courses.subjects','sections','courses.teacheracadmic.teachers')
                                          ->with(['courses.teacheracadmic' => function($q) use ($activesessionidID){
                                            $q->where('asession_id',$activesessionidID);
                                          }])->first();  
           //return $studentacadmic;                                            
        return view('student.stuff.course_profile',compact('user','studentacadmic'));
    }

    public function grades()
    {
        $user = Auth::user();

        return view('student.stuff.grades',compact('user'));
    }
  
    public function attendence()
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
                                         
           $attendences = StudentAttendence::where('asession_id',$activesessionidID)
                                             ->where('student_id',Auth::id())
                                             ->with('taker')
                                             ->latest()
                                             ->take(7)->get();
            if (count($attendences)) {                                   

       $month = StudentAttendence::selectRaw("month(date) as month")
                                    ->orderBy("id")
                                    ->groupBy(DB::raw('month(date)'))
                                    ->where('student_id',Auth::id())
                                    ->where('asession_id',$activesessionidID)
                                    ->get();
        $present = StudentAttendence::select(DB::raw("count(id) as tot_present,month(date) as month"))
                                        ->orderBy("id")
                                        ->groupBy(DB::raw('month(date)'))
                                        ->where('student_id',Auth::id())
                                        ->where('asession_id',$activesessionidID)
                                        ->where('marked',1)
                                        ->get(); 
        $total = StudentAttendence::selectRaw("count(id) as tot_attendance")
                                        ->orderBy("id")
                                        ->groupBy(DB::raw('month(date)'))
                                        ->where('student_id',Auth::id())
                                        ->where('asession_id',$activesessionidID)
                                        ->get(); 
        if (count($present)) {
              foreach ($present as $key => $value) {                              
                    $presents[] = $value->tot_present;
                }                                                  
                                   
          }else{
            $presents = [null];
          }
        foreach ($total as $key1 => $value) {               
                $totals[] = $value->tot_attendance;
        }  
        foreach ($month as $key2 => $value) {
            $date[] = Carbon::createFromDate(null,$value->month,null)->format('F');
        }  

       $tota =  array_map(function ($a, $b) { return round($a / $b * 100, 2); }, $presents, $totals);  

                                                                         
        return view('student.attendence.attendences',compact('attendences'))
        ->with('date',json_encode($date))
        ->with('tota',json_encode($tota));

       }else{
       
        flash('No Record Found'); 
                        
           return back(); 
       }
    }

    public function attendence_details(Request $request)
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
                    
                 $attendences = StudentAttendence::where('asession_id',$activesessionidID)
                                             ->where('student_id',Auth::id())
                                             ->whereDate('date','>=',$start)
                                             ->whereDate('date','<=',$end)
                                             ->with('taker')
                                             ->latest()
                                             ->paginate(7);
              } else{
                 $attendences = StudentAttendence::where('asession_id',$activesessionidID)
                                             ->where('student_id',Auth::id())                                            
                                             ->with('taker')
                                             ->latest()
                                             ->paginate(7);
              }                            
         

        return view('student.attendence.details_attendence',compact('attendences'));
    } 

    public function changeget()
    {
        return view('student.student_change_password');
    }

    public function changepost(Request $r)
    {
        $this->validate($r,[

            'old_password' =>        'required|min:6',
            'new_password' =>        'required|min:6',
            'confirm_password'     =>  'required|same:new_password'
        ]);

         $oldpass     = $r->old_password;
         $newpass     = $r->new_password;
         $user        = Auth::user();

         if (Hash::check($oldpass,$user->password)) {

             if (!Hash::check($newpass,$user->password)) {             

                 $user->password = Hash::make($newpass);

                 $user->save();

                flash()->success('Successfully Password Change');

                return redirect()->to('/student');

             }
                 
                flash('Oops/Your new password should be differnet from old password! Try Again', 'danger');

                return redirect()->back()->withInput($r->only('old_password','new_password'));
                       
         }else{

         flash('Oops/Your new password did not match to old to password! Try Again!', 'danger');

         return redirect()->back()->withInput($r->only('old_password','new_password'));

         }

        
    }

    public function oops()
    {
    	return view('error.error');
    }

}
