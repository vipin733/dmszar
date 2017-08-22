<?php

namespace App\Http\Controllers\Auth\Add;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Staff\Add\BusDetail;
use Auth;

class AuthAddBusDetailController extends Controller
{
    public function __construct()
    {

      $this->middleware(['auth','auth_active']);
         
    }

    public function create()
    {
    	$user = Auth::user();

    	$busdetails= BusDetail::orderBy('id','desc')->where('user_id',$user->id)->paginate(5);

   	  return view('auth.add.busdetails.add_busdetails',compact('busdetails'));
    }

    public function store(Request $request)
    {

       $user = Auth::user();

        $this->validate($request,[
            
            'name'           => 'required',
            'bus_no'         => 'required',

        ]);

        $user->buses()->create($request->all());


       flash()->success('Successfully BusDetail created!');
       
        return back();
         	
    }

    public function update(Request $request, $busdetails_auth=null)
    {
       
      $busdetail = BusDetail::where('id',$busdetails_auth)->where('user_id',Auth::id())->first();


        $this->validate($request,[
            
            'name'           => 'required',
            'bus_no'         => 'required',
        ]);


       flash()->success('Successfully BusDetail Updated!');

       $busdetail->update($request->all());
       
         return back();
     
    }
}
