<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Staff\Add\BusDetail;
use App\Stopage;
use Auth;


class AddStopagesController extends Controller
{
    public function __construct()
    {

       $this->middleware(['auth:teacher','active','staffs']); 
    }

    public function create()
    {
   	    $user = Auth::user();

    	 $stopeages= Stopage::orderBy('id','desc')->where('user_id',$user->owner->id)->with('buses')->paginate(5);

       $busdetails= BusDetail::where('user_id',$user->id)->pluck('name','id');

   	   return view('staff.add.stopeages.add_stopeages',compact('stopeages','busdetails'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[

            'name'       => 'required',
            'bus_detail' => 'required|integer'

   	  	]);
     
   	  	$user = Auth::user()->owner;

        $busdetail= BusDetail::where('user_id',$user->id)->where('id',$request->bus_detail)->select('id')->first();

        if (!$busdetail) {
          flash('Oops! its look like u want somthing else, please do not try!')->error();
             return back();
        }

        $data = [
           'name'       => $request->name,
           'remarks'    => $request->remarks,
           'bus_id'     => $busdetail->id
        ];
   	  	
   	    $user->stopages()->create($data);

        flash()->success('Successfully Stopage Created!');

  	    return back();
    }


    public function update(Request $request, $stopage = null)
    {
    	$this->validate($request,[

            'name'       => 'required',
            'bus_detail' => 'required|integer'

        ]);
     
        $user = Auth::user()->owner;

        $stopage= Stopage::where('user_id',$user->id)->where('id',$stopage)->first();

        $busdetail= BusDetail::where('user_id',$user->id)->where('id',$request->bus_detail)->select('id')->first();

        if (!$busdetail) {
          flash('Oops! its look like u want somthing else, please do not try!')->error();
             return back();
        }
       
        $data = [
           'name'       => $request->name,
          'remarks'     => $request->remarks,
           'bus_id'     => $busdetail->id
        ];
        
        $stopage->update($data);

        flash()->success('Successfully Stopage Updated!');

        return back();
    }

    
}
