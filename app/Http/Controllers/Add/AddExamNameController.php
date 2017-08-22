<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ExamName;
use Auth;

class AddExamNameController extends Controller
{
   public function __construct()
    {

         $this->middleware(['auth:teacher','active','staffs']); 
    }

    public function create()
    {
   	  $examnames= ExamName::orderBy('id','desc')->where('user_id',Auth::user()->owner->id)->get();

   	  return view('staff.add.examnames.add_examnames',compact('examnames'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);


       $user = Auth::user()->owner;
   	  	
   	    $user->examnames()->create($request->all());


       flash()->success('Successfully Exam Name Created!');

  	    return back();
    }


    public function update(Request $request, $examname = null)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

   	  	$examname = ExamName::where('id',$examname)->where('user_id',Auth::user()->owner->id)->first();

   	   $examname->update($request->all());

   	   flash()->success('Successfully Exam Name Updated!');
   	   
  	    return redirect()->route('examnames.create');
    }

  
}
