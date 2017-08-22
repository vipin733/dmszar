<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CCategory;
use App\Asession;
use Auth;

class AddCertificateNameController extends Controller
{
     public function __construct()
    {

      $this->middleware(['auth:teacher','active','staffs']); 
         
    }

    public function create()
    {
    	$user = Auth::user();
    	$ccategories= CCategory::orderBy('id','desc')->where('user_id',$user->owner->id)->paginate(5);

   	  return view('staff.add.ccategories.add_ccategories',compact('ccategories'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
            
            'name' => 'required',
            'cfee' => 'required|numeric'

   	  	]);

      $activesessionid = Asession::where('user_id',Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id')
                                        ->first(); 
           $data = [
           'name'        => $request->name,
           'cfee'        => $request->cfee,
           'asession_id' => $activesessionid->id
           ];

        $user = Auth::user()->owner;
   	  	
   	    $user->ccategories()->create($data);

        flash()->success('Successfully Category Created!');

  	    return back();
    }


    public function update(Request $request,$ccategory=null)
    {


    	$this->validate($request,[
            
            'name' => 'required',
            'cfee' => 'required|numeric'

   	  	]);

       $ccategory = CCategory::where('id',$ccategory)->where('user_id',Auth::user()->owner->id)->first();

       flash()->success('Successfully Category Updated!');

   	   $ccategory->update($request->all());
   	   
  	    return redirect()->route('ccategories.create');
    }

}
