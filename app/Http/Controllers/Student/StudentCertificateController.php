<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ExamMark;
use App\Asession;
use App\Course;
use App\MarkSheetRequest;
use App\CCategory;
use App\CCRequest;
use Auth;

class StudentCertificateController extends Controller
{

     public function __construct()
    {
      
        $this->middleware(['auth:student','active']);
            
    }

    public function marks_sheet()
    {

        $courses = ExamMark::selectRaw('course_id')
                     ->orderBy('course_id')
                     ->groupBy('course_id')
                     ->where('student_id',Auth::id())
                     ->with('courses')
                     ->get();
        $marksheetrequests=MarkSheetRequest::where('student_id',Auth::id())
                                                  ->with('courses','updated_by')
                                                  ->latest()
                                                  ->paginate(10);        

        return view('student.certificate.marks_sheet',compact('courses','marksheetrequests'));
    }

     public function marks_sheet_save(Request $request)
    {
       $this->validate($request,[
            'course'        =>      'required|integer'
        ]);

       $user = Auth::user();

        $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $numbers = rand(10000000, 99999999);
        $prefix = "GRA";
        $sufix = $letters[rand(0, 25)];
        $sufix1 = $letters[rand(0, 25)];
        $string = $prefix . $numbers . $sufix.$sufix1;

        $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                        ->first(); 

        if (!$activesessionid) {

                flash()->warning('No session Active, please active current session first!');

               // return redirect()->to('');
                return back();
                                           
          }                                 

        $course= Course::where('user_id',$user->owner->id)
                                  ->where('id',$request->course)
                                  ->select('id')
                                  ->first();

        $data = [
          'course_id'               => $course->id,
          'asession_id'             => $activesessionid->id,
          'status'                  => 0,
          'description'             => $request->description,
          'ticket_no'               => $string

        ];

        $user->marksheetrequests()->create($data);

        flash()->success('Successfully Mark Sheet Request Submited! and Your Ticket no. ' .$string);

        return back(); 
    }

    public function certificate_request()
    {      
         $ccategories = CCategory::where('user_id',Auth::user()->owner->id)
                                  ->get();
         $ccrequests  = CCRequest::where('student_id',Auth::id())
                                   ->with('certificatecategories','updated_by')
                                   ->latest()
                                   ->paginate(10);                       
        return view('student.certificate.certificate_request',compact('ccategories','ccrequests'));
    }

     public function certificate_request_save(Request $request)
    {      
         $this->validate($request,[
            'category'        =>      'required|integer'
        ]);

       $user = Auth::user();

        $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $numbers = rand(10000000, 99999999);
        $prefix = "GRA";
        $sufix = $letters[rand(0, 25)];
        $sufix1 = $letters[rand(0, 25)];
        $string = $prefix . $numbers . $sufix.$sufix1;

        $activesessionid = Asession::where('user_id',$user->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                        ->first(); 

        if (!$activesessionid) {

                flash()->warning('No session Active, please active current session first!');

               // return redirect()->to('');
                return back();
                                           
          }                                 

        $ccategory= CCategory::where('user_id',$user->owner->id)
                                  ->where('id',$request->category)
                                  ->select('id')
                                  ->first();

        $data = [
          'certificate_category_id' => $ccategory->id,
          'asession_id'             => $activesessionid->id,
          'status'                  => 0,
          'fee_status'              => 0,
          'description'             => $request->description,
          'ticket_no'               => $string

        ];

        $user->ccrequests()->create($data);

        flash()->success('Successfully Certificate Request Submited! and Your Ticket no. ' .$string);

        return back(); 
    }

}
