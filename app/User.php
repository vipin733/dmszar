<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Emadadly\LaravelUuid\Uuids;
use App\Model\Auth\Subscription;
use App\Model\Auth\UserInvoice;
use App\Model\Staff\Add\BusDetail;
use App\Model\Staff\Acadmic\TimeTable;
use App\Model\Staff\Acadmic\LunchTime;

class User extends Authenticatable
{
    use Notifiable;

    use Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','active','plan','mobile_no','email_token','trial_end_at'
    ];

    protected $dates = ['trial_end_at'];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function appdetails()
    {
        return $this->hasMany(AppDetail::Class,'user_id');
    }

    public function bankdetails()
    {
        return $this->hasMany(BankDetail::Class,'user_id');
    }

     public function asessions()
    {
        return $this->hasMany(Asession::Class,'user_id');
    }

     public function schoolprofile()
    {
        return $this->hasOne(SchoolProfile::Class,'user_id');
    }

     public function appprofile()
    {
        return $this->hasOne(AppProfile::Class,'user_id');
    }


     public function students()
    {
        return $this->hasMany(Student::Class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::Class);
    }

    public function staffs()
    {
        return $this->hasMany(Staff::Class);
    }

    public function courses()
    {
        return $this->hasMany(Course::Class,'user_id');
    }

    public function districts()
    {
        return $this->hasMany(District::Class);
    }

    public function sections()
    {
        return $this->hasMany(Section::Class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::Class);
    }

    public function stopages()
    {
        return $this->hasMany(Stopage::Class);
    }

    public function hostels()
    {
        return $this->hasMany(Hostel::Class);
    }

    public function buses()
    {
        return $this->hasMany(BusDetail::Class);
    }

    public function testnames()
    {
        return $this->hasMany(TestName::Class);
    }

    public function examnames()
    {
        return $this->hasMany(ExamName::Class);
    }

    // public function feerequestcategories()
    // {
    //     return $this->hasMany(FeeRequestCategory::Class,'user_id');
    // }

    // public function logrequestcategories()
    // {
    //     return $this->hasMany(LogRequestCategory::Class,'user_id');
    // }

    public function ccategories()
    {
        return $this->hasMany(CCategory::Class,'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::Class);
    }

    public function messages()
    {
        return $this->hasMany(Message::Class);
    }

    public function events()
    {
        return $this->hasMany(Event::Class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::Class);
    }

    public function invoices()
    {
        return $this->hasMany(UserInvoice::Class);
    }


    public function timetables()
    {
        return $this->hasMany(TimeTable::Class,'user_id');
    }

     public function lunchtimes()
    {
        return $this->hasMany(LunchTime::Class,'user_id');
    }

    

    public function isActive()
    {
        if ($this->active) {
           return true;
        }

         return false;
    }

    public function isGold()
    {
        if ($this->plan) {
           return true;
        }

         return false;
    }


    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email_token'
    ];
}
