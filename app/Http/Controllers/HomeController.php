<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Staff\Fee\RegistraionFeeCollection;
use Spatie\Sitemap\SitemapGenerator;
use App\TutionFeeCollection;
use App\TransportFeeCollection;
use App\HostelFeeCollection;
use App\Mail\Marketing;
use App\AppDistrict;
use Carbon\Carbon;
use App\Asession;
use App\Student;
use App\Query;
use Mailgun;
use Auth;
use Mail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth','');

        $this->middleware(['auth','auth_active'])->only('index');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $user = Auth::user();

         $activesession = Asession::where('user_id',$user->id)
                                        ->where('active',1)
                                        ->select('name','id')
                                        ->first();
        
        $firstsession = Asession::where('user_id',$user->id)
                                        ->select('name','id')
                                        ->latest()
                                        ->first();

        $secondsession = Asession::where('user_id',$user->id)
                                        ->select('name','id')
                                        ->latest()
                                      ->skip(1)->first();

        if ($activesession) {
               $activesessionID  = $activesession->id;      
         } else{
               
               $activesessionID  = 100000000000000000;
         }                             

        if ($firstsession) {
            $first_session[] = $firstsession->name;
            $firstsessionID = $firstsession->id;
        }else{

             $first_session[] = null;
             $firstsessionID = 100000000000000000;
        }
         
         if ($secondsession) {
              $second_session[] = $secondsession->name;
              $secondsessionID  =  $secondsession->id; 
        }else{

             $second_session[] = null;
             $secondsessionID  = 100000000000000000;
        }

         
   
         //return $secondsession;


        $user->load(['students','teachers','schoolprofile']);
        $students =  $user->students->count();
        $active_students =  $user->students->where('active',1)->count();

        $teachers =  $user->teachers->where('type',0)->count();
        $active_teachers =  $user->teachers->where('active',1)->where('type',0)->count();

        $staffs =  $user->teachers->where('type',1)->count();
        $active_staffs =  $user->teachers->where('active',1)->where('type',1)->count();




        $chart_tution_fees_firstsession= TutionFeeCollection::whereHas('asessions',function($q) use($firstsessionID){
                                      $q->where('user_id',Auth::id())
                                      ->where('id',$firstsessionID);
                                    })->where('active',1)->selectRaw('sum(`tution_fee`) as tution_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')
                                    ->groupBy('course_id')
                                    ->orderBy('course_id')
                                    ->get();
        $chart_tution_fees_secondsession= TutionFeeCollection::whereHas('asessions',function($q) use($secondsessionID){
                                      $q->where('user_id',Auth::id())
                                      ->where('id',$secondsessionID);
                                    })->where('active',1)->selectRaw('sum(`tution_fee`) as tution_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')
                                    ->groupBy('course_id')
                                    ->orderBy('course_id')
                                    ->get();

                   if (count($chart_tution_fees_firstsession)) {
                        foreach ($chart_tution_fees_firstsession as $key => $value) {
                          $charttutionfeesfirstsession[] = $value->tution_fee + $value->late_fee + $value->other_fee;

                        }
                    }else{
                        $charttutionfeesfirstsession[] = [null];
                    }

                   if (count($chart_tution_fees_secondsession)) {
                        foreach ($chart_tution_fees_secondsession as $key => $value) {
                          $charttutionfeessecondsession[] = $value->tution_fee + $value->late_fee + $value->other_fee;

                        }
                    }else{
                        $charttutionfeessecondsession[] = [null];
                    }


        $chart_transport_fees_firstsession= TransportFeeCollection::whereHas('asessions',function($q) use($firstsessionID){
                                      $q->where('user_id',Auth::id())
                                      ->where('id',$firstsessionID);
                                    })->where('active',1)->selectRaw('sum(`transport_fee`) as transport_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')
                                    ->groupBy('course_id')
                                    ->orderBy('course_id')
                                    ->get();
        $chart_transport_fees_secondsession= TransportFeeCollection::whereHas('asessions',function($q) use($secondsessionID){
                                      $q->where('user_id',Auth::id())
                                      ->where('id',$secondsessionID);
                                    })->where('active',1)->selectRaw('sum(`transport_fee`) as transport_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')
                                    ->groupBy('course_id')
                                    ->orderBy('course_id')
                                    ->get();
                   if (count($chart_transport_fees_firstsession)) {
                        foreach ($chart_transport_fees_firstsession as $key => $value) {
                          $charttransportfeesfirstsession[] = $value->transport_fee + $value->late_fee + $value->other_fee;

                        }
                    }else{
                        $charttransportfeesfirstsession[] = [null];
                    }

                   if (count($chart_transport_fees_secondsession)) {
                        foreach ($chart_transport_fees_secondsession as $key => $value) {
                          $charttransportfeessecondsession[] = $value->transport_fee + $value->late_fee + $value->other_fee;

                        }
                    }else{
                        $charttransportfeessecondsession[] = [null];
                    }


        $chart_registraion_fees_firstsession= RegistraionFeeCollection::whereHas('asessions',function($q) use($firstsessionID){
                                      $q->where('user_id',Auth::id())
                                      ->where('id',$firstsessionID);
                                    })->where('active',1)->selectRaw('sum(`registraion_fee`) as registraion_fee, sum(`late_fee`) as late_fee')
                                    ->groupBy('course_id')
                                    ->orderBy('course_id')
                                    ->get();
        $chart_registraion_fees_secondsession= RegistraionFeeCollection::whereHas('asessions',function($q) use($secondsessionID){
                                      $q->where('user_id',Auth::id())
                                      ->where('id',$secondsessionID);
                                    })->where('active',1)->selectRaw('sum(`registraion_fee`) as registraion_fee, sum(`late_fee`) as late_fee')
                                    ->groupBy('course_id')
                                    ->orderBy('course_id')
                                    ->get();
                   if (count($chart_registraion_fees_firstsession)) {
                        foreach ($chart_registraion_fees_firstsession as $key => $value) {
                          $chartregistraionfeesfirstsession[] = $value->registraion_fee + $value->late_fee;

                        }
                    }else{
                        $chartregistraionfeesfirstsession[] = [null];
                    }

                   if (count($chart_registraion_fees_secondsession)) {
                        foreach ($chart_registraion_fees_secondsession as $key => $value) {
                          $chartregistraionfeessecondsession[] = $value->registraion_fee + $value->late_fee;

                        }
                    }else{
                        $chartregistraionfeessecondsession[] = [null];
                    }


        $chart_hostel_fees_firstsession= HostelFeeCollection::whereHas('asessions',function($q) use($firstsessionID){
                                      $q->where('user_id',Auth::id())
                                      ->where('id',$firstsessionID);
                                    })->where('active',1)->selectRaw('sum(`hostel_fee`) as hostel_fee, sum(`late_fee`) as late_fee')
                                    ->groupBy('course_id')
                                    ->orderBy('course_id')
                                    ->get();
        $chart_hostel_fees_secondsession= HostelFeeCollection::whereHas('asessions',function($q) use($secondsessionID){
                                      $q->where('user_id',Auth::id())
                                      ->where('id',$secondsessionID);
                                    })->where('active',1)->selectRaw('sum(`hostel_fee`) as hostel_fee, sum(`late_fee`) as late_fee')
                                    ->groupBy('course_id')
                                    ->orderBy('course_id')
                                    ->get();
                   if (count($chart_hostel_fees_firstsession)) {
                        foreach ($chart_hostel_fees_firstsession as $key => $value) {
                          $charthostelfeesfirstsession[] = $value->hostel_fee + $value->late_fee;

                        }
                    }else{
                        $charthostelfeesfirstsession[] = [null];
                    }

                   if (count($chart_hostel_fees_secondsession)) {
                        foreach ($chart_hostel_fees_secondsession as $key => $value) {
                          $charthostelfeessecondsession[] = $value->hostel_fee + $value->late_fee;

                        }
                    }else{
                        $charthostelfeessecondsession[] = [null];
                    }
             // return $charthostelfeesfirstsession;


                $feesfirstsession = array_map(function () {
                    return array_sum(func_get_args());
                }, $charttutionfeesfirstsession, $charttransportfeesfirstsession, $chartregistraionfeesfirstsession, $charthostelfeesfirstsession);

                $feessecondsession = array_map(function () {
                    return array_sum(func_get_args());
                }, $charttutionfeessecondsession, $charttransportfeessecondsession, $chartregistraionfeessecondsession, $charthostelfeessecondsession);

        $feesfirstsession =  array_map(function ($a) { return round($a / 1000, 2); }, $feesfirstsession);
        $feessecondsession =  array_map(function ($a) { return round($a / 1000, 2); }, $feessecondsession);





        $tution_fees= TutionFeeCollection::whereHas('asessions',function($q) use($activesessionID){
                                      $q->where('user_id',Auth::id())
                                      ->where('id',$activesessionID);
                                    })->where('active',1)->selectRaw('sum(`tution_fee`) as tution_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')->first();

        $total_tution_fee = $tution_fees->tution_fee +  $tution_fees->late_fee +  $tution_fees->other_fee;

        $registration_fees= RegistraionFeeCollection::whereHas('asessions',function($q) use($activesessionID){
                                      $q->where('user_id',Auth::id())
                                      ->where('id',$activesessionID);
                                    })->where('active',1)->selectRaw('sum(`registraion_fee`) as registraion_fee, sum(`late_fee`) as late_fee')->first();

        $total_registration_fee = $registration_fees->registraion_fee +  $registration_fees->late_fee ;

        $transport_fees= TransportFeeCollection::whereHas('asessions',function($q) use($activesessionID){
                                      $q->where('user_id',Auth::id())
                                      ->where('id',$activesessionID);
                                    })->where('active',1)->selectRaw('sum(`transport_fee`) as transport_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')->first();
        $total_transport_fee = $transport_fees->transport_fee +  $transport_fees->late_fee +  $transport_fees->other_fee;

        $hostel_fees= HostelFeeCollection::whereHas('asessions',function($q) use($activesessionID){
                                      $q->where('user_id',Auth::id())
                                      ->where('id',$activesessionID);
                                    })->where('active',1)->selectRaw('sum(`hostel_fee`) as hostel_fee, sum(`late_fee`) as late_fee, sum(`other_fee`) as other_fee')->first();

        $total_hostel_fee = $hostel_fees->hostel_fee +  $hostel_fees->late_fee +  $hostel_fees->other_fee;







        $total_firstsession_student = Student::selectRaw("count(id) as tot_student")
                                        ->orderBy('created_course_id')
                                        //->groupBy('id')
                                        ->groupBy('created_course_id')
                                        ->where('user_id',Auth::id())
                                        ->where('created_asession_id',$firstsessionID)
                                        ->get();
        $total_secondsession_student = Student::selectRaw("count(id) as tot_student")
                                        ->orderBy('created_course_id')
                                        //->groupBy('id')
                                        ->groupBy('created_course_id')
                                        ->where('user_id',Auth::id())
                                        ->where('created_asession_id',$secondsessionID)
                                        ->get();

        $total_courses = Student::orderBy('created_course_id')
                                        //->groupBy('id')
                                        ->groupBy('created_course_id')
                                        ->where('user_id',Auth::id())
                                        ->orWhere('created_asession_id',$firstsessionID)
                                        ->orWhere('created_asession_id',$secondsessionID)
                                         ->with('created_courses')->get();

                    if (count($total_firstsession_student)) {
                        foreach ($total_firstsession_student as $key => $value) {
                          $firstsession_students[] = $value->tot_student;

                        }
                    }else{
                        $firstsession_students[] = [null];
                    }

                    //return  $firstsession_students;

                    if (count($total_secondsession_student)) {
                        foreach ($total_secondsession_student as $key => $value) {
                          $secondsession_students[] = $value->tot_student;

                        }
                    }else{
                        $secondsession_students[] = [null];
                    }

                   // return $secondsession_students;

                    if (count($total_courses)) {
                        foreach ($total_courses as $key => $value) {
                          $course_names[] = $value->created_courses->name;

                        }
                    }else{
                        $course_names[] = [null];
                    }


        return view('home',compact('user','students','active_students','teachers','active_teachers','staffs','active_staffs','activesession','total_tution_fee','total_registration_fee','total_transport_fee','total_hostel_fee'))
                    ->with('firstsession_students',json_encode($firstsession_students))
                    ->with('secondsession_students',json_encode($secondsession_students))
                    ->with('feesfirstsession',json_encode($feesfirstsession))
                    ->with('feessecondsession',json_encode($feessecondsession))
                    ->with('course_names',json_encode($course_names))
                    ->with('first_session',json_encode($first_session))
                    ->with('second_session',json_encode($second_session));
    }

    public function welcome()
    {
       //Mail::to('qbsc@hotmail.com')->send(new Marketing);
       //return 'done';

     //    $data = [];

     //   Mailgun::send('emails.school', $data, function ($message) {
     //     $message->to('vipinoo7@yahoo.in', 'John Smith')->subject('Welcome!');
     // });
//enquirybillabong@gmail.com
      //  $mgClient = new Mailgun('key-9b353c37873896aa9087fcfc4bd9cf6d');
      // $domain = "mg.dmszar.com";

      // # Make the call to the client.
      // $result = $mgClient->sendMessage("$domain",
      //   array('from'    => 'Excited User <excited@samples.mailgun.org>',
      //         'to'      => 'Mailgun Devs <vipinoo7@yahoo.in>',
      //         'subject' => 'Hello',
      //         'text'    => 'Testing some Mailgun awesomeness!'));



      //  return 'done';

       // $path= 'public/';
        // $path =  public_path('image');

      //SitemapGenerator::create('https://dmszar.com')->writeToFile(public_path('sitemap.xml'));
      return view('product.pages.welcome');
    }

    public function help()
    {       
       return view('auth.home.instruction');
    }

    public function features()
    {
        return view('product.pages.features');
    }


    public function pricing()
    {
        return view('product.pages.pricing');
    }

    public function about()
    {
        return view('product.pages.about');
    }


    public function contact()
    {
        return view('product.pages.contact_us');
    }

     public function privacy_policy()
    {
        return view('product.pages.privacy_policy');
    }

     public function terms_conditions()
    {
        return view('product.pages.terms_conditions');
    }

    public function contact_post(Request $r)
    {
         $this->validate($r,[
            'name'              =>      'required',
            'email'             =>      'required|email',
            'message'           =>      'required'
        ]);

        Query::create($r->all());

        flash('Thanks for asking, we will shortly response you!')->overlay();

        return back();
    }

     public function subscription_post(Request $r)
    {
         $this->validate($r,[
            'email'             =>      'required|email'
        ]);

        Query::create($r->all());

        //flash()->success('');
        flash('Thanks for subscribe')->overlay();

        return back();
    }

     public function city_state_ajax($id)
    {

        $districs = AppDistrict::whereHas('states', function($q) use($id){
                              $q->where('id',$id);
                            })->orderBy('created_at','DESC')->pluck('id','name');

        return json_encode($districs);    
    }

}
