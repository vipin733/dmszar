<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Jobs\SendVerificationEmail;
use App\Events\UserRegister;
use App\SchoolProfile;
use App\AppProfile;
use Carbon\Carbon;
use App\Notifications\NewUserRegister;
use App\Model\SuperAdmin\SuperAdmin;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'                 => 'required|max:255',
            'email'                => 'required|email|max:255|unique:users',
            'password'             => 'required|min:6|confirmed',
            'plan'                 => 'required|integer',
            'school_name'          => 'required',
            'mobile_no'            => 'required|digits:10|unique:users',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user =   User::create([
            'name'           => $data['name'],
            'email'          => $data['email'],
            'password'       => bcrypt($data['password']),
            'plan'           => $data['plan'],
            'mobile_no'      => $data['mobile_no'],
            'email_token'    => base64_encode($data['email']),
            'active'         => 0
        ]);


        SchoolProfile::create([
            'user_id'        => $user->id,
            'school_name'    => $data['school_name']
        ]);

        AppProfile::create([
            'user_id'        => $user->id,
            'app_name'       => $data['school_name']
        ]);


        return $user;

    }

        //     /**
        // * Handle a registration request for the application.
        // *
        // * @param \Illuminate\Http\Request $request
        // * @return \Illuminate\Http\Response
        // */
        public function register(Request $request)
        {
            $this->validator($request->all())->validate();
            event(new Registered($user = $this->create($request->all())));
            dispatch(new SendVerificationEmail($user));

              $superadmin = SuperAdmin::find(1);           
              $superadmin->notify(new NewUserRegister($user));

            flash()->success('Successfully You register,for check your email inbox, we have sent an email for email confirmation');        
            return redirect()->route('login');
        }
        /**
        * Handle a registration request for the application.
        *
        * @param $token
        * @return \Illuminate\Http\Response
        */
        public function verify($token)
        {
            $user = User::where('email_token',$token)->first();
            $user->active = 1;
            $user->trial_end_at = Carbon::now()->addDays(30)->endOfDay();
           
            if($user->save()){
            flash()->success('Congratulation! Your DMSZar account successfully activated.'); 
            return redirect()->route('login');
           }
        }
}
