<?php

namespace App\Http\Controllers\Auth\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Stopage;
use App\Model\Staff\Add\BusDetail;
use Auth;

class AuthAddStopagesController extends Controller
{
    public function __construct()
    {

       $this->middleware(['auth','auth_active']); 
    }

    public function create()
    {
    	$stopeages= Stopage::orderBy('id','desc')->where('user_id',Auth::id())->paginate(5);

      $busdetails= BusDetail::where('user_id',Auth::id())->pluck('name','id');

   	  return view('auth.add.stopeages.add_stopeages',compact('stopeages','busdetails'));
    }

    public function store(Request $request)
    {
    	$this->validate($request,[

            'name'       => 'required',
            'bus_detail' => 'required|integer'

   	  	]);
   	   
        $busdetail= BusDetail::where('user_id',Auth::id())->where('id',$request->bus_detail)->select('id')->first();

        if (!$busdetail) {
          flash('Oops! its look like u want somthing else, please do not try!')->error();
             return back();
        }

        $data = [
           'name'       => $request->name,
           'remarks'    => $request->remarks,
           'bus_id'     => $busdetail->id
        ];
        
        Auth::user()->stopages()->create($data);

       flash()->success('Successfully Stopage Created!');

  	    return back();
    }


    public function update(Request $request, $stopages_auth = null)
    {
    	$this->validate($request,[

            'name'       => 'required',
            'bus_detail' => 'required|integer'

   	  	]);
      
       $stopage= Stopage::where('user_id',Auth::id())->where('id',$stopages_auth)->first();

        $busdetail= BusDetail::where('user_id',Auth::id())->where('id',$request->bus_detail)->select('id')->first();

        if (!$busdetail) {
          flash('Oops! its look like u want somthing else, please do not try!')->error();
             return back();
        }
       
        $data = [
           'name'       => $request->name,
          'remarks'     => $request->remarks,
           'bus_id'     => $busdetail->id
        ];
        
        $stopage->update($data);

   	  flash()->success('Successfully Stopage Updated!');

  	    return redirect()->route('stopages_auth.create');
    }


}
