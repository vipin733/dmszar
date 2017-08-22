<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CCategory extends Model
{
  protected $fillable = [
        'name','cfee','asession_id','remarks'
    ];


     public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

     public function asessions()
    {
      return $this->belongsTo(Asession::Class,'asession_id');
    }
}
