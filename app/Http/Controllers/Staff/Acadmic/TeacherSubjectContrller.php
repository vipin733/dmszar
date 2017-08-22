<?php

namespace App\Http\Controllers\Staff\Acadmic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\Subject;
use Auth;

class TeacherSubjectContrller extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }

    public function teacher_subject_get()
    {
    	 $userID = Auth::user()->owner->id;
    	 $subjects = Subject::where('user_id', $userID)->pluck('name','id');
    	 $teachers = Teacher::where('type',0)->where('user_id', $userID)->pluck('name','id');

	    $teacherssubject = Teacher::where('user_id', $userID)->has('subjects')->with('subjects')->get();

	    ///staff/teacher_teaching_courses_sections_subject/attach

    	return view('staff.attachment.subject_teacher',compact('subjects','teachers','teacherssubject'));
    }

    public function teacher_subject_post(Request $request)
    {
    	 
            $subject = $request->subject;
            $teacher  =  $request->teacher;
	  
	        $userID = Auth::user()->owner->id;

	       $this->validate($request, [
	        'subject' => 'required|unique:subject_teacher,subject_id,NULL,NULL,teacher_id, ' . $teacher,
	        'teacher' => 'required|unique:subject_teacher,teacher_id,NULL,NULL,subject_id, ' .  $subject,
	    ]);

	      
	      $subjecta = Subject::where('id',$subject)->where('user_id', $userID)->first();
	      $teachera = Teacher::where('id',$teacher)->where('user_id', $userID)->first();
	      
	      $subjecta->teachers()->attach($teachera);

	      flash()->success('Successfully ' .$subjecta->name. ' Added to teacher '. $teachera->name);

	       return back();
    }

    public function teacher_subject_delete($subject = null, $teacher = null)
    {
    	 $userID = Auth::user()->owner->id;
    	  $subjecta = Subject::where('id',$subject)->where('user_id', $userID)->first();
	      $teachera = Teacher::where('id',$teacher)->where('user_id', $userID)->first();
	      
	      $subjecta->teachers()->detach($teachera);

	      flash()->success('Successfully ' .$subjecta->name. ' deleted from teacher '. $teachera->name);

	       return back();
    }
}
