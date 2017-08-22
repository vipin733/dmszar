<?php

namespace App\Http\Controllers\Auth\TeacherStaff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\DataTables\DataTableBase;
use App\Teacher;
use App\Asession;
use Auth;
use DB;


class TeacherStaffViewController extends Controller
{
    public function __construct()
    {
       
        $this->middleware(['auth','auth_active']);
            
    }

      public function teachers()
    {   
       $teachers = Teacher::where('user_id',Auth::id())->count();     
       $years = Teacher::where('user_id',Auth::id())->orderBy('date_of_joining')->groupBy(DB::raw('YEAR(date_of_joining)'))->select('date_of_joining')->get();

     //return $years;

        
        return view('auth.teachers.teachers',compact('teachers','years'));
    }

    public function teachers_ajax(Request $request)
    {
    	$yofjoin      = $request->year_of_joining;

    	$start=1;
    	 $userID = Auth::user()->id;

		if($yofjoin){

		        $query = Teacher::where(function($q) use($userID,$yofjoin){
	                                $q->where('user_id',$userID)
	                                ->whereYear('date_of_joining',$yofjoin);
		                         });
		 }else {


		        $query = Teacher::where(function($q) use($userID){
	                                $q->where('user_id',$userID);
		                         });

		    } 


	      $dataTable = Datatables::of($query)
	             ->addColumn('profile', function ($teacher) {
                  return '<a href="/teacher/'.$teacher->reg_no.'" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->editColumn('date_of_joining', function ($user) {
               return $user->date_of_joining->format('d/m/Y');
              })->editColumn('active', function ($user) {
	               if ($user->active == 1) {
	                return 'Active';
	              }else {
	                return 'DeActivede';
	              };
              })->editColumn('type', function ($user) {
	               if ($user->type == 1) {
	                return 'Staff';
	              }else {
	                return 'Teacher';
	              };
              })->addColumn('Serial_No', function ($query) use (&$start) {
                return $start++;
              })->rawColumns(['profile','Serial_No']);          

	      $columns = ['Serial_No','date_of_joining','name', 'reg_no','father_name', 'mother_name','type','active'];
	      $base = new DataTableBase($query, $dataTable, $columns);
	      return $base->render(null);

    }
}


