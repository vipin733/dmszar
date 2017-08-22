<?php

namespace App\Http\Controllers\Auth\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\District;
use Auth;

class AuthAddDistrictController extends Controller
{
    
       public function __construct()
    {

        $this->middleware(['auth','auth_active']);
    }

    public function create()
    {

      $districts= District::orderBy('id','desc')->where('user_id',Auth::id())->paginate(5);

   	  return view('auth.add.districts.add_districts',compact('districts'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

   	  	
   	    Auth::user()->districts()->create($request->all());

       flash()->success('Successfully District Created!');

  	    return back();
    }

  
    public function update(Request $request, $districts_auth = null)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

   	  	$district = District::where('id',$districts_auth)->where('user_id',Auth::id())->first();


   	    $district->update($request->all());

   	    flash()->success('Successfully District Updated!');
   	   
  	    return redirect()->route('districts_auth.create');
    }
}
