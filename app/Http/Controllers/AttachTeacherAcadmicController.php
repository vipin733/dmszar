<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Student;
use App\Teacher;
use App\Course;
use App\Subject;
use App\Section;
use App\TeacherAcadmic;
use App\Asession;
use App\TeacherTeachingAcadmic;


class AttachTeacherAcadmicController extends Controller
{
	  public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }



    public function teacher_teaching_courses_sections_subject_get()
   {
     $userId = Auth::user()->owner->id;

     $teachers = Teacher::where('user_id',$userId)->doesntHave('teacheracadmic')
                        ->where('type',0)
                        ->where('active',1)
                        ->select('id','name')
                        ->get();

      $activesessionid = Asession::where('user_id',$userId)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();

       if (!$activesessionid) {
                      
              flash()->warning('No session Active, please active current session first!');

             // return redirect()->to('');
              return redirect('/acadmic/asessions/create');

          }                                  

      $teacherteachingacadmics = TeacherTeachingAcadmic::where('asession_id',$activesessionid->id)
                                                         ->whereHas('teachers', function($q) use($userId){
                                                          $q->where('user_id',$userId);
                                                         })->with('teachers','courses','sections','subjects')
                                                         ->orderBy('course_id')->get();                                   

     return view('staff.attachment.teacher_teaching_courses_sections_subjects',compact('teachers','teacherteachingacadmics'));
   }

      public function teacher_teaching_courses_sections_subject_post(Request $request)
   {
       
       $this->validate($request, [
        'course'  => 'required|integer',
        'teacher' => 'required|integer',
        'section' => 'required|integer',
        'subject' => 'required|integer'
    ]);
      
      $user = Auth::user();
    
      $teacher = Teacher::where('id',$request->teacher)
                          ->where('user_id',$user->owner->id)
                          ->select('id','name')
                          ->first();
      $course = Course::where('id',$request->course)
                        ->where('user_id',$user->owner->id)
                        ->select('id','name')
                        ->first();
       $section = Section::where('id',$request->section)
                        ->where('user_id',$user->owner->id)
                        ->select('id','name')
                        ->first();
      $subject = Subject::where('id',$request->subject)
                        ->where('user_id',$user->owner->id)
                        ->select('id','name')
                        ->first();

       $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();                  
        $data = [
        
          'asession_id' =>  $activesessionid->id,
          'section_id'  =>  $section->id,
          'course_id'   =>  $course->id,
          'subject_id'   =>  $subject->id 

        ];                               
     
      $teacher->teacherteachingacadmics()->create($data);

      flash()->success('Successfully ' .$course->name. '/' .$section->name . '/' . $subject->name. ' assigned to '. $teacher->name);

      return back();
   }

   public function teacher_teaching_courses_sections_subject_edit($id = null, $uuid = null, $reg_no = null)
    {
        $user = Auth::user();

      $teachers = Teacher::where('user_id',$user->owner->id)
                        ->where('type',0)
                        ->where('active',1)
                        ->select('id','name')
                        ->get();

          $teacherteachingacadmic = TeacherTeachingAcadmic::where('id',$id)
                                   ->whereHas('teachers',function($q) use($uuid, $reg_no,$user){
                                 $q->where('user_id',$user->owner->id)
                                    ->where('uuid',$uuid)
                                    ->where('reg_no',$reg_no);
                                })->with('courses','sections','teachers')->first();
                                                   
      return view('staff.attachment.teacher_teaching_courses_sections_subject_edit',compact('teachers','teacherteachingacadmic'));
    }

      public function teacher_teaching_courses_sections_subject_update(Request $request,$id = null, $uuid = null, $reg_no = null)
   {
       
       $this->validate($request, [
        'course' => 'required|integer',
        'teacher' => 'required|integer',
        'section' => 'required|integer',
        'subject' => 'required|integer'
    ]);
      
      $user = Auth::user();

      $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();
        if (!$activesessionid) {
                      
              flash()->warning('No session Active, please active current session first!');

             // return redirect()->to('');
              return redirect('/acadmic/asessions/create');

          }                                 

       $teacherteachingacadmic = TeacherTeachingAcadmic::where('id',$id)
                                    ->where('asession_id',$activesessionid->id)
                                   ->whereHas('teachers',function($q) use($uuid, $reg_no, $user){
                                 $q->where('user_id',$user->owner->id)
                                    ->where('uuid',$uuid)
                                    ->where('reg_no',$reg_no);
                                })->first();
    
      $teacher = Teacher::where('id',$request->teacher)
                          ->where('user_id',$user->owner->id)
                          ->select('id','name')
                          ->first();
      $course = Course::where('id',$request->course)
                        ->where('user_id',$user->owner->id)
                        ->select('id','name')
                        ->first();
       $section = Section::where('id',$request->section)
                        ->where('user_id',$user->owner->id)
                        ->select('id','name')
                        ->first();
      $subject = Subject::where('id',$request->subject)
                        ->where('user_id',$user->owner->id)
                        ->select('id','name')
                        ->first();

                         
        $data = [
        
          'teacher_id' =>  $teacher->id,
          'section_id'  =>  $section->id,
          'course_id'   =>  $course->id,
          'subject_id'   =>  $subject->id 

        ];                               
      $teacherteachingacadmic->update($data);
      //$teacher->teacherteachingacadmics()->create($data);

      flash()->success('Successfully ' .$course->name. '/' .$section->name . '/' . $subject->name. ' assigned to '. $teacher->name);

      return redirect()->to('/staff/teacher_teaching_courses_sections_subject/attach');
   }


    public function teacher_teaching_courses_sections_subject_delete($id = null, $uuid = null, $reg_no = null)
    {

        $user = Auth::user();


      $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();

      if (!$activesessionid) {
                      
              flash()->warning('No session Active, please active current session first!');

             // return redirect()->to('');
              return redirect('/acadmic/asessions/create');

          }                                

        $teacheracadmic = TeacherTeachingAcadmic::where('id',$id)
                                    ->where('asession_id',$activesessionid->id)
                                   ->whereHas('teachers',function($q) use($uuid, $reg_no, $user){
                                 $q->where('user_id',$user->owner->id)
                                    ->where('uuid',$uuid)
                                    ->where('reg_no',$reg_no);
                                })->first();

        $teacheracadmic->delete();  

        flash()->success('Successfully Deleted!');     

        return back();
    }


    public function course_section_teacher_get()
    {
        $user = Auth::user();

        $coursess = Course::where('user_id',$user->owner->id)
                            ->with('sections')
                            ->pluck('name','id');


      $activesessionid = Asession::where('user_id',$user->owner->id)->where('active',1)->select('id')->first();
       
        if (!$activesessionid) {
                      
              flash()->warning('No session Active, please active current session first!');

             // return redirect()->to('');
              return redirect('/acadmic/asessions/create');

          }    


        $teachers = Teacher::where('user_id',$user->owner->id)
                            ->whereDoesntHave('teacheracadmic', function ($q) use($activesessionid){
                                $q->where('asession_id',$activesessionid->id);
                            })->where('type',0)->where('active',1)->get();                                    

     $teacheracadmics = TeacherAcadmic::where('asession_id',$activesessionid->id)
                                   ->whereHas('teachers',function($q) use($user){
                                  $q->where('user_id',$user->owner->id)
                                    ->where('type',0)
                                    ->where('active',1);
                                })->with('courses','sections','teachers')->latest()->get();
                                                   
      return view('staff.attachment.course_section_teacher',compact('coursess','teachers','teacheracadmics'));
    }


      public function course_section_teacher_ajax($id)
    {
        $user = Auth::user();

        $sections = Section::where('user_id',$user->owner->id)
                            ->whereHas('courses', function($q) use($id){
                              $q->where('id',$id);
                            })->pluck('name','id');

        return json_encode($sections);        
    }

     public function course_section_teacher_post(Request $request)
    {

       $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first(); 
      if (!$activesessionid) {
                      
              flash()->warning('No session Active, please active current session first!');

             // return redirect()->to('');
              return redirect('/acadmic/asessions/create');

          }
          
       $this->validate($request, [
        // 'course' => 'required|unique:teacher_acadmics,course_id,NULL,NULL,section_id, ' . $request['section'],
        // 'section' => 'required|unique:teacher_acadmics,section_id,NULL,NULL,course_id, ' . $request['course'],
        'course' => 'required|integer',
        'section' => 'required|integer',
        'teacher' => 'required|unique:teacher_acadmics,teacher_id,NULL,NULL,asession_id, ' .  $activesessionid->id
    ]);

         
      $user = Auth::user();

      $course = Course::where('id',$request->course)->where('user_id',$user->owner->id)->select('id')->first();
      $section = section::where('id',$request->section)->where('user_id',$user->owner->id)->select('id')->first();

      $teacher = Teacher::where('user_id',$user->owner->id)
                             ->where('type',0)
                             ->where('active',1)                             
                            ->where('id',$request->teacher)
                            ->first(); 

              $data = [
               'course_id'   => $course->id,
               'section_id'  => $section->id,
               'asession_id' => $activesessionid->id
              ];              
      
      
      $teacher->teacheracadmic()->create($data);

      flash()->success('Successfully ' .$teacher->name. ' Assined Class Teacher');

      return back();
    }

       public function course_section_teacher_edit($id = null, $uuid = null, $reg_no = null)
    {
        $user = Auth::user();

        $coursess = Course::where('user_id',$user->owner->id)
                            ->with('sections')
                            ->pluck('name','id');

        $teachers = Teacher::where('user_id',$user->owner->id)
                             ->where('type',0)
                             ->where('active',1)
                            ->get(); 

          $teacheracadmic = TeacherAcadmic::where('id',$id)
                                   ->whereHas('teachers',function($q) use($uuid, $reg_no,$user){
                                 $q->where('user_id',$user->owner->id)
                                    ->where('uuid',$uuid)
                                    ->where('reg_no',$reg_no);
                                })->with('courses','sections','teachers')->first();
                                                   
      return view('staff.attachment.course_section_teacher_edit',compact('coursess','teachers','teacheracadmic'));
    }

  public function course_section_teacher_edit_post(Request $request, $id = null, $uuid = null, $reg_no = null)
    {
         $user = Auth::user();
        $teacheracadmic = TeacherAcadmic::where('id',$id)
                                   ->whereHas('teachers',function($q) use($uuid, $reg_no, $user){
                                 $q->where('user_id',$user->owner->id)
                                    ->where('uuid',$uuid)
                                    ->where('reg_no',$reg_no);
                                })->first();
          
       $this->validate($request, [
        // 'course' => 'required|unique:teacher_acadmics,course_id,NULL,NULL,section_id, ' . $request['section'],
        // 'section' => 'required|unique:teacher_acadmics,section_id,NULL,NULL,course_id, ' . $request['course'],
        'course' => 'required|integer',
        'section' => 'required|integer',
        'teacher' => 'required|unique:teacher_acadmics,teacher_id,NULL,NULL,asession_id, ' .  $teacheracadmic->id
        //'teacher' => 'required|unique:teacher_acadmics,teacher_id,'.$teacheracadmic->id
    ]);

        

      $course = Course::where('id',$request->course)->where('user_id',$user->owner->id)->select('id')->first();
      $section = section::where('id',$request->section)->where('user_id',$user->owner->id)->select('id')->first();

              $data = [
               'course_id' => $course->id,
               'section_id' => $section->id
              ];               
      
      
      $teacheracadmic->update($data);

      flash()->success('Successfully ' .$teacheracadmic->teachers->name. ' Assined Class Teacher');
      return redirect()->to('/staff/course_section_teacher/attach');
      //return back();
    }

    public function course_section_teacher_delete($id = null, $uuid = null, $reg_no = null)
    {

        $user = Auth::user();
        $teacheracadmic = TeacherAcadmic::where('id',$id)
                                   ->whereHas('teachers',function($q) use($uuid, $reg_no, $user){
                                 $q->where('user_id',$user->owner->id)
                                    ->where('uuid',$uuid)
                                    ->where('reg_no',$reg_no);
                                })->first();

        $teacheracadmic->delete();  

        flash()->success('Successfully Deleted!');     

        return back();
    }

}
