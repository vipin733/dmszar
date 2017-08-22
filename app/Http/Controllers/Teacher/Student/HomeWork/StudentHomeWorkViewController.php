<?php

namespace App\Http\Controllers\Teacher\Student\HomeWork;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Teacher\Student\StudentHomeWork;
use Auth;
class StudentHomeWorkViewController extends Controller
{

	 public function __construct()
    {
	  
        $this->middleware(['auth:teacher','active','teachers']); 

    }

    public function homework_index(Request $request)
    {    
        $homework = StudentHomeWork::filter($request)->whereHas('teachers',function($q){
                                $q->where('user_id',Auth::user()->owner->id)
                                  ->where('id',Auth::id());
                             })->with('courses','sections','subjects','asessions')->latest(); 

        $homeworks = $homework->paginate(10);

        $homeworkcount = $homework->get()->count();

        return view('teacher.student.homework.view.homework_index',compact('homeworks','homeworkcount'));                                                                 
    }

    public function homework_show(Request $request ,$homework = null)
    {    

        $homework = StudentHomeWork::where('id',$homework)->whereHas('teachers',function($q){
                                $q->where('user_id',Auth::user()->owner->id)
                                  ->where('id',Auth::id());
                             })->with('courses','sections','subjects','asessions')->first(); 

       // return $homework;

        return view('teacher.student.homework.view.homework_show',compact('homework'));                                                                 
    }
}
