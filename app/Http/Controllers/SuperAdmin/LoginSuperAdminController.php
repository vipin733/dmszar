<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Auth\SuperAdmin\AuthenticatesSuperAdmins;

 class LoginSuperAdminController extends Controller
{
	 
     use AuthenticatesSuperAdmins;

     protected $redirectTo = '/superadmin/home';

      public function __construct()
    {
        $this->middleware('guest:superadmin', ['except' => 'logout']);
    }

    
}
