<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FeeRequestCategory;
use App\Asession;
use App\FeeRequest;
use App\FeeConfirmation;
use App\StudentAcadmic;
use App\Course;
use App\BankDetail;
use App\AppDetail;
use Auth;


class StudentFeeStuffController extends Controller
{
	public function __construct()
    {
  
        $this->middleware(['auth:student','active']);
            
    }

     public function pay_online()
    {
        $user = Auth::user();
        $bankdetails = BankDetail::where('user_id',$user->owner->id)->with('banknames')->get();
        $appdetails = AppDetail::where('user_id',$user->owner->id)->with('appnames')->get();
        return view('student.fee.pay_online',compact('user','bankdetails','appdetails'));
    }

     public function fee_request()
    {
     
        $feerequestcategories= FeeRequestCategory::pluck('name','id');

        $feerequests = FeeRequest::where('student_id',Auth::id())
                                   ->with('feerequestcategories','action_taken_by')
                                   ->latest()
                                   ->paginate(10);

        return view('student.fee.fee_request',compact('feerequestcategories','feerequests'));
    }

     public function fee_request_save(Request $request)
    {
        
        $this->validate($request,[
            
            'description' => 'required',
            'category'    => 'required|integer'

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

                flash()->warning('No session Active, please contact to your institution admin!');

               // return redirect()->to('');
                return back();

          }                                       

        $feerequestcategory= FeeRequestCategory::where('id',$request->category)->first();

        $data = [
          'fee_request_category_id' => $feerequestcategory->id,
          'asession_id'             => $activesessionid->id,
          'status'                  => 1,
          'description'             => $request->description,
          'ticket_no'               => $string

        ];

        $user->feerequests()->create($data);

        flash()->success('Successfully Fee Request Submited! and Your Ticket no. ' .$string);

        return back();     
    }

     public function online_fee_confirmation()
    {    
       $feeconfirmations = FeeConfirmation::where('student_id',Auth::id())
                                   ->with('banknames','appnames','courses','students.owner.schoolprofile')
                                   ->latest()
                                   ->paginate(10);
        $courses = StudentAcadmic::where('student_id',Auth::id())
                                   ->with('courses')
                                   ->get();
        $banknames = BankDetail::where('user_id',Auth::user()->owner->id)
                                   ->orderBy('bank_id')
                                   ->with('banknames')
                                   ->get(); 
        $appnames = AppDetail::where('user_id',Auth::user()->owner->id)
                              ->orderBy('app_name_id')
                              ->with('appnames')
                              ->get();                                                                                
        return view('student.fee.online_fee_confirmation',compact('feeconfirmations','courses','banknames','appnames'));
    }

     public function online_fee_confirmation_save(Request $request)
    {
        
        $this->validate($request,[
            
            'deposit_date'        => 'required|date_format:d/m/Y',
            'bank_name'           => 'nullable|integer',
            'app_name'            => 'nullable|integer',
            'course'              => 'required|integer',
            'transaction_no'      => 'required',
            'tution_fee'          => 'nullable|numeric',
            'hostel_fee'          => 'nullable|numeric',
            'transport_fee'       => 'nullable|numeric',
            'registration_fee'    => 'nullable|numeric',
            'late_fee'            => 'nullable|numeric',
            'other_fee'           => 'nullable|numeric',

        ]);

        //dd($request->all());

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

        $bankname = BankDetail::where('user_id',$user->owner->id)
                                   ->whereHas('banknames',function($q)use($request){
                                    $q->where('id',$request->bank_name);
                                   })->first();
        if ($bankname) {
                  
                $bankID = $bankname->banknames['id'];
          } else{
                $bankID = null;
          }                          
                                    
        $appname = AppDetail::where('user_id',$user->owner->id)
                                ->whereHas('appnames',function($q)use($request){
                                    $q->where('id',$request->app_name);
                                   })->first();
        if ($appname) {
                  
                $appID = $appname->appnames['id'];
          } else{
                $appID = null;
          }                         

        $course = Course::where('user_id',$user->owner->id)
                                        ->where('id',$request->course)
                                        ->select('id')
                                        ->first();                               

        $data = [
          'ticket_no'               => $string,
          'deposit_date'            => $request->deposit_date,
          'asession_id'             => $activesessionid->id,
          'course_id'               => $course->id,
          'status'                  => 0,
          'description'             => $request->description,
          'bank_name_id'            => $bankID,
          'app_name_id'             => $appID,
          'transaction_no'          => $request->transaction_no,
          'tution_fee'              => $request->tution_fee,
          'hostel_fee'              => $request->hostel_fee,
          'transport_fee'           => $request->transport_fee,
          'registration_fee'        => $request->registration_fee,
          'late_fee'                => $request->late_fee,
          'other_fee'               => $request->other_fee,
          'remarks'                 => $request->remarks

        ];

        $user->feeconfirmations()->create($data);

        flash()->success('Successfully Fee Confirmation Request Submited! and Your Ticket no. ' .$string);

        return back();     
    }
}
