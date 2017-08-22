<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Staff\Fee\RegistraionFee;
use App\Course;
use App\Asession;
use Carbon\Carbon;
use Auth;

class RegistrationFeeController extends Controller
{
    public function __construct()
    {

      $this->middleware(['auth:teacher','active','staffs']); 
         
    }

     public function registraion_fee_get()
   {

   	  $userId = Auth::user()->owner->id;

      $activesessionid = Asession::where('user_id', $userId)
                                        ->where('active',1)
                                        ->select('id','name')
                                         ->first();
       if (!$activesessionid) {
                      
              flash()->warning('No session Active, please active current session first!');

             // return redirect()->to('');
              return redirect('/acadmic/asessions/create');

          }                                    

      $registraionfees  = RegistraionFee::with('courses')
                                ->with('asessions')
                                ->where('asession_id',$activesessionid->id)
                                ->whereHas('courses',function($q) use($userId){
                               $q->where('user_id',$userId);
                              })->latest()->get();

      return view('staff.registraion_fee.registraion_fee_structure',compact('registraionfees','activesessionid'));
   }


   public function registraion_fee_post(Request $r)
   {


      $userId = Auth::user()->owner->id;


      $activesessionid = Asession::where('user_id', $userId)
                                        ->where('active',1)
                                        ->select('id')
                                         ->first();
      if (!$activesessionid) {
                      
              flash()->warning('No session Active, please active current session first!');

             // return redirect()->to('');
              return redirect('/acadmic/asessions/create');

          }                                    

      $this->validate($r,[

            'course' => 'required|integer|unique:registraion_fees,course_id,NULL,NULL,asession_id, ' . $activesessionid->id,
            'fee_details'        => 'required',
            'registraion_fee'    => 'required|numeric',
            'late_fee'           => 'nullable|numeric',
            'remarks'            => 'nullable'

         ]);

      $data = [
     
       'asession_id'          => $activesessionid->id,
       'fee_details'          => $r->fee_details,
       'registraion_fee'      => $r->registraion_fee,
       'late_fee'             => $r->late_fee,
       'remarks'              => $r->remarks

      ];
     
     $course = Course::where('id',$r->course)->where('user_id',$userId)->first();

      $course->registraionfee()->create($data);

      flash()->success('Successfully Submited');

       return back();

   }

   public function registraion_fee_update(Request $request,$registraion_fee = null, $created_at = null)
   {
   	  $userId = Auth::user()->owner->id;
       $date  = Carbon::createFromTimeStamp($created_at);
      $registraionfee = RegistraionFee::where('id',$registraion_fee)
                          ->where('created_at',$date)
                          ->whereHas('courses',function($q) use($userId){
                               $q->where('user_id',$userId);
                              })->first();

      $this->validate($request,[

             'course'             => 'required|integer',
            'fee_details'         =>  'required',
            'registraion_fee'     =>  'required|numeric',
            'late_fee'            =>  'nullable|numeric',
            'remarks'             =>  'nullable'

         ]);

     
      $registraionfee->update($request->all());

       flash()->success('Successfully Updated');

       return back();

   }

   public function registraion_fee_delete($registraion_fee = null, $created_at = null)
   {
       
       $userId = Auth::user()->owner->id;

       $date=Carbon::createFromTimeStamp($created_at);
       
       $registraion_fee = RegistraionFee::where('id',$registraion_fee)
                          ->where('created_at',$date)
                          ->whereHas('courses',function($q) use($userId){
                               $q->where('user_id',$userId);
                              })->first();
      

        $registraion_fee->delete();

        flash()->success('Successfully Registraion Fee Fee Deleted!');

        return back();
   }
}
