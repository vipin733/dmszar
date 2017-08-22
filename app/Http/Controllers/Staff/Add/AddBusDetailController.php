<?php

namespace App\Http\Controllers\Staff\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Staff\Add\BusDetail;
use Auth;

class AddBusDetailController extends Controller
{
    public function __construct()
    {

      $this->middleware(['auth:teacher','active','staffs']); 
         
    }

    public function create()
    {
    	$user = Auth::user()->owner;
    	$busdetails= BusDetail::orderBy('id','desc')->where('user_id',$user->id)->paginate(5);

   	  return view('staff.add.busdetails.add_busdetails',compact('busdetails'));
    }

    public function store(Request $request)
    {

       $user = Auth::user()->owner;

        $this->validate($request,[
            
            'name'           => 'required',
            'bus_no'         => 'required',

        ]);

        $user->buses()->create($request->all());


       flash()->success('Successfully BusDetail created!');
       
        return back();
         	
    }

    public function update(Request $request, $busdetail=null)
    {
       
      $busdetail = BusDetail::where('id',$busdetail)->where('user_id',Auth::user()->owner->id)->first();


        $this->validate($request,[
            
            'name'           => 'required',
            'bus_no'         => 'required',
        ]);


       flash()->success('Successfully BusDetail Updated!');

       $busdetail->update($request->all());
       
         return back();
     
    }
}
