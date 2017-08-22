<?php

namespace App\Http\Controllers\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Asession;

class AddAsessionController extends Controller
{
     public function __construct()
    {

      $this->middleware(['auth:teacher','active','staffs']); 
         
    }

    public function create()
    {
    	$user = Auth::user()->owner;
    	$asessions= Asession::orderBy('name','desc')->where('user_id',$user->id)->paginate(5);

   	  return view('staff.add.asessions.add_asessions',compact('asessions'));
    }

    public function store(Request $request)
    {

      $user = Auth::user()->owner;

      $asessions= Asession::where('active',1)->where('user_id',$user->id)->count();

      if ($request->active == 1) {
            if (!$asessions > 0) {
        $this->validate($request,[
            
            'name'           => 'required|max:9|min:9',
            'active'         => 'required|boolean',

        ],
           [
            'name.required' => 'Session field is required',
            'name.max'      => 'Session should be like 2009-2010',
            'name.min'      => 'Session should be like 2009-2010',
           ]
        );

        $user->asessions()->create($request->all());

       flash()->success('Successfully Session created!');
       
        return back();

      }else{

        flash('Sorry! Only one session should be active.', 'danger');

        return back();
      }
      }else{
       $this->validate($request,[
            
            'name'           => 'required|max:9|min:9',
            'active'         => 'required|boolean',

        ],
           [
            'name.required' => 'Session field is required',
            'name.max'      => 'Session should be like 2009-2010',
            'name.min'      => 'Session should be like 2009-2010',
           ]
        );


       flash()->success('Successfully Session created!');

        $user->asessions()->create($request->all());
       
        return back();
      }


    	
    }


    public function update(Request $request,$asession=null)
    {
       
      $asessions= Asession::where('active',1)->where('user_id',Auth::user()->owner->id)->count();
     $asession = Asession::where('id',$asession)->where('user_id',Auth::user()->owner->id)->first();

       if ($request->active == 1) {
            if (!$asessions > 0) {
        $this->validate($request,[
            
            'name'           => 'required|max:9|min:9',
            'active'         => 'required|boolean',

        ],
           [
            'name.required' => 'Session field is required',
            'name.max'      => 'Session should be like 2009-2010',
            'name.min'      => 'Session should be like 2009-2010',
           ]
        );

       flash()->success('Successfully Session Updated!');

       $asession->update($request->all());
       
        return redirect()->route('asessions.create');

      }else{

        flash('Sorry! Only one session should be active.', 'danger');

        return back();
      }
      }else{
       $this->validate($request,[
            
            'name'           => 'required|max:9|min:9',
            'active'         => 'required|boolean',

        ],
           [
            'name.required' => 'Session field is required',
            'name.max'      => 'Session should be like 2009-2010',
            'name.min'      => 'Session should be like 2009-2010',
           ]
        );

       flash()->success('Successfully Session Updated!');

       $asession->update($request->all());
       
        return redirect()->route('asessions.create');
      }

     
    }


}
