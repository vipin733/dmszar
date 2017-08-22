<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subject;
use Auth;

class AddSubjectController extends Controller
{
  public function __construct()
    {

         $this->middleware(['auth:teacher','active','staffs']); 
    }

    public function create()
    {
   	  $subjects= Subject::orderBy('id','desc')->where('user_id',Auth::user()->owner->id)->get();

   	  return view('staff.add.subjects.add_subjects',compact('subjects'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);


       $user = Auth::user()->owner;
   	  	
   	   $user->subjects()->create($request->all());

       flash()->success('Successfully Subject Created!');

  	    return back();
    }



    public function update(Request $request, $subject = null)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

   	  	$subject = Subject::where('id',$subject)->where('user_id',Auth::user()->owner->id)->first();

   	   $subject->update($request->all());

   	   flash()->success('Successfully Subject Updated!');
   	   
  	    return redirect()->route('subjects.create');
    }

}
