<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
   protected $fillable = [
        'bank_id','branch_name','bank_address','bank_acc','bank_acc_name','bank_ifcs_code','bank_micr_code','description'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function banknames()
    {
        return $this->belongsTo(BankName::class,'bank_id');
    }
}
