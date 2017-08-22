<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\DataTables\DataTableBase;
use App\Model\Auth\UserInvoice;
use App\User;
use Auth;
class SuperAdminController extends Controller
{
	 public function __construct()
    {
	  
        $this->middleware(['auth:superadmin']); 

    }

    public function home()
    {

     	return view('superadmin.home');
     	
    }

    public function users()
    {
        $users = User::count();
        return view('superadmin.users.all_users',compact('users'));
        
    }

    public function users_ajax(Request $request)
    {        
        $start = 1;
    $query = User::with('schoolprofile','schoolprofile.appdistricts')->select('name','plan','id','uuid','active');
      
    $dataTable = Datatables::of($query)
              ->editColumn('active', function ($user) {
                    if ($user->active == 1 ) {
                        return  'Active';
                    }else {
                        return  'Deactive';
                    }
              })->editColumn('plan', function ($user) {
                    if ($user->plan == 1 ) {
                        return  'Basic';
                    }else {
                        return  'Free';
                    }
              })->addColumn('profile', function ($user) {
                  return '<a href="/superadmin/'.$user->id.'/profile" class="btn btn-sm btn-primary"><i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i></a>';
              })->addColumn('Serial_No', function ($employee) use (&$start) {
                return $start++;
              })->rawColumns(['profile','Serial_No']);

      $columns = ['Serial_No', 'id', 'name', 'schoolprofile.school_name','schoolprofile.appdistricts.name','active',];
      $base = new DataTableBase($query, $dataTable, $columns);
      return $base->render(null);

    }

    public function user_profile($user = null)
    {
        $user = User::where('id',$user)->with('schoolprofile','schoolprofile.appdistricts','schoolprofile.states','schoolprofile.schoolboards','appprofile','students','teachers','appprofile')->first();

        $students =  $user->students->count();
        $active_students =  $user->students->where('active',1)->count();

        $teachers =  $user->teachers->where('type',0)->count();
        $active_teachers =  $user->teachers->where('active',1)->where('type',0)->count();

        $staffs =  $user->teachers->where('type',1)->count();
        $active_staffs =  $user->teachers->where('active',1)->where('type',1)->count();

        return view('superadmin.users.user_profile',compact('user','students','active_students','teachers','active_teachers','staffs','active_staffs'));
    }

    public function user_invoices($user = null)
    {
        $user = User::where('id',$user)->with('invoices','invoices.billconfirmation')->first();

        return view('superadmin.users.invoices.user_invoices',compact('user'));
    }

    public function invoice_confirm(Request $r, $uuid = null)
    { 
        

        $this->validate($r,[
            
            'payment_method'                => 'required',
            'payment_date'                  => 'required|date_format:d/m/Y',
            'payment_amount'                => 'required',

        ]);

            $payment_date = $r->payment_date;
            $paymentdate  = str_replace('/', '-', $payment_date);
            $date = date('Y-m-d', strtotime($paymentdate));

           //return  $date; 

        $userinvoice = UserInvoice::where('uuid',$uuid)->first();
        $data = [
          'payment_method'       => $r->payment_method,
          'payment_date'         => $date,
          'remarks'              => $r->remarks,
          'payment_amount'       => $r->payment_amount,
          'payment_status'       => 1,
          'updated_by_id'        => Auth::id()
        ];

        $userinvoice->update($data);

        flash()->success('Successfully Updated!');
       
        return back();
    }
}
