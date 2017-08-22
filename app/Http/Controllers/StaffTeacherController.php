<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\DataTables\DataTableBase;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\StaffRegisterTeacherForm;
use App\Http\Requests\StaffEditTeacherForm;
use App\Teacher_Staff_Attendence;
use Carbon\Carbon;
use App\Teacher;
use App\Asession;
use Auth;
use DB;

class StaffTeacherController extends Controller
{
     public function __construct()
    {
      
      $this->middleware(['auth:teacher','active','staffs']); 
                   
    }

     public function register()
    {
        $owner = Auth::user()->owner;
        $owner->load('appprofile');
        $characters = $owner->appprofile['reg_prefix_teacher'];
        $year = Carbon::now()->year;
        $regno = $characters.$year. mt_rand(10000, 99999);
        $pass = str_random(8);
        return view('staff.teachers_staff.create.teacher_staff_register',compact('regno','pass','owner'));
     }

    public function postregister(StaffRegisterTeacherForm $form)
    {
        $form->storing();

   	  	return back();
    }

     public function teachers_staffs()
    {        
      $teachers = Teacher::where('user_id',Auth::user()->owner->id)->count();   
      $years = Teacher::where('user_id',Auth::id())->orderBy('date_of_joining')->groupBy(DB::raw('YEAR(date_of_joining)'))->select('date_of_joining')->get();
        return view('staff.teachers_staff.teachers_staffs',compact('teachers','years'));
    }

     public function teachers_staffs_ajax(Request $request)
    {  
       
       $yofjoin      = $request->year_of_joining;

       $start=1;
       $userID = Auth::user()->owner->id;

      if($yofjoin){

            $query = Teacher::where('user_id',$userID)->whereYear('date_of_joining',$yofjoin);
                            
     }else {

            $query = Teacher::where('user_id',$userID);                           

          } 
        $dataTable = Datatables::of($query)
               ->editColumn('status', function ($teacher_staff) {
                    if ($teacher_staff->active == 1 ) {
                        return  'Active';
                    }else {
                        return  'Deactive';
                    }
              })->editColumn('date_of_joining', function ($user) {
               return $user->date_of_joining->format('d/m/Y');
              })->editColumn('type', function ($teacher_staff) {
                    if ($teacher_staff->type == 1 ) {
                        return  'Staff';
                    }else {
                        return  'Teacher';
                    }
              })->addColumn('profile', function ($teacher_staff) {
                  return '<a href="/st/teacher_staff/'.$teacher_staff->reg_no.'" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('Serial_No', function ($employee) use (&$start) {
                return $start++;
              })->rawColumns(['profile','Serial_No']);

      $columns = ['Serial_No','date_of_joining','name', 'reg_no','father_name', 'mother_name','status','type'];
      $base = new DataTableBase($query, $dataTable, $columns);
      return $base->render(null);

    }

    public function teacher_staff_profile($reg_no = null)
    {            
        if (Auth::guard('teacher')->check()) {
           $teacher = Teacher::where('reg_no',$reg_no)
                             ->where('user_id',Auth::user()->owner->id)
                             ->with('permanent_states','permanent_district','communication_district','communication_states','stopages')
                             ->first();
        }else{
            $teacher = Teacher::where('reg_no',$reg_no)
                             ->where('user_id',Auth::id())
                             ->with('permanent_states','permanent_district','communication_district','communication_states','stopages')
                             ->first();
        }
                  

        return view('staff.teachers_staff.teachers_staffs_profile',compact('teacher'));
    }

    public function teacher_staff_profile_edit($uuid = null, $reg_no = null)
    {
        $teacher = Teacher::where('uuid',$uuid)
                          ->where('reg_no',$reg_no)
                          ->with('permanent_states','permanent_district','communication_district','communication_states','stopages')
                          ->where('user_id',Auth::user()->owner->id)
                          ->first();

        return view('staff.teachers_staff.edit.teachers_staff_edit',compact('teacher'));
    }

     public function teacher_staff_profile_update(StaffEditTeacherForm $r)
    { 
            $r->storing();

           return redirect()->to('/st/all_teachers_staffs'); 
    }

    
}
