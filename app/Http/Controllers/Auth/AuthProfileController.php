<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Flysystem\Filesystem;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\AuthSchoolProfileRequest;
use Illuminate\Support\Facades\Storage;
use App\User;
use Auth;

class AuthProfileController extends Controller
{
     public function __construct()
    {
       
        $this->middleware(['auth','auth_active']);
            
    }
     
     public function auth_profile()
    {
    	$user = Auth::user();

    	$user->load('schoolprofile','schoolprofile.states','schoolprofile.appdistricts','appprofile');

     	return view('auth.stuff.profile',compact('user'));
    }


    public function auth_profile_personal_update(Request $request)
    {  

         $this->validate($request,[
            'name'       =>     'required',
            'email'      =>     'required|email|exists:users,email',
            'mobile_no'  =>     'required|digits:10|exists:users,mobile_no'
        ]);

    	 Auth::user()->update($request->all());

        flash('Successfully Information Updated!')->success(); 

    	return redirect()->to('/auth/profile'); 
    }

    public function auth_school_profile()
    {
      $user = Auth::user();

      $user->load('schoolprofile','schoolprofile.states','schoolprofile.appdistricts','schoolprofile.schoolboards');

      return view('auth.stuff.edit.school_profile.school_profile',compact('user'));
    }

    public function auth_school_profile_edit()
    { 
    	$user = Auth::user();

    	$user->load('schoolprofile','schoolprofile.states','schoolprofile.appdistricts','schoolprofile.schoolboards');
    	
    	return view('auth.stuff.edit.school_profile.get_school_profile',compact('user'));
    }


    public function auth_school_profile_update(AuthSchoolProfileRequest $form)
    { 
          
        $form->storing();

    	 return redirect()->to('/auth/school_profile'); 
    }

      public function auth_logo_update(Request $request)
    {
       
        $this->validate($request,[
            'logo'               =>     'required|image|max:10240',
        ]);

        if ($request->hasFile('logo')) {
          
        $filename = time() . ".jpg";
        // Get the storage disk
        $id = Auth::id();
        // Resize the photo
        $image = Image::make($request->file('logo'));
        $image->orientate();
        $image->resize(120, 120);
        $image->encode('jpg');
        // Save the photo to the disk
        Storage::disk('s3')->put("logo/$id/$filename", $image->__toString());

        $data = ['logo' =>'https://s3.ap-south-1.amazonaws.com/dbmszar/logo'.'/'.$id.'/'. $filename];

        }
                               
        Auth::user()->schoolprofile()->update($data);

        flash('Successfully Information Updated!')->success(); 

        return redirect()->to('/auth/school_profile'); 

    }

    public function auth_app_profile()
    {
      $user = Auth::user();

      $user->load('appprofile');

      return view('auth.stuff.edit.app_profile.app_profile',compact('user'));
    }

    public function app_profile_edit()
    {
        $user = Auth::user();

        $user->load('appprofile');

        return view('auth.stuff.edit.app_profile.app_profile_edit',compact('user'));
    }

     public function app_profile_update(Request $request)
    { 

        $this->validate($request,[
            'app_name'               =>     'required|string|max:30',
            'reg_prefix_student'     =>     'required|string|max:4|min:2',
            'reg_prefix_teacher'     =>     'required|string|max:4|min:2'
        ]);
                      
        Auth::user()->appprofile()->update($request->only(['app_name','reg_prefix_student','reg_prefix_teacher']));

        flash('Successfully Information Updated!')->success(); 

        return redirect()->to('/auth/app_profile'); 
    }

  
}
