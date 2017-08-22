<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Auth;
use Hash;
use App\Teacher;


class TeacherController extends Controller
{

     public function __construct()

    {
       $this->middleware('guest:teacher')->only('login','postlogin');
       
    }

   

    public function login()
    {
    	return view('teacher.teacher_login');
     }

     public function postlogin(Request $r)
     {
         $this->validate($r,[

            'reg_no' =>       'required',
            'password' =>      'required|min:6'
   	  	]);


         $crendential = [
         'reg_no' => $r->reg_no,
         'password' => $r->password,
         ];

         if (Auth::guard('teacher')->attempt($crendential ,$r->remember))

          {
            $user = Teacher::where('reg_no',$r->reg_no)->first();
         	if ($user->isStaff()) {
               flash()->success('Successfully Login');
               return redirect()->intended('/staff');
            }
            flash()->success('Successfully Login');
         	return redirect()->intended('/teacher');
         }

         flash('Reg. No./Password wrong or Account not activated.', 'danger');

         return redirect()->back()->withInput($r->only('reg_no','remember'));
     }


     public function changeget()
    {
        return view('teacher.teacher_change_password');
    }

    public function changepost(Request $r)
    {
        $this->validate($r,[

            'old_password'         =>        'required|min:6',
            'new_password'         =>        'required|min:6',
            'confirm_password'     =>  'required|same:new_password'
        ]);

         $oldpass     = $r->old_password;
         $newpass     = $r->new_password;
         $user        = Auth::user();

         if (Hash::check($oldpass,$user->password)) {

             if (!Hash::check($newpass,$user->password)) {

                 $user->password = Hash::make($newpass);

                 $user->save();

                flash()->success('Successfully Password Change');
                if ($user->isStaff()) {
                    return redirect()->to('/staff');
                }else{
                    return redirect()->to('/teacher');
                }
                

             }

                flash('Oops/Your new password should be differnet from old password! Try Again', 'danger');

                return redirect()->back()->withInput($r->only('old_password','new_password'));

         }else{

         flash('Oops/Your new password did not match to old to password! Try Again!', 'danger');

         return redirect()->back()->withInput($r->only('old_password','new_password'));

         }


    }

    public function oops()
    {
    	return view('error.error');
    }

}
