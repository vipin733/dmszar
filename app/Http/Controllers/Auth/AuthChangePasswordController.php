<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Hash;

class AuthChangePasswordController extends Controller
{
    public function __construct()
    {

      $this->middleware(['auth','auth_active']);
         
    }

    public function password_change()
    {
    	return view('auth.passwords.auth_change_password');
    }

    public function password_change_update(Request $r)
    {
         $this->validate($r,[

            'current_password'     =>        'required|min:6',
            'new_password'         =>        'required|min:6',
            'confirm_password'     =>  'required|same:new_password'
        ]);

         $oldpass     = $r->current_password;
         $newpass     = $r->new_password;
         $user        = Auth::user();

         if (Hash::check($oldpass,$user->password)) {

             if (!Hash::check($newpass,$user->password)) {             

                 $user->password = Hash::make($newpass);

                 $user->save();

                flash()->success('Successfully Password Change');

                return redirect()->to('/home');

             }
                 
                flash('Oops/Your new password should be differnet from current password! Try Again', 'danger');

                return redirect()->back()->withInput($r->only('current_password','new_password'));
                       
         }else{

         flash('Oops/Your enter current password did not match to current password! Try Again!', 'danger');

         return redirect()->back()->withInput($r->only('current_password','new_password'));

         }
    }
}
