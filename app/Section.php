<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Model\Staff\Acadmic\TimeTable;

class Section extends Model
{

    protected $fillable = [
        'name','remarks'
    ];
    
    //  public function teachers()
    // {
    //     return $this->belongsToMany(Teacher::class,'section_teacher')->withTimestamps();
    // }

    public function courses()
    {
        return $this->belongsToMany(Course::class,'course_section')->withTimestamps();
    }

    public function teacheracadmic()
    {
        return $this->hasMany(TeacherAcadmic::Class);
    }

    public function studentacadmic()
    {
        return $this->hasMany(StudentAcadmic::Class);
    }

    public function teacherteachingacadmic()
    {
        return $this->hasMany(TeacherTeachingAcadmic::Class);
    }

     public function timetables()
    {
        return $this->hasMany(TimeTable::Class,'section_id');
    }
}
