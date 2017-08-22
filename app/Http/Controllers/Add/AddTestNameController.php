<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TestName;
use Auth;

class AddTestNameController extends Controller
{
    public function __construct()
    {

         $this->middleware(['auth:teacher','active','staffs']); 
    }

    public function create()
    {
   	  $testnames= TestName::orderBy('id','desc')->where('user_id',Auth::user()->owner->id)->get();

   	  return view('staff.add.testnames.add_testnames',compact('testnames'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);


       $user = Auth::user()->owner;
   	  	
   	    $user->testnames()->create($request->all());


       flash()->success('Successfully Test Name Created!');

  	    return back();
    }



    public function update(Request $request, $testname = null)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

   	  	$testname = TestName::where('id',$testname)->where('user_id',Auth::user()->owner->id)->first();

   	   $testname->update($request->all());

   	   flash()->success('Successfully Test Name Updated!');
   	   
  	    return redirect()->route('testnames.create');
    }

}
