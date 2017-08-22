<?php

namespace App\Http\Controllers\Auth\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hostel;
use Auth;

class AuthAddHostelController extends Controller
{
   public function __construct()
    {

      $this->middleware(['auth','auth_active']); 
         
    }

    public function create()
    {
    	$hostels= Hostel::orderBy('id','desc')->where('user_id',Auth::id())->paginate(5);

   	  return view('auth.add.hostels.add_hostels',compact('hostels'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);
   	  	
   	    Auth::user()->hostels()->create($request->all());

        flash()->success('Successfully Hostel Details Created!');

  	    return back();
    }


    public function update(Request $request,$hostels_auth=null)
    {

    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

       $hostel = Hostel::where('id',$hostels_auth)->where('user_id',Auth::id())->first();

       flash()->success('Successfully Hostel Details Updated!');

   	   $hostel->update($request->all());
   	   
  	    return redirect()->route('hostels_auth.create');
    }

}
