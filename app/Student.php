<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Emadadly\LaravelUuid\Uuids;
use Carbon\Carbon;
use Auth;
use App\Model\Staff\Fee\RegistraionFeeCollection;

class Student extends Authenticatable
{
    use Notifiable;

     use Uuids;

    protected $fillable = [
     //login fillable
         'reg_no', 'password','active',
   //profile fillable
          'name', 'course_id', 'created_course_id', 'date_of_admission','last_school',
          'hostel','hostel_type_id','transportation','stopage_id',
     //personal fillable     
          'father_name','mother_name','date_of_birth','gender','religion','castec','caste',
          'occupation','emer_no', 'parent_no', 'parent_email',
      //address fillable    
        'permanent_address','permanent_district_id','permanent_state_id','permanent_zip_pin','communication_address','communication_district_id','communication_state_id',
       'communication_zip_pin', 
       //profile
       'avatar','created_asession_id','bio'
    
    ];

    protected $guard = 'student';
         
   protected $dates = ['date_of_birth','date_of_admission'];

     public function setDateOfBirthAttribute($value)
    {
         //dd($value);
        $this->attributes['date_of_birth'] = Carbon::createFromFormat('d/m/Y',$value);
    }

     public function setDateOfAdmissionAttribute($value)
    {
         //dd($value);
        $this->attributes['date_of_admission'] = Carbon::createFromFormat('d/m/Y',$value);
    }

    public function owner()
    {
        return $this->belongsTo(User::Class,'user_id');
    }

     public function courses()
    {
      return $this->belongsTo(Course::Class,'course_id');
    }


    public function created_courses()
    {
        return $this->belongsTo(Course::Class,'created_course_id');
    }

    public function asessions()
    {
      return $this->belongsTo(Asession::Class,'created_asession_id');
    }

    public function hostels()
    {
        return $this->belongsTo(Hostel::Class,'hostel_type_id');
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

    public function messages()
    {
        return $this->hasMany(Message::Class)->latest();
    }

     public function feerequests()
    {
        return $this->hasMany(FeeRequest::Class,'student_id')->latest();
    }

     public function ccrequests()
    {
        return $this->hasMany(CCRequest::Class,'student_id')->latest();
    }
    

     public function feeconfirmations()
    {
        return $this->hasMany(FeeConfirmation::Class,'student_id')->latest();
    }

    public function marksheetrequests()
    {
        return $this->hasMany(MarkSheetRequest::Class,'student_id')->latest();
    }

    public function studentacadmic()
    {
        return $this->hasOne(StudentAcadmic::Class,'student_id');
    }

    public function studentattendence()
    {
        return $this->hasMany(StudentAttendence::Class,'student_id');
    }

    public function testmarks()
    {
        return $this->hasMany(TestMark::Class,'student_id');
    }

    public function exammarks()
    {
        return $this->hasMany(ExamMark::Class,'student_id');
    }

    public function tutionfeecollections()
    {
        return $this->hasMany(TutionFeeCollection::Class,'student_id');
    }

    public function transportfeecollections()
    {
        return $this->hasMany(TransportFeeCollection::Class,'student_id');
    }

    public function hostelfeecollections()
    {
        return $this->hasMany(HostelFeeCollection::Class,'student_id');
    }

    public function registraionfeecollections()
    {
        return $this->hasMany(RegistraionFeeCollection::Class,'student_id');
    }
    


    // public static function attendancestudents()
    // {
    //    $user = Auth::user();
    //    return static::whereHas('studentacadmic.courses.teacheracadmic',
    //                        function($q) use($user){
                               
    //                            $q->where('teacher_id', $user->id);
                               
    //                          })->whereHas('studentacadmic', function($q) use($user){
    //                           $q->where('section_id',$user->teacheracadmic->section_id);
    //                          })->latest()->get();
    // }

    public function isActive()
    {
        if ($this->active) {
           return true;
        }

         return false;
    }

    public function HostelTaken()
    {
        if ($this->hostel) {
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

    public function getNameAttribute($value)

    {
        return ucwords($value);
    }

    public function getFatherNameAttribute($value)

    {
        return ucwords($value);
    }

    public function getMotherNameAttribute($value)

    {
        return ucwords($value);
    }

    public function getCasteAttribute($value)

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

    protected $hidden = [
        'password', 'remember_token',
    ];
}
