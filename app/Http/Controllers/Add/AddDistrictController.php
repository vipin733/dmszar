<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\District;
use Auth;

class AddDistrictController extends Controller
{
       public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']); 
    }

    public function create()
    {
   	  $user = Auth::user();
      $districts= District::orderBy('id','desc')->where('user_id',$user->owner->id)->paginate(5);

   	  return view('staff.add.districts.add_districts',compact('districts'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

   	  	$user = Auth::user()->owner;
   	  	
   	    $user->districts()->create($request->all());

       flash()->success('Successfully City Created!');

  	    return back();
    }



    public function update(Request $request, $district = null)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

   	  	$district = District::where('id',$district)->where('user_id',Auth::user()->owner->id)->first();


   	    $district->update($request->all());

   	    flash()->success('Successfully City Updated!');
   	   
  	    return redirect()->route('districts.create');
    }


}
