<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Model\Staff\Fee\RegistraionFee;

class Course extends Model
{
     protected $fillable = [
        'name','remarks'
    ];


     public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class,'course_section')->withTimestamps();
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'course_subject')->withTimestamps();
    }

    public function teacheracadmic()
    {
        return $this->hasOne(TeacherAcadmic::Class);
    }

    public function studentacadmic()
    {
        return $this->hasMany(StudentAcadmic::Class);
    }

    public function tutionfee()
    {
        return $this->hasOne(TutionFee::Class);
    }

    public function transportfee()
    {
        return $this->hasOne(TransportFee::Class);
    }

    public function registraionfee()
    {
        return $this->hasOne(RegistraionFee::Class);
    }

    public function tutionfeecollections()
    {
        return $this->hasMany(TutionFeeCollection::Class);
    }

    public function transportfeecollections()
    {
        return $this->hasMany(TransportFeeCollection::Class);
    }

    public function exammarks()
    {
        return $this->hasMany(ExamMark::Class,'course_id');
    }

    public function testmarks()
    {
        return $this->hasMany(TestMark::Class,'course_id');
    }
}
