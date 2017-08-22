<?php

namespace App\Http\Controllers\Staff\StaffTeacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\MessageCreatedStudentSingle;
use App\Model\Staff\Acadmic\TimeTable;
use App\TeacherAcadmic;
use App\TeacherLeave;
use App\LogRequest;
use App\Teacher;
use Auth;

class StaffTeacherProfileViewController extends Controller
{
	   public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }

      public function applied_leave_by_teacher_staff(Request $request, $reg_no = null)
    {
        $userID = Auth::user()->owner->id;

        $teacher = Teacher::where('reg_no',$reg_no)->where('user_id',$userID)->first();

        $teacherleaves = TeacherLeave::TeacherStaffFilter($request)->where('teacher_id',$teacher->id)
                                   ->with('actiontakenby','teachers','asessions')
                                   ->latest()->paginate(10);

      return view('staff.teachers_staff.profile.leave.applied_leaves',compact('teacherleaves','teacher'));
    }

      public function log_request_by_teacher_staff(Request $request, $reg_no = null)
    {
        $userID = Auth::user()->owner->id;

        $teacher = Teacher::where('reg_no',$reg_no)->where('user_id',$userID)->first();

       $logrequests = LogRequest::Filter($request)->where('teacher_id',$teacher->id)
                                    ->with('action_taker','logrequestcategories','asessions')
                                    ->latest()->paginate(10);

      return view('staff.teachers_staff.profile.log.log_requests',compact('logrequests','teacher'));
    }

      public function send_message(Request $r, $reg_no = null)
    {
      
        $this->validate($r, [
        'message'   => 'required'
       ]);

        $message        = $r->message;
        $user = Auth::user();       
        $teacher = Teacher::where('user_id',$user->owner->id)->where('reg_no',$reg_no)->select('id','mob_no')->first();
      
       $data = [
                             
                'student_id'    => null,
                'teacher_id'    => $teacher->id,
                'by_owner_id'   => null,
                'by_teacher_id' => Auth::id(),
                'message'       => $message

            ];
      
        $numbers        = $teacher->mob_no;
        $user->owner->messages()->create($data); 
        event(new MessageCreatedStudentSingle($message,$numbers)); 
        flash()->success('Successfully Message Send'); 
        return back();   
    }

    
}
