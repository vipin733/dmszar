<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\TeacherLeave;
use App\Teacher;
use App\Asession;
use Auth;

class TeacherStaffLeaveController extends Controller
{
     public function apply_leave_get()
    {
        $user = Auth::user();

        $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first(); 
          
         if (!$activesessionid) {

             if ($user->isStaff()) {

                flash()->warning('No session Active, please active current session first!');

               // return redirect()->to('');
                return redirect('/acadmic/asessions/create');
                 # code...
             }
               

               flash()->warning('No session Active, please contact to your institution admin!');

               // return redirect()->to('');
                return back();

          }  

        $teacherleaves = TeacherLeave::where('teacher_id',Auth::id())->with('actiontakenby')->latest()->paginate(10);

    	return view('teacher_staff.apply_leave_get',compact('teacherleaves'));
    }

     public function apply_leave_post(Request $request)
    {
    	$this->validate($request,[
            'leave_type'         =>       'required|boolean',
            'leave_start'        =>       'required_if:leave_type,1',
            'leave_end'          =>       'required_if:leave_type,1',
            'leave_time_start'   =>       'required_if:leave_type,0',
            'leave_time_end'     =>       'required_if:leave_type,0',
            'reason'             =>       'required',
        ]);

        $leavetype      = $request->leave_type;
        $leavetimestart = $request->leave_time_start;
        $leavetimeend   = $request->leave_time_end;
        $leavestart     = $request->leave_start;
        $leaveend       = $request->leave_end;

        if ($leavetype == 1) {
        	
        	if ( $leavetimestart && $leavetimeend) {

        		flash('You can not select leave time and rejoin time, if u selected leave type as Full Day')->error();
        		return back()->withInput($request->input());
        	}else{ 
            $leave_start  = Carbon::createFromFormat('d/m/Y',$leavestart);
            $leave_end = Carbon::createFromFormat('d/m/Y',$leaveend);
        	$leave_time_start  = null;     	
            $leave_time_end = null;
        	}
        }elseif($leavetype == 0){

           if ( $leavestart && $leaveend) {

        		flash('You can not select leave date and rejoin date, if u selected leave type as Half Day.')->error();
        		return back()->withInput($request->input());
        	}else{
              $leave_time_start  = Carbon::parse($leavetimestart);
    	      $leave_time_end = Carbon::parse($leavetimeend);
    	      $leave_start  = null;
    	      $leave_end = null;
        	}
        }

        $user = Auth::user();

        $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first(); 

        $data = [       
         'leave_type'            => $request->leave_type,
         'leave_start'           => $leave_start,
         'leave_end'             => $leave_end,
         'leave_time_start'      => $leave_time_start,
         'leave_time_end'        => $leave_time_end,
         'reason'                => $request->reason,
         'asession_id'           => $activesessionid->id,
         'status'                => 1
        ];

        $user->teacherleaves()->create($data);

        flash()->success('Successfully Form Submitted'); 

        return back();
    	
    }

    public function applied_leave_get(Request $request)
    {
       $userID = Auth::user()->owner->id;
                                  
      $teacherleaves = TeacherLeave::filter($request)->with('actiontakenby','teachers','asessions')->latest()->paginate(15);

      $teachers = Teacher::where('user_id',$userID)->pluck('name','id');

      return view('teacher_staff.applied_leaves.applied_leaves',compact('teacherleaves','teachers','activesessionid'));
    }

     public function applied_leave_details($applied_leave = null)
    {
       $userID = Auth::user()->owner->id;

      $teacherleave = TeacherLeave::where('id',$applied_leave)
                                     ->whereHas('teachers',function($q) use($userID){
                                        $q->where('user_id',$userID);
                                     })->with('actiontakenby','teachers','asessions')->first();

      return view('teacher_staff.applied_leaves.applied_leaves_view',compact('teacherleave','teachers','activesessionid'));
    }

    public function applied_leave_update(Request $request, $applied_leave = null)
    {

        $this->validate($request,[
            'status'            =>       'required|integer',
        ]);

        $data =  [

        'status'          => $request->status,
        'action_taken_by' => Auth::id()
        ];

       $userID = Auth::user()->owner->id;

       $teacherleave = TeacherLeave::where('id',$applied_leave)
                                     ->whereHas('teachers',function($q) use($userID){
                                        $q->where('user_id',$userID);
                                     })->first();
      $teacherleave->update($data); 

      flash()->success('Successfully Form Submitted'); 

        return back();
    }
}

