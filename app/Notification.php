<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Notification extends Model
{


    protected $fillable = [
        'title','notification_category_id','notification_body','slug'
    ];

    public function owner()
    {
        return $this->belongsTo(User::Class,'user_id');
    }

    public function notifications_categories()
    {
        return $this->belongsTo(Notification_Category::Class,'notification_category_id');
    }

      public function scopeFilter($filterQuery, Request $request)
    {

        if ($request->from) {
            $s = str_replace('/', '-', $request->from);
            $start = date('Y-m-d', strtotime($s));

           $filterQuery->whereDate('created_at','>=',$start);
        }

        if ($request->to) {

            $t = str_replace('/', '-', $request->to);
            $end = date('Y-m-d', strtotime($t));

           $filterQuery->whereDate('created_at','<=',$end);
        }


         if ($request->category) {
           $filterQuery->where('notification_category_id',$request->category);
        }

        return $filterQuery;
    }
}
