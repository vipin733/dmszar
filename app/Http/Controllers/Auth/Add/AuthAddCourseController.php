<?php

namespace App\Http\Controllers\Auth\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Course;

class AuthAddCourseController extends Controller
{
    public function __construct()
    {

      $this->middleware(['auth','auth_active']);
         
    }

     public function create()
    {
    	$courses= Course::orderBy('name','desc')->where('user_id',Auth::id())->paginate(5);

   	  return view('auth.add.courses.add_courses',compact('courses'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);
           
   	  	
   	    Auth::user()->courses()->create($request->all());

        flash()->success('Successfully Course Created!');

  	    return back();
    }

     public function update(Request $request,$courses_auth=null)
    {

    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

       $courses_auth = Course::where('id',$courses_auth)->where('user_id',Auth::id())->first();

       $courses_auth->update($request->all());

       flash()->success('Successfully Course Updated!');
   	   
  	    return redirect()->route('courses_auth.create');
    }

}
