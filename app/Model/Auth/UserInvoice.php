<?php

namespace App\Model\Auth;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use App\Model\Auth\BillConfirmation;
use Carbon\Carbon;
class UserInvoice extends Model
{
   use Uuids;
   protected $fillable = [
        
       'user_id','updated_by_id','month','invoice_no', 'payment_method','payment_date','payment_status','payment_amount','remarks'
    ];

     protected $dates = ['month','payment_date'];

    //   public function setPaymentDateAttribute($value)
    // {
    //      //dd($value);
    //     $this->attributes['payment_date'] = Carbon::createFromFormat('d/m/Y',$value);
    // }

     public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function billconfirmation()
    {
        return $this->hasOne(BillConfirmation::Class,'userinvoice_id');
    }
}
