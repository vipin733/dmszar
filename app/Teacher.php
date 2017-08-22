<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Emadadly\LaravelUuid\Uuids;
use Carbon\Carbon;
use App\Model\Teacher\Student\StudentHomeWork;



class Teacher extends Authenticatable
{
    use Notifiable;

    use Uuids;

    protected $fillable = [
         //login fillable
         'reg_no', 'password','active','type',
   //profile fillable
          'name','mob_no','last_school','experience','transportation','stopage_id',
     //personal fillable
          'father_name','mother_name','date_of_birth','gender','email', 'emergency_no',
           'date_of_joining',
      //address fillable
        'permanent_address','permanent_district_id','permanent_state_id','permanent_zip_pin','communication_address','communication_district_id','communication_state_id',
       'communication_zip_pin',
       //profile
       'avatar','bio'
    ];

    protected $guard = 'teacher';

     protected $dates = ['date_of_birth','date_of_joining'];

   public function setDateOfBirthAttribute($value)
    {
         //dd($value);
        $this->attributes['date_of_birth'] = Carbon::createFromFormat('d/m/Y',$value);
    }

     public function setDateOfJoiningAttribute($value)
    {
         //dd($value);
        $this->attributes['date_of_joining'] = Carbon::createFromFormat('d/m/Y',$value);
    }

    public function owner()
    {
        return $this->belongsTo(User::Class,'user_id');
    }

    public function isActive()
    {
        if ($this->active) {
           return true;
        }

         return false;
    }

     public function isStaff()
    {
        if ($this->type) {
           return true;
        }

         return false;
    }

     public function TransportationTaken()
    {
        if ($this->transportation) {
           return true;
        }

         return false;
    }

    public function stopages()
    {
        return $this->belongsTo(Stopage::Class,'stopage_id');
    }

     public function permanent_district()
    {
        return $this->belongsTo(AppDistrict::Class,'permanent_district_id');
    }

     public function communication_district()
    {
      return $this->belongsTo(AppDistrict::Class,'communication_district_id');
    }


    public function permanent_states()
    {
        return $this->belongsTo(State::Class,'permanent_state_id');
    }

    public function communication_states()
    {
        return $this->belongsTo(State::Class,'communication_state_id');
    }

     public function attendence()
    {
        return $this->hasMany(Teacher_Staff_Attendence::Class,'taker_id');
    }

    public function studentattendences()
    {
        return $this->hasMany(StudentAttendence::Class,'taker_id');
    }

    public function myatteendances()
    {
        return $this->hasMany(Teacher_Staff_Attendence::Class,'teacher_id');
    }

    public function notificationscreates()
    {
        return $this->hasMany(Notification::Class,'creater_id');
    }

    public function events()
    {
        return $this->hasMany(Event::Class,'creater_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::Class)->latest();
    }

    public function teacheracadmic()
    {
        return $this->hasOne(TeacherAcadmic::Class,'teacher_id');
    }

      public function subjects()
    {
        return $this->belongsToMany(Subject::class,'subject_teacher')->withTimestamps();
    }

    public function teacherteachingacadmics()
    {
        return $this->hasMany(TeacherTeachingAcadmic::Class,'teacher_id');
    }

    public function transportfeecollections()
    {
        return $this->hasMany(TransportFeeCollection::Class,'taker_id');
    }

    public function tutionfeecollections()
    {
        return $this->hasMany(TutionFeeCollection::Class,'taker_id');
    }

     public function teacherleaves()
    {
        return $this->hasMany(TeacherLeave::Class,'teacher_id');
    }

     public function homeworks()
    {
        return $this->hasMany(StudentHomeWork::Class,'teacher_id');
    }


     public function getFatherNameAttribute($value)

    {
        return ucwords($value);
    }

    public function getMotherNameAttribute($value)

    {
        return ucwords($value);
    }

    public function getPermanentAddressAttribute($value)

    {
        return ucwords($value);
    }

    public function getCommunicationAddressAttribute($value)

    {
        return ucwords($value);
    }


    public function getNameAttribute($value)

    {
        return ucwords($value);
    }

    protected $hidden = [
        'password', 'remember_token',
    ];
}
