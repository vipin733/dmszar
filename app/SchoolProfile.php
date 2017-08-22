<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
   protected $fillable = [
        'school_name', 'school_address','city','state_id','district_id','pincode','campuse_type','main_campuse','hostel_service','hostel_type','transport_service','user_id','school_board_id','affiliation_no','school_code_no','website','school_email','telephone_no','mobile_no','logo'
    ];


     public function states()
    {
        return $this->belongsTo(State::class,'state_id');
    }


     public function appdistricts()
    {
        return $this->belongsTo(AppDistrict::class,'district_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }


     public function schoolboards()
    {
        return $this->belongsTo(SchoolBoard::class,'school_board_id');
    }

    public function getSchoolNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getCityAttribute($value)
    {
        return ucwords($value);
    }

    public function getSchoolAddressAttribute($value)
    {
        return ucwords($value);
    }

}
