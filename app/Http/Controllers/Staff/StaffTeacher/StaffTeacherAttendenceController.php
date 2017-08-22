<?php

namespace App\Http\Controllers\Staff\StaffTeacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher_Staff_Attendence;
use Carbon\Carbon;
use App\Asession;
use App\Teacher;
use Auth;

class StaffTeacherAttendenceController extends Controller
{
	public function __construct()
    {
      
      $this->middleware(['auth:teacher','active','staffs']); 
                   
    }


    public function teacher_staff_attendence()
    { 
            $teachers = Teacher::where('user_id',Auth::user()->owner->id)->where('active',1)->paginate(15);

           return view('staff.teachers_staff.teachers_staff_attendence',compact('teachers'));
    }

    public function teacher_staff_attendence_get($uuid = null, $reg_no = null)
    {
        $teacher = Teacher::where('uuid',$uuid)
                          ->where('reg_no',$reg_no)
                          ->where('user_id',Auth::user()->owner->id)
                          ->first();

        $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();

        if (!$activesessionid) {
                      
              flash()->warning('No session Active, please active current session first!');

             // return redirect()->to('');
              return redirect('/acadmic/asessions/create');

          }                               
                                         
                                                           
        $attendences = Teacher_Staff_Attendence::where('asession_id',$activesessionid->id)
                                             ->where('teacher_id',$teacher->id)
                                             ->with('taker')
                                             ->orderBy('date', 'desc')
                                             ->paginate(7);

        return view('staff.teachers_staff.teachers_staff_mark',compact('teacher','attendences'));
    }


    public function teacher_staff_attendence_details(Request $request, $uuid = null, $reg_no = null)
    {
        $teacher = Teacher::where('uuid',$uuid)
                          ->where('reg_no',$reg_no)
                          ->where('user_id',Auth::user()->owner->id)
                          ->first();

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

            if (!$activesessionid) {
                      
              flash()->warning('No session Active, please active current session first!');

             // return redirect()->to('');
              return redirect('/acadmic/asessions/create');

             } 
                                     
            if ($starts || $ende ) {
                    
                 $attendences = Teacher_Staff_Attendence::where('asession_id',$activesessionid->id)
                                             ->where('teacher_id',$teacher->id)
                                             ->whereDate('date','>=',$start)
                                             ->whereDate('date','<=',$end)
                                             ->with('taker')
                                             ->latest()
                                             ->paginate(7);
              } else{
                 $attendences = Teacher_Staff_Attendence::where('asession_id',$activesessionid->id)
                                             ->where('teacher_id',$teacher->id)
                                             ->with('taker')
                                             ->latest()
                                             ->paginate(7);
              }  

            // return $teacher;                    

        return view('staff.teachers_staff.teachers_staff_attendence_details',compact('teacher','attendences'));
    }

    public function teacher_staff_attendence_post(Request $r, $uuid = null, $reg_no = null)
    {

        $this->validate($r,[

            'date'             =>      'required|date_format:d/m/Y',
            'marked'           =>      'required|boolean',
            'entry_time'       =>      'required_if:marked,1'
        ]);
            
        if ($r->entry_time) {
          $entry_time = Carbon::parse($r->entry_time);
        }else{
          $entry_time = null;
        }

        if ($r->leave_time) {
          $leave_time = Carbon::parse($r->leave_time);
        }else{
          $leave_time = null;
        }

        $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();

        $teacher = Teacher::where('uuid',$uuid)
                          ->where('reg_no',$reg_no)
                          ->where('user_id',Auth::user()->owner->id)
                          ->first();
       
       $data = [

          'date'        => $r->date,
          'marked'      => $r->marked,
          'entry_time'  => $entry_time,
          'leave_time'  => $leave_time,
          'teacher_id'  => $teacher->id,
          'asession_id' => $activesessionid->id
       ];

        $d = $r->date;

        $dates = str_replace('/', '-', $d);

        $date = date('Y-m-d', strtotime($dates));

       

        $todayattendence = Teacher_Staff_Attendence::where('teacher_id', $teacher->id)
                                                     ->whereDate('date' , $date)->first();  

        $user = Auth::user();

        if (!$todayattendence) {
            $user->attendence()->create($data);
            flash()->success('Successfully attendence marked'); 
            return back();
        }

        flash('You already marked attendence for date of '. $d ); 
                        
         return back();
    }

    public function teacher_staff_attendence_update(Request $r, $uuid = null, $reg_no = null, $id = null)
    {
    	 $this->validate($r,[

            'marked'           =>      'required|boolean',
            'entry_time'       =>      'required_if:marked,1',
            'leave_time'       =>      'required_if:marked,1'
        ]);

    	 //return $r->all();
            
	        if ($r->entry_time) {
	          $entry_time = Carbon::parse($r->entry_time);
	        }else{
	          $entry_time = null;
	        }

	        if ($r->leave_time) {
	          $leave_time = Carbon::parse($r->leave_time);
	        }else{
	          $leave_time = null;
	        }

		       
	       $data = [
	          'marked'      => $r->marked,
	          'entry_time'  => $entry_time,
	          'leave_time'  => $leave_time
	       ];

        $attendence = Teacher_Staff_Attendence::whereHas('teacherstaff',function($q) use($uuid, $reg_no){
                                               $q->where('uuid',$uuid)
                                                ->where('reg_no',$reg_no);
                                              })->where('id',$id)->first();
        //return $attendence;
        $attendence->update($data);
        flash()->success('Successfully attendence updated'); 
        return back();
    }

    public function teacher_staff_attendence_delte($uuid = null, $reg_no = null, $id = null)
    {
       $attendence = Teacher_Staff_Attendence::whereHas('teacherstaff',function($q) use($uuid, $reg_no){
                                               $q->where('uuid',$uuid)
                                                ->where('reg_no',$reg_no);
                                              })->where('id',$id)->first();
        //return $attendence;
        $attendence->delete();

        flash()->success('Successfully attendence deleted!'); 

        return back();
    }
}
