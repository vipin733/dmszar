<?php

namespace App\Http\Controllers\Staff\Acadmic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Staff\Acadmic\TimeTable;
use App\Model\Staff\Acadmic\LunchTime;
use App\Http\Requests\TimeTabelRequest;
use App\Model\Day;
use Carbon\Carbon;
use App\Course;
use App\Section;
use App\Asession;
use App\Subject;
use App\Teacher;
use Auth;
use PDF;
use DB;

class MakeTimeTableController extends Controller
{
     public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);           
    }

    public function get_class_section()
    {
    	$userID  = Auth::user()->owner->id;

      $courses = Course::where('user_id',$userID)->with('sections')->get();

      $sections = Section::where('user_id',$userID)->count();

      $activesession = Asession::where('user_id',$userID)
                                        ->where('active',1)
                                        ->select('name','id')
                                        ->first(); 
       if (!$activesession) {
                      
              flash()->warning('No session Active, please active current session first!');

             // return redirect()->to('');
              return redirect('/acadmic/asessions/create');

          }
        
      $lunchtime = LunchTime::where('asession_id',$activesession->id)->first();

      return view('staff.acadmic.time_table.get_class_section',compact('courses','sections','lunchtime'));
    }

      public function school_break_store(Request $r)
    {
        $this->validate($r, [
        'start'            =>      "required|date_format:g:i A",
        'end'              =>      "required|date_format:g:i A",
        //'weekly_off_day'   =>      "required|integer"
       ]);

       $user  = Auth::user()->owner;

       $activesession = Asession::where('user_id',$user->id)
                                        ->where('active',1)
                                        ->select('id')
                                        ->first();
       $data = [

          'start'                => $r->start,
          'end'                  => $r->end,
          'asession_id'          => $activesession->id,
          //'day_id'               => $r->weekly_off_day,

       ];

      $user->lunchtimes()->create($data);    

      flash()->success('Successfully Submited!');

      return back();                              

    }


      public function school_break_update(Request $r, $luchtime = null)
    {
       $this->validate($r, [
        'start'            =>      "required|date_format:g:i A",
        'end'              =>      "required|date_format:g:i A",
       // 'weekly_off_day'   =>      "required|integer"
       ]);

       $userID  = Auth::user()->owner->id;

       $activesession = Asession::where('user_id',$userID)
                                        ->where('active',1)
                                        ->select('id')
                                        ->first();
        $lunchtime = LunchTime::where('id',$luchtime)->where('asession_id',$activesession->id)->first();                               
       $data = [

          'start'                => $r->start,
          'end'                  => $r->end,
          'asession_id'          => $activesession->id,
          //'day_id'               => $r->weekly_off_day,

       ];

      $lunchtime->update($r->all());    

      flash()->success('Successfully Update!');

      return back();             
    }

    public function get_teacher_subject_ajax($subject=null)
    {
        $userID = Auth::user()->owner->id;

        $teachers = Teacher::where('user_id',$userID)->whereHas('subjects',function($q) use($subject,$userID){
                                $q->where('id',$subject)
                                ->where('user_id',$userID);
                                  })->pluck('name','id');

        return json_encode($teachers);  
    }

    public function make_timetable($course = null, $created_at= null,$section = null, $screated_at= null)
    {
    	    $cdate=Carbon::createFromTimeStamp($created_at);

          $sdate=Carbon::createFromTimeStamp($screated_at);

          $userID  = Auth::user()->owner->id;

          $course = Course::where('user_id',$userID)
                          ->where('id',$course)
                          ->where('created_at',$cdate)
                          ->with('subjects')
                          ->first();

          $section = Section::where('user_id',$userID)
                          ->where('id',$section)
                          ->where('created_at',$sdate)
                          ->first();

          $activesession = Asession::where('user_id',$userID)
                                        ->where('active',1)
                                        ->select('name','id')
                                        ->first();                 

          $lunchtime = LunchTime::where('asession_id',$activesession->id)->first();                

          // $days = Day::wheredoesnothave('weeklyoff',function($q) use($lunchtime){
          //                         $q->where('day_id',)
          //                  })->select('name','id')->get();

          $days = Day::select('name','id')->get();

                             

        $timetables = TimeTable::where(function($q) use($userID, $course,$section,$activesession){
                                      $q->where('user_id',$userID)
                                         ->where('course_id',$course->id)
                                         ->where('section_id',$section->id)
                                         ->where('asession_id',$activesession->id);
                                   })->with('sundaysubjects','sundayteachers','mondaysubjects','mondayteachers','tuesdaysubjects','tuesdayteachers','wednesdaysubjects','wednesdayteachers','thursdaysubjects','thursdayteachers','fridaysubjects','fridayteachers','saturdaysubjects','saturdayteachers','courses','sections')->orderBy(DB::raw('TIME(start)'))->get();   
         
       
       
         
        //return $timetables;                                                

         return view('staff.acadmic.time_table.get_time_table_form',compact('course','section','days','activesession','timetables','lunchtime'));                
    }

    public function make_timetable_store(TimeTabelRequest $form)
    {

       $form->storing();

        return back();

    }

    public function timetable_destroy($time_table=null)
    {
        $timetable = TimeTable::where('user_id',Auth::user()->owner->id)
                               ->where('id',$time_table)
                                ->first();
                

        $timetable->delete();      

        flash()->success('Successfully deleted!');

        return back();                        
    }

    public function print_timetable($course = null, $created_at= null,$section = null, $screated_at= null)
    {
         $cdate=Carbon::createFromTimeStamp($created_at);

          $sdate=Carbon::createFromTimeStamp($screated_at);

          $userID  = Auth::user()->owner->id;

          $course = Course::where('user_id',$userID)
                          ->where('id',$course)
                          ->where('created_at',$cdate)
                          ->with('subjects')
                          ->first();

          $section = Section::where('user_id',$userID)
                          ->where('id',$section)
                          ->where('created_at',$sdate)
                          ->first();

          $days = Day::select('name')->get();
      

          $activesession = Asession::where('user_id',$userID)
                                        ->where('active',1)
                                        ->select('name','id')
                                        ->first(); 
             $lunchtime = LunchTime::where('asession_id',$activesession->id)->first();

           $timetables = TimeTable::where(function($q) use($userID, $course,$section,$activesession){
                                      $q->where('user_id',$userID)
                                         ->where('course_id',$course->id)
                                         ->where('section_id',$section->id)
                                         ->where('asession_id',$activesession->id);
                                   })->with('sundaysubjects','sundayteachers','mondaysubjects','mondayteachers','tuesdaysubjects','tuesdayteachers','wednesdaysubjects','wednesdayteachers','thursdaysubjects','thursdayteachers','fridaysubjects','fridayteachers','saturdaysubjects','saturdayteachers','courses','sections')->orderBy(DB::raw('TIME(start)'))->get();

          $pdf=PDF::loadView('staff.acadmic.time_table.print.print_timetable',compact('timetables','activesession','course','section','days','lunchtime'))->setOrientation('landscape')->setOption('margin-bottom', 0)->setOption('margin-left', 0)->setOption('margin-right', 0);

          return $pdf->stream($course->name.'-'.$section->name.'-time-table-'. $activesession->name .'.' .'pdf');

    }
}
