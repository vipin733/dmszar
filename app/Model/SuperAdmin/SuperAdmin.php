<?php

namespace App\Model\SuperAdmin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Emadadly\LaravelUuid\Uuids;
use App\Model\Blog\Blog;
use Carbon\Carbon;
use Auth;

 class SuperAdmin extends Authenticatable
{
     use Notifiable;

     use Uuids;

     protected $fillable = [

         'name','reg_no', 'password','status','email'

    ];




    protected $guard = 'superadmin';

   

     public function routeNotificationForSlack()
    {
        return 'https://hooks.slack.com/services/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';
    }

    public function blogs()
    {
        return $this->hasMany(Blog::Class,'blogger_id');
    }

     protected $hidden = [
        'password', 'remember_token',
    ];
}
