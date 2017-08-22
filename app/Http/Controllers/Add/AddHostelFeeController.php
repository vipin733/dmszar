<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Asession;
use Carbon\Carbon;
use App\HostelFee;
use App\Hostel;
use Auth;

class AddHostelFeeController extends Controller
{
    public function __construct()
    {

      $this->middleware(['auth:teacher','active','staffs']); 
         
    }

    public function Hostel_fee_get()
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

      $hostelfees  = HostelFee::where('asession_id',$activesessionid->id)
                            ->whereHas('hostels',function($q) use($userId){
                               $q->where('user_id',$userId);
                              })->with('hostels','asessions')
                              ->latest()->get();

      return view('staff.hostel_fee.hostel_fee_structure',compact('hostelfees','activesessionid'));
   }


   public function Hostel_fee_post(Request $r)
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

             'hostel'          => 'required|integer|unique:hostel_fees,hostel_id,NULL,NULL,asession_id, ' . $activesessionid->id,
            'hostel_fee'       =>        'required|numeric',
            'late_fee'         =>        'nullable|numeric',
            'other_fee'        =>        'nullable|numeric',
            'remarks'          =>        'nullable'

         ]);
       
        $data = [
     
       'asession_id'     => $activesessionid->id,
       'hostel_fee'      => $r->hostel_fee,
       'late_fee'        => $r->late_fee,
       'other_fee'       => $r->other_fee,
       'remarks'         => $r->remarks

      ];
     
     $hostel = Hostel::where('id',$r->hostel)->where('user_id',$userId)->first();

     $hostel->hostelfee()->create($data);

     flash()->success('Successfully Submited');

       return back();

   }

   public function Hostel_fee_edit($hostel_fee = null, $created_at = null)
   {
   	  $userId = Auth::user()->owner->id;

       $date=Carbon::createFromTimeStamp($created_at);

      $hostelfee = HostelFee::where('id',$hostel_fee)
                          ->where('created_at',$date)
                          ->whereHas('hostels',function($q) use($userId){
                               $q->where('user_id',$userId);
                              })->with('hostels','asessions')->first();
                      
      return view('staff.hostel_fee.hostel_fee_structure_edit', compact('hostelfee'));
   }

   public function Hostel_fee_update(Request $request,$hostel_fee = null, $created_at = null)
   {
   	  $userId = Auth::user()->owner->id;

      $date=Carbon::createFromTimeStamp($created_at);

      $hostelfee = HostelFee::where('id',$hostel_fee)
                          ->where('created_at',$date)
                          ->whereHas('hostels',function($q) use($userId){
                               $q->where('user_id',$userId);
                              })->first();

      $this->validate($request,[

            'hostel' => 'required|integer|unique:hostel_fees,hostel_id,NULL,NULL,asession_id, ' .$hostelfee->id,
            'hostel_fee'         =>  'required|numeric',
            'late_fee'           =>  'nullable|numeric',
            'other_fee'          =>  'nullable|numeric',
            'remarks'            =>  'nullable'

         ]);

     
      $hostelfee->update($request->all());

      flash()->success('Successfully Updated');

       return redirect()->to('/acadmic/add/Hostel_fee');

   }

   public function Hostel_fee_delete($hostel_fee = null, $created_at = null)
   {
       
       $userId = Auth::user()->owner->id;

       $date=Carbon::createFromTimeStamp($created_at);

      $hostelfee = HostelFee::where('id',$hostel_fee)
                          ->where('created_at',$date)
                          ->whereHas('hostels',function($q) use($userId){
                               $q->where('user_id',$userId);
                              })->first();
      

        $hostelfee->delete();

        flash()->success('Successfully Trnasport Fee Deleted!');

        return back();
   }
}
