<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\FeeRequestCategory;

class AddFeeRequestCategoryController extends Controller
{
   public function __construct()
    {

      $this->middleware(['auth:teacher','active','staffs']); 
         
    }

    public function create()
    {
    	$user = Auth::user();
    	$feerequestcategories= FeeRequestCategory::orderBy('id','desc')->where('user_id',$user->owner->id)->paginate(5);

   	  return view('staff.add.feerequestcategories.add_feerequestcategories',compact('feerequestcategories'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);
           
        $user = Auth::user()->owner;
   	  	
   	    $user->feerequestcategories()->create($request->all());

        flash()->success('Successfully Category Created!');

  	    return back();
    }


    public function update(Request $request,$feerequestcategory=null)
    {


    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

       $feerequestcategory = FeeRequestCategory::where('id',$feerequestcategory)->where('user_id',Auth::user()->owner->id)->first();

       flash()->success('Successfully Category Updated!');

   	   $feerequestcategory->update($request->all());
   	   
  	    return redirect()->route('feerequestcategories.create');
    }

 
}
