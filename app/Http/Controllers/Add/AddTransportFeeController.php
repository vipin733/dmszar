<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TransportFee;
use App\Stopage;
use App\Asession;
use Carbon\Carbon;
use Auth;

class AddTransportFeeController extends Controller
{
     public function __construct()
    {

      $this->middleware(['auth:teacher','active','staffs']); 
         
    }

    public function transport_fee_get()
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

      $transportfees  = TransportFee::where('asession_id',$activesessionid->id)
                                      ->whereHas('stopages',function($q) use($userId){
                                        $q->where('user_id',$userId);
                                       })->with('stopages','asessions')
                                         ->latest()->get();

      return view('staff.transport_fee.trans_fee_structure',compact('transportfees','activesessionid'));
   }


   public function transport_fee_post(Request $r)
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

            'stopage'          => 'required|integer|unique:transport_fees,stopage_id,NULL,NULL,asession_id, ' . $activesessionid->id,
            'transport_fee'    =>        'required|numeric',
            'late_fee'         =>        'nullable|numeric',
            'other_fee'        =>        'nullable|numeric',
            'remarks'          =>        'nullable'

         ]);

      $data = [
     
       'asession_id'     => $activesessionid->id,
       'transport_fee'   => $r->transport_fee,
       'late_fee'        => $r->late_fee,
       'other_fee'       => $r->other_fee,
       'remarks'         => $r->remarks

      ];

    
     $stopage = Stopage::where('id',$r->stopage)->where('user_id',$userId)->first();

     $stopage->transportFee()->create($data);

     flash()->success('Successfully Submited');

       return back();

   }

   public function transport_fee_edit($transport_fee = null, $created_at = null)
   {
   	  $userId = Auth::user()->owner->id;

       $date=Carbon::createFromTimeStamp($created_at);

      $transportfee = TransportFee::where('id',$transport_fee)
                          ->where('created_at',$date)
                          ->whereHas('stopages',function($q) use($userId){
                               $q->where('user_id',$userId);
                              })->with('stopages')
                                ->with('asessions')
                                ->first();
                      
      return view('staff.transport_fee.trans_fee_structure_edit', compact('transportfee'));
   }

   public function transport_fee_update(Request $request,$transport_fee = null, $created_at = null)
   {
   	  $userId = Auth::user()->owner->id;

      $date=Carbon::createFromTimeStamp($created_at);

      $transportfee = TransportFee::where('id',$transport_fee)
                          ->where('created_at',$date)
                          ->whereHas('stopages',function($q) use($userId){
                               $q->where('user_id',$userId);
                              })->first();

      $this->validate($request,[

            'stopage' => 'required|integer|unique:transport_fees,stopage_id,NULL,NULL,asession_id, ' .$transportfee->id,
            'transport_fee'      =>  'required|numeric',
            'late_fee'           =>  'nullable|numeric',
            'other_fee'          =>  'nullable|numeric',
            'remarks'            =>  'nullable'

         ]);

     
      $transportfee->update($request->all());

      flash()->success('Successfully Updated');

       return redirect()->to('/acadmic/add/transport_fee');

   }

   public function transport_fee_delete($transport_fee = null, $created_at = null)
   {
       
       $userId = Auth::user()->owner->id;

       $date=Carbon::createFromTimeStamp($created_at);

      $transportfee = TransportFee::where('id',$transport_fee)
                          ->where('created_at',$date)
                          ->whereHas('stopages',function($q) use($userId){
                               $q->where('user_id',$userId);
                              })->first();
      

        $transportfee->delete();

        flash()->success('Successfully Trnasport Fee Deleted!');

        return back();
   }
}
