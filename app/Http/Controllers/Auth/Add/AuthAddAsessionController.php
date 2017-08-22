<?php

namespace App\Http\Controllers\Auth\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Asession;

class AuthAddAsessionController extends Controller
{
   public function __construct()
    {

     $this->middleware(['auth','auth_active']);
         
    }

    public function create()
    {
    	$asessions= Asession::orderBy('name','desc')->where('user_id',Auth::id())->paginate(5);

   	  return view('auth.add.asessions.add_asessions',compact('asessions'));
    }

    public function store(Request $request)
    {

      $asessions= Asession::where('active',1)->where('user_id',Auth::id())->count();

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

       flash()->success('Successfully Session created!');

        Auth::user()->asessions()->create($request->all());
       
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

         Auth::user()->asessions()->create($request->all());
       
        return back();
      }
    	
    }


    public function update(Request $request,$asessions_auth=null)
    {
       
      $asessions= Asession::where('active',1)->where('user_id',Auth::id())->count();
      $asession = Asession::where('id',$asessions_auth)->where('user_id',Auth::id())->first();

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
       
        return redirect()->route('asessions_auth.create');

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
       
        return redirect()->route('asessions_auth.create');
      }

     
    }

}
