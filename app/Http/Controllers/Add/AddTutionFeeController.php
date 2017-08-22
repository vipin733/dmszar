<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TutionFee;
use App\Course;
use App\Asession;
use Carbon\Carbon;
use Auth;

class AddTutionFeeController extends Controller
{
    public function __construct()
    {

      $this->middleware(['auth:teacher','active','staffs']); 
         
    }

    public function tution_fee_get()
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

      $tutionfees  = TutionFee::with('courses')
                                ->with('asessions')
                                ->where('asession_id',$activesessionid->id)
                                ->whereHas('courses',function($q) use($userId){
                               $q->where('user_id',$userId);
                              })->latest()->get();

      return view('staff.tution_fee.tution_fee_structure',compact('tutionfees','activesessionid'));
   }


   public function tution_fee_post(Request $r)
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

            'course' => 'required|integer|unique:tution_fees,course_id,NULL,NULL,asession_id, ' . $activesessionid->id,
            'tution_fee'=>        'required|numeric',
            'late_fee'=>          'nullable|numeric',
            'other_fee'=>         'nullable|numeric',
            'remarks'   =>        'nullable'

         ]);

      $data = [
     
       'asession_id'     => $activesessionid->id,
       'tution_fee'      => $r->tution_fee,
       'late_fee'        => $r->late_fee,
       'other_fee'       => $r->other_fee,
       'remarks'         => $r->remarks

      ];
     
     $course = Course::where('id',$r->course)->where('user_id',$userId)->first();

      $course->tutionfee()->create($data);

      flash()->success('Successfully Submited');
       return back();

   }

   public function tution_fee_edit($tution_fee = null, $created_at = null)
   {
   	  $userId = Auth::user()->owner->id;

       $date=Carbon::createFromTimeStamp($created_at);

      $tutionfee = TutionFee::with('courses')
                                ->with('asessions')
                               ->where('id',$tution_fee)
                                 ->where('created_at',$date)
                                ->whereHas('courses',function($q) use($userId){
                               $q->where('user_id',$userId);
                              })->first();                      
      return view('staff.tution_fee.tution_fee_structure_edit', compact('tutionfee'));
   }

   public function tution_fee_update(Request $request,$tution_fee = null, $created_at = null)
   {
   	  $userId = Auth::user()->owner->id;
       $date=Carbon::createFromTimeStamp($created_at);
      $tutionfee = TutionFee::where('id',$tution_fee)
                          ->where('created_at',$date)
                          ->whereHas('courses',function($q) use($userId){
                               $q->where('user_id',$userId);
                              })->first();

      $this->validate($request,[

            //'course'    => 'required|integer|unique:tution_fees,course_id,'.$tutionfee->id,
             'course' => 'required|integer|unique:tution_fees,course_id,NULL,NULL,asession_id, ' .$tutionfee->id,
            'tution_fee'      =>  'required|numeric',
            'late_fee'        =>    'nullable|numeric',
            'other_fee'       =>     'nullable|numeric',
            'remarks'         =>    'nullable'

         ]);

     
      $tutionfee->update($request->all());

      flash()->success('Successfully Updated');

       return redirect()->to('/acadmic/add/tution_fee');

   }

   public function tution_fee_delete($tution_fee = null, $created_at = null)
   {
       
       $userId = Auth::user()->owner->id;

       $date=Carbon::createFromTimeStamp($created_at);
       
       $tutionfee = TutionFee::where('id',$tution_fee)
                          ->where('created_at',$date)
                          ->whereHas('courses',function($q) use($userId){
                               $q->where('user_id',$userId);
                              })->first();
      

        $tutionfee->delete();

        flash()->success('Successfully Tution Fee Deleted!');

        return back();
   }
}
