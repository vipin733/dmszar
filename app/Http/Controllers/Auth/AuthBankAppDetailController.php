<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\AppDetail;
use App\BankDetail;
use App\AppName;
use App\BankName;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class AuthBankAppDetailController extends Controller
{
    public function __construct()
    {

      $this->middleware(['auth','auth_active']);
         
    }

     public function bank_details()
    {
    	$bankdetails = BankDetail::where('user_id',Auth::id())->with('banknames')->get();
    	return view('auth.onlinetransfer.bank.bank_details',compact('bankdetails'));
    }

    public function bank_details_post(Request $request)
    {
    	$this->validate($request,[
            
            'bank_name'      => 'required|integer',
            'branch_name'    => 'required',
            'bank_address'   => 'nullable',
            'bank_acc'       => 'required|numeric',
            'bank_acc_name'  => 'required',
            'bank_ifcs_code' => 'required',
            'bank_micr_code' => 'nullable',
            'description'    => 'nullable',

   	  	]);

       $bankname = BankName::where('id',$request->bank_name)->select('id')->first();

       $data = [
        'bank_id'          => $bankname->id,
        'branch_name'      => $request->branch_name,
        'bank_address'     => $request->bank_address,
        'bank_acc'         => $request->bank_acc,
        'bank_acc_name'    => $request->bank_acc_name,
        'bank_ifcs_code'   => $request->bank_ifcs_code,
        'bank_micr_code'   => $request->bank_micr_code,
        'description'      => $request->description,
        ];

   	  	Auth::user()->bankdetails()->create($data);

       flash()->success('Successfully Submited!');
       
        return back();
    }

    public function bank_details_update(Request $request,$bankdetail = null, $created_at = null)
    {
    	$this->validate($request,[
            
            'bank_name'      => 'required|integer',
            'branch_name'    => 'required',
            'bank_address'   => 'nullable',
            'bank_acc'       => 'required|numeric',
            'bank_acc_name'  => 'required',
            'bank_ifcs_code' => 'required',
            'bank_micr_code' => 'nullable',
            'description'    => 'nullable',

   	  	]);

   	  $created_at=Carbon::createFromTimeStamp($created_at); 

      $bankdetail = BankDetail::where('user_id',Auth::id())->where('id',$bankdetail)->where('created_at',$created_at)->first(); 

       $bankname = BankName::where('id',$request->bank_name)->select('id')->first();

       $data = [
        'bank_id'          => $bankname->id,
        'branch_name'      => $request->branch_name,
        'bank_address'     => $request->bank_address,
        'bank_acc'         => $request->bank_acc,
        'bank_acc_name'    => $request->bank_acc_name,
        'bank_ifcs_code'   => $request->bank_ifcs_code,
        'bank_micr_code'   => $request->bank_micr_code,
        'description'      => $request->description,
        ];

   	  	$bankdetail->update($data);

       flash()->success('Successfully Updated!');
       
        return back();
    }

    public function bank_details_destroy($bankdetail = null, $created_at = null)
    {    

       $created_at=Carbon::createFromTimeStamp($created_at); 

      $bankdetail = BankDetail::where('user_id',Auth::id())->where('id',$bankdetail)->where('created_at',$created_at)->first(); 

        $bankdetail->delete();  

        flash()->success('Successfully Deleted!');     

        return back();
    }


     public function app_details()
    {
    	$appdetails = AppDetail::where('user_id',Auth::id())->with('appnames')->get();
    	return view('auth.onlinetransfer.app.app_details',compact('appdetails'));
    }

     public function app_details_post(Request $request)
    {

    	$this->validate($request,[
            
            'app_name'      => 'required|integer',
            'app_id'        => 'required',
            'qr_code'       => 'nullable|image|max:10240',
            'description'   => 'nullable'
   	  	]);

   	  	if ($request->hasFile('qr_code')) {
          
        $filename = time() . ".jpg";
        $id = Auth::id();
        $qr_code  ='https://s3.ap-south-1.amazonaws.com/dbmszar/qrcode'.'/'.$id.'/'. $filename;
        $image = Image::make($request->file('qr_code'));
        $image->encode('jpg');
        Storage::disk('s3')->put("qrcode/$id/$filename", $image->__toString());
          }else{
          	$qr_code = null;
          }

        $appname = AppName::where('id',$request->app_name)->select('id')->first();

        $data = [
        'app_name_id' => $appname->id,
        'app_id'      => $request->app_id,
        'qr_code'     => $qr_code,
        'description' => $request->description
        ];
                 
   	  	Auth::user()->appdetails()->create($data);

       flash()->success('Successfully Submited!');
       
        return back();
    }

     public function app_details_update(Request $request,$appdetail = null, $created_at = null)
    {
    	$this->validate($request,[
            
            'app_name'      => 'required|integer',
            'app_id'        => 'required',
            'qr_code'       => 'nullable|image|max:10240',
            'description'   => 'nullable'
   	  	]);

   	  	$created_at=Carbon::createFromTimeStamp($created_at);

   	  	$appdetail = AppDetail::where('user_id',Auth::id())->where('id',$appdetail)->where('created_at',$created_at)->first();

        $appname = AppName::where('id',$request->app_name)->select('id')->first();

   	  	if ($request->hasFile('qr_code')) {
          
        $filename = time() . ".jpg";
        $id = Auth::id();
        $qr_code  ='https://s3.ap-south-1.amazonaws.com/dbmszar/qrcode'.'/'.$id.'/'. $filename;
        $image = Image::make($request->file('qr_code'));
        $image->encode('jpg');
        Storage::disk('s3')->put("qrcode/$id/$filename", $image->__toString());
          }else{
          	$qr_code = $appdetail->qr_code;
          }

        $data = [
        'app_name_id' => $appname->id,
        'app_id'      => $request->app_id,
        'qr_code'     => $qr_code,
        'description' => $request->description
        ];
                 
   	   $appdetail->update($data);

       flash()->success('Successfully Updated!');
       
        return back();
    }

    public function appp_details_destroy($appdetail = null, $created_at = null)
    {    

       $created_at=Carbon::createFromTimeStamp($created_at); 

      $appdetail = AppDetail::where('user_id',Auth::id())->where('id',$appdetail)->where('created_at',$created_at)->first(); 

        $appdetail->delete();  

        flash()->success('Successfully Deleted!');     

        return back();
    }

     
}
