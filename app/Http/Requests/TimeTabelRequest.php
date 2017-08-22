<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\Staff\Acadmic\TimeTable;
use App\Model\Day;
use Carbon\Carbon;
use App\Course;
use App\Section;
use App\Asession;
use App\Subject;
use App\Teacher;
use Auth;
use DB;


class TimeTabelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           // 'break_start'      =>      "required|date_format:h:i A",
            // 'break_end'        =>      "required|date_format:h:i A",
            'start'            =>      "required|date_format:g:i A",
            'end'              =>      "required|date_format:g:i A",
            'sunday_subject'   =>      "nullable|integer",
            'sunday_teacher'   =>      "nullable|integer",
            'monday_subject'   =>      "nullable|integer",
            'monday_teacher'   =>      "nullable|integer",
            'tuesday_subject'  =>      "nullable|integer",
            'tuesday_teacher'  =>      "nullable|integer",
            'wednesday_subject'=>      "nullable|integer",
            'wednesday_teacher'=>      "nullable|integer",
            'thursday_subject' =>      "nullable|integer",
            'thursday_teacher' =>      "nullable|integer",
            'friday_subject'   =>      "nullable|integer",
            'friday_teacher'   =>      "nullable|integer",
            'saturday_subject' =>      "nullable|integer",
            'saturday_teacher' =>      "nullable|integer",
        ];
    }

    public function storing()
    {
          
        $cdate=Carbon::createFromTimeStamp($this->created_at);

        $sdate=Carbon::createFromTimeStamp($this->screated_at);

        $userID  = Auth::user()->owner->id;

        $course  = $this->course;
        $section = $this->section;

        $activesessionid = Asession::where('user_id',$userID)->where('active',1)->select('id')->first();

        $courseid = Course::where(function($q) use($userID,$course,$cdate){
                              $q->where('user_id',$userID)
                                ->where('id',$course)
                               ->where('created_at',$cdate);        
                          })->select('id')->first();

        $sectionid = Section::where(function($q) use($userID,$section,$sdate){
                              $q->where('user_id',$userID)
                                ->where('id',$section)
                               ->where('created_at',$sdate);         
                          })->select('id')->first();

         //$days = Day::get();

        // foreach ($days as $key => $value)
        //  { 
           $data = [
            // 'break_start'          => $request->break_start,
            // 'break_end'            => $request->break_end,
            'start'                => $this->start,
            'end'                  => $this->end,
            'sunday_subject_id'    => $this->sunday_subject,
            'sunday_teacher_id'    => $this->sunday_teacher,
            'monday_subject_id'    => $this->monday_subject,
            'monday_teacher_id'    => $this->monday_teacher,
            'tuesday_subject_id'   => $this->tuesday_subject,
            'tuesday_teacher_id'   => $this->tuesday_teacher,
            'wednesday_subject_id' => $this->wednesday_subject,
            'wednesday_teacher_id' => $this->wednesday_teacher,
            'thursday_subject_id'  => $this->thursday_subject,
            'thursday_teacher_id'  => $this->thursday_teacher,
            'friday_subject_id'    => $this->friday_subject,
            'friday_teacher_id'    => $this->friday_teacher,
            'saturday_subject_id'  => $this->saturday_subject,
            'saturday_teacher_id'  => $this->saturday_teacher,
            'sunday_remarks'       => $this->sunday_remarks,
            'monday_remarks'       => $this->monday_remarks,
            'tuesday_remarks'      => $this->tuesday_remarks,
            'wednesday_remarks'    => $this->wednesday_remarks,
            'thursday_remarks'     => $this->thursday_remarks,
            'friday_remarks'       => $this->friday_remarks,
            'saturday_remarks'     => $this->saturday_remarks,
            'asession_id'          => $activesessionid->id,
            'section_id'           => $sectionid->id,
            'course_id'            => $courseid->id            
           ];

           //$value->timetables()->create($data);
           Auth::user()->owner->timetables()->create($data);

         //}  

        flash()->success('Successfully Class Time Generated'); 
    }
}

