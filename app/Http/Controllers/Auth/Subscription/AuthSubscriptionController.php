<?php

namespace App\Http\Controllers\Auth\Subscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Auth\UserInvoice;
use App\Model\Auth\Subscription;
use App\Model\Auth\BillConfirmation;
use Auth;
use App\User;
use Carbon\Carbon;
use PDF;

class AuthSubscriptionController extends Controller
{
    public function __construct()
    {

      $this->middleware(['auth','auth_active']);
         
    }

     public function mysubscription()
    {
        $user = Auth::user();

    	return view('auth.subscription.mysubscription_detail',compact('user'));
    }

    public function plan_update(Request $request)
    {
    	$this->validate($request,[
            
            'plan'      => 'required|integer',

   	  	]);
    	
    	Auth::user()->update($request->all());

    	flash()->success('Successfully Plan Updated!');
       
        return back();
    }

    public function bill()
    {
        $invoices = UserInvoice::where('user_id',Auth::id())->get();

                        if (count($invoices)) {
                          foreach ($invoices as $key => $value) {                              
                          $paymentamount[] = $value->payment_amount; 
                          //return $value->month;
                           $due_month[] = $value->month->format('F, Y');                             
                          } 
                    }else{

                        $paymentamount[] = null; 
                          //return $value->month;
                           $due_month[] = null; 

                    } 
                                                  
        $invoice_latest = Subscription::where('user_id',Auth::id())->latest()->first();
        //return $invoice_latest;
        return view('auth.subscription.bill.home_bill',compact('invoice_latest'))
                    ->with('paymentamount',json_encode($paymentamount))
                    ->with('due_month',json_encode($due_month));

    }

    public function bill_details()
    {
       $user = Auth::user();

       $user->load('invoices');

       //return $user;
        return view('auth.subscription.bill.bill_details',compact('user'));
    }

    public function bill_invoice($uuid = null, $month= null)
    {
        $invoice = UserInvoice::where('user_id',Auth::id())->where('uuid',$uuid)->first();
        $date = Carbon::createFromTimeStamp($month)->format('Y-m-d');   

        $invoice_detail = Subscription::where('user_id',Auth::id())->whereDate('created_at',$date)->first();

        //return $date;
        $user = Auth::user();
        $user->load(['schoolprofile','schoolprofile.states','schoolprofile.appdistricts']);
        return view('auth.subscription.bill.bill_invoice',compact('invoice','user','invoice_detail'));
    }

    public function print_bill_invoice($uuid = null, $month= null)
    {
        $invoice = UserInvoice::where('user_id',Auth::id())->where('uuid',$uuid)->first();
        $date = Carbon::createFromTimeStamp($month)->format('Y-m-d');   

        $invoice_detail = Subscription::where('user_id',Auth::id())->whereDate('created_at',$date)->first();

        $user = Auth::user();
        $user->load(['schoolprofile','schoolprofile.states','schoolprofile.appdistricts']);

       $pdf=PDF::loadView('auth.subscription.bill.bill_invoice_print',compact('user','invoice','invoice_detail'));

       return $pdf->stream('invoice-'.$invoice->id.'.' .'pdf'); 
    }

       public function download_bill_invoice($uuid = null, $month= null)
    {
        $invoice = UserInvoice::where('user_id',Auth::id())->where('uuid',$uuid)->first();
        $date = Carbon::createFromTimeStamp($month)->format('Y-m-d');   

        $invoice_detail = Subscription::where('user_id',Auth::id())->whereDate('created_at',$date)->first();

        $user = Auth::user();
        $user->load(['schoolprofile','schoolprofile.states','schoolprofile.appdistricts']);

       $pdf=PDF::loadView('auth.subscription.bill.bill_invoice_print',compact('user','invoice','invoice_detail'));

       return $pdf->download('invoice-'.$invoice->id.'.' .'pdf'); 
    }

    public function pay_online()
    {
        return view('auth.subscription.bill.pay_online');
    }

    public function online_confirmation()
    {
        $unpaids = UserInvoice::where('user_id',Auth::id())->where('payment_status',0)->get();

        $userinvoices = UserInvoice::where('user_id',Auth::id())->with('billconfirmation')->has('billconfirmation')->get();

        $invoice_latest = Subscription::where('user_id',Auth::id())->latest()->get();

        return view('auth.subscription.bill.online_confirmation',compact('unpaids','userinvoices','invoice_latest'));
    }

    public function online_confirmation_save(Request $r)
    {
      $this->validate($r,[
            
            'unpaid_month'          => 'required|integer',
            'bank_app'              => 'required',
            'payment_date'          => 'required|date_format:d/m/Y',
            'payment_amount'        => 'required',
            'transaction_no'        => 'required',

        ]);

        $userinvoice = UserInvoice::where('user_id',Auth::id())->where('id',$r->unpaid_month)->first();


        if ( $userinvoice->billconfirmation) {

          flash('You already applied for online payment confirmation for '.$userinvoice->month->format('F, Y').',' ,'danger');

        return back();
        }

        $userinvoice->billconfirmation()->create($r->all());

        flash()->success('Successfully Fee Confirmation Submited!');

        return back();

    }

    public function online_confirmation_update(Request $r,$uuid = null)
    {
        $this->validate($r,[
            
            'unpaid_month'          => 'required|integer',
            'bank_app'              => 'required',
            'payment_date'          => 'required|date_format:d/m/Y',
            'payment_amount'        => 'required',
            'transaction_no'        => 'required',

        ]);

            $payment_date = $r->payment_date;
            $paymentdate  = str_replace('/', '-', $payment_date);
            $date = date('Y-m-d', strtotime($paymentdate));

        $userinvoice = UserInvoice::where('user_id',Auth::id())->where('uuid',$uuid)->first();

        $data = [

           'bank_app'      => $r->bank_app,
           'payment_date'  => $date,
           'payment_amount'=> $r->payment_amount,
           'transaction_no'=> $r->transaction_no,
           'remarks'       => $r->remarks
        ];

        //return  $data;

        $userinvoice->billconfirmation()->update($data);

        flash()->success('Successfully Fee Confirmation Updated!');

        return back();

    }

    public function bill_details_test()
    {
       //  $lastmonth = Carbon::now()->subMonth(1)->month; 

       //  //return $lastmonth;
       //  $users = User::whereHas('subscriptions',function($q) use($lastmonth){
       //                      $q->orderBy('created_at','desc')
       //                        ->whereMonth('created_at',6);
       //                  })->where(function($q){
       //                     $q->where('plan','!=',0)
       //                        ->where('active',1);
       //                  })->orWhere(function($q){
       //                     $q->where('plan',1)
       //                        ->where('plan',2);
       //                  })->select('id')->get();
       // return $users;
       // $invoice_no = UserInvoice::orderBy('invoice_no','desc')->select('invoice_no')->first();

       // if ($invoice_no) {
       //     $no = $invoice_no->invoice_no;
       // }else{
       //     $no = 1;
       // }
        
       // foreach ($users as $user) {
       //    $subscription  =  $user->subscriptions->first();

       //    return $subscription;

       //    $data = [

       //       'user_id'               =>  $user->id,
       //       'month'                 =>  $subscription->created_at,
       //       'invoice_no'            =>  $no ++,
       //       'payment_method'        =>  null,
       //       'payment_date'          =>  null,
       //       'payment_status'        =>  0,
       //       'payment_amount'        =>  10 * $subscription->no_student
       //    ];

       //    UserInvoice::create($data);
       //  }  
    }
}
