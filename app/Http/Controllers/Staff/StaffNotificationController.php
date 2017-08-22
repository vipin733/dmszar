<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\NotificationCreated;
use App\Notification;
use App\Student;
use App\Teacher;
use Auth;

class StaffNotificationController extends Controller
{

      public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs'])->except('notification_index','notification_show');           
    }

   public function notification_form()
    { 
        $user = Auth::user();
        
        return view('staff.notification_message.notification',compact('user'));
    }

    public function notification_form_post(Request $r)
    { 
       $this->validate($r,[

            'title'                             =>      'required',
            'category'                          =>      'required|integer',
            'notification_body'                 =>      'required'
        ]);
    
       $data = 
       [
          'title'                                => $r->title,
          'slug'                                 => str_slug($r->title, "-"),
          'notification_category_id'             => $r->category,
          'notification_body'                    => $r->notification_body
       ];

       $user = Auth::user();

       $user->owner->notifications()->create($data);

       $students = Student::where('user_id',$user->owner->id)
                            ->where('active',1)
                            ->select('emer_no')
                            ->get();
        
       $teachers = Teacher::where('user_id',$user->owner->id)
                            ->where('active',1)
                            ->select('mob_no')
                            ->get();

          foreach ($students as $key => $value) {
                $student_mob[] = $value->emer_no;                                 
          }

        foreach ($teachers as $key => $value) {
                $teacher_mob[] = $value->mob_no;                                 
          } 


        $numbers = array_collapse([$student_mob,$teacher_mob]);

        $school     = $user->owner->schoolprofile->school_name;


        $title = $r->title;

        event(new NotificationCreated($numbers,$school,$title));

       flash()->success('Successfully Notification Form Submited'); 

       return back();

    }

    
      public function notification_index(Request $request)
    { 
        $user = Auth::user();

        $notifications = Notification::filter($request)->where('user_id',$user->owner->id)
                                       ->with('notifications_categories')->latest()->get();
        
        return view('staff.notification_message.notification_index',compact('user','notifications'));
    }

     public function notification_show($not = null, $slug = null)
    { 
        $user = Auth::user();

        $notification = Notification::where('id',$not)
                                    ->where('slug',$slug)
                                    ->where('user_id',$user->owner->id)
                                    ->with('notifications_categories')
                                    ->first();
        
        return view('staff.notification_message.notification_show',compact('user','notification'));
    }

     public function notification_edit_form($not = null, $slug = null)
    { 
        $user = Auth::user();

        $notification = Notification::where('id',$not)
                                    ->where('slug',$slug)
                                    ->where('user_id',$user->owner->id)
                                    ->with('notifications_categories')
                                    ->first();
        
        return view('staff.notification_message.notification_edit',compact('user','notification'));
    }


    public function notification_update_form(Request $r, $not = null)
    { 
       $this->validate($r,[

            'title'                             =>      'required',
            'category'                          =>      'required|integer',
            'notification_body'                 =>      'required'
        ]);
    
       $data = 
       [
          'title'                                => $r->title,
          'slug'                                 => str_slug($r->title, "-"),
          'notification_category_id'             => $r->category,
          'notification_body'                    => $r->notification_body
       ];
       
      $user = Auth::user();

       $notification = Notification::where('id',$not)->where('user_id',$user->owner->id)->first();

       $notification->update($data);

       flash()->success('Successfully Notification Updated'); 

       return back();

    }

}
