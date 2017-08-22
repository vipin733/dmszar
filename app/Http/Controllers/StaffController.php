<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Course;
use App\Subject;
use App\Section;


class StaffController extends Controller
{
     
      public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }
  

     public function course_section_get()
    {
        $coursess = Course::where('user_id',Auth::user()->owner->id)
                            ->with('sections')
                            ->get();

      return view('staff.attachment.course_section',compact('coursess'));
    }

     public function course_section_post(Request $request)
    {
          $courses  =  $request->course;
          $sections = $request->section;
  
         $user = Auth::user();

       $this->validate($request, [
        'course' => 'required|unique:course_section,course_id,NULL,NULL,section_id, ' . $request['section'],
        'section' => 'required|unique:course_section,section_id,NULL,NULL,course_id, ' . $request['course'],
    ]);

      $course = Course::where('id',$courses)->where('user_id',$user->owner->id)->first();
      $section = Section::where('id',$sections)->where('user_id',$user->owner->id)->first();
      
      $course->sections()->attach($section);

      flash()->success('Successfully ' .$section->name. ' Added to class '. $course->name);

       return back();
    }

     
     public function course_subject_get()
   {
     $user = Auth::user();
     $coursesss = Course::where('user_id',$user->owner->id)
                        ->with('subjects')
                        ->get();

     return view('staff.attachment.course_subject',compact('coursesss'));
   }

      public function course_subject_post(Request $request)
   {
       $user = Auth::user();

       $this->validate($request, [
        'course' => 'required|unique:course_subject,course_id,NULL,NULL,subject_id, ' . $request['subject'],
        'subject' => 'required|unique:course_subject,subject_id,NULL,NULL,course_id, ' . $request['course'],
    ]);

      $course = Course::where('id',$request->course)->where('user_id',$user->owner->id)->first();
      $subject = Subject::where('id',$request->subject)->where('user_id',$user->owner->id)->first();

      $course->subjects()->attach($subject);

      flash()->success('Successfully ' .$subject->name. ' Added in Course '. $course->name);

      return back();
   }

   
}
