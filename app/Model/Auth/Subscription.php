<?php

namespace App\Model\Auth;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        
       'user_id','no_student','no_teacher', 'no_staff','no_message_sent'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
