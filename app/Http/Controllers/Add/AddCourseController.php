<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Course;

class AddCourseController extends Controller
{
   public function __construct()
    {

      $this->middleware(['auth:teacher','active','staffs']); 
         
    }

    public function create()
    {
    	$user = Auth::user();
    	$courses= Course::orderBy('name','desc')->where('user_id',$user->owner->id)->paginate(5);

   	  return view('staff.add.courses.add_courses',compact('courses'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);
           
        $user = Auth::user()->owner;
   	  	
   	    $user->courses()->create($request->all());

        flash()->success('Successfully Class Created!');

  	    return back();
    }


    public function update(Request $request,$course=null)
    {


    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

       $course = Course::where('id',$course)->where('user_id',Auth::user()->owner->id)->first();

       flash()->success('Successfully Class Updated!');

   	   $course->update($request->all());
   	   
  	    return redirect()->route('courses.create');
    }

   
}
