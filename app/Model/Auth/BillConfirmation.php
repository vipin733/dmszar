<?php

namespace App\Model\Auth;

use Illuminate\Database\Eloquent\Model;
use App\Model\Auth\UserInvoice;
use Carbon\Carbon;

class BillConfirmation extends Model
{
    protected $fillable = [
        
      'bank_app', 'payment_date','payment_amount','transaction_no','remarks'
    ];

    protected $dates = ['payment_date'];



     public function userinvoices()
    {
        return $this->belongsTo(UserInvoice::class,'userinvoice_id');
    }

}