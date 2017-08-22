<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Section;
use Auth;

class AddSectionController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth:teacher','active','staffs']);
    }

    public function create()
    {

   	    $user = Auth::user();
    	$sections= Section::orderBy('name')->where('user_id',$user->owner->id)->get();

   	  return view('staff.add.sections.add_sections',compact('sections'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

   	  	 $user = Auth::user()->owner;
   	  	
   	    $user->sections()->create($request->all());

       flash()->success('Successfully Section Created!');

  	    return back();
    }


    public function update(Request $request,$section= null)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

   	   $section = Section::where('id',$section)->where('user_id',Auth::user()->owner->id)->first();      
   	   $section->update($request->all());

   	   flash()->success('Successfully Section Updated!');
   	   
  	    return redirect()->route('sections.create');
    }

 
}
