<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 class AppDetail extends Model
{
    protected $fillable = [
        'app_name_id','app_id','qr_code','description'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function appnames()
    {
        return $this->belongsTo(AppName::class,'app_name_id');
    }
}
