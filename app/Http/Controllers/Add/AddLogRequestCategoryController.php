<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\LogRequestCategory;

class AddLogRequestCategoryController extends Controller
{
   public function __construct()
    {

      $this->middleware(['auth:teacher','active','staffs']); 
         
    }

    public function create()
    {
    	$user = Auth::user();
    	$logrequestcategories= LogRequestCategory::orderBy('id','desc')->where('user_id',$user->owner->id)->paginate(5);

   	  return view('staff.add.logrequestcategories.add_logrequestcategories',compact('logrequestcategories'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);
           
        $user = Auth::user()->owner;
   	  	
   	    $user->logrequestcategories()->create($request->all());

        flash()->success('Successfully Log Request Category Created!');

  	    return back();
    }



    public function update(Request $request,$logrequestcategory=null)
    {


    	$this->validate($request,[
            
            'name' => 'required'

   	  	]);

       $logrequestcategory = LogRequestCategory::where('id',$logrequestcategory)->where('user_id',Auth::user()->owner->id)->first();

       flash()->success('Successfully Log Request Category Updated!');

   	   $logrequestcategory->update($request->all());
   	   
  	    return redirect()->route('logrequestcategories.create');
    }

 
}
