<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Hostel;

class AddHostelController extends Controller
{
    public function __construct()
    {

      $this->middleware(['auth:teacher','active','staffs']); 
         
    }

    public function create()
    {
    	$user = Auth::user();
    	$hostels= Hostel::orderBy('id','desc')->where('user_id',$user->owner->id)->paginate(5);

   	  return view('staff.add.hostels.add_hostels',compact('hostels'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);
           
        $user = Auth::user()->owner;
   	  	
   	    $user->hostels()->create($request->all());

        flash()->success('Successfully Hostel Details Created!');

  	    return back();
    }


    public function update(Request $request,$hostel=null)
    {


    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

       $hostel = Hostel::where('id',$hostel)->where('user_id',Auth::user()->owner->id)->first();

       flash()->success('Successfully Hostel Details Updated!');

   	   $hostel->update($request->all());
   	   
  	    return redirect()->route('hostels.create');
    }

}
