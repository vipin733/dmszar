<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Staff\Acadmic\TimeTable;
use App\Model\Staff\Acadmic\LunchTime;

class Day extends Model
{
    protected $fillable = [
       'name'
    ];

    // public function timetables()
    // {
    //     return $this->hasMany(TimeTable::Class,'day_id');
    // }

    public function weeklyoff()
    {
        return $this->hasMany(LunchTime::Class,'day_id');
    }
}
