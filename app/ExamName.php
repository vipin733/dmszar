<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamName extends Model
{
    protected $fillable = [
        'name','max_mark','remarks'
    ];

     public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
