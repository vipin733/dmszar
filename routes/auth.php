<?php

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

Route::group(['middleware' => 'revalidate'],function()
{

Route::get('/home', 'HomeController@index');
Route::get('/auth/help', 'HomeController@help');

Route::get('/auth/password/change', 'Auth\AuthChangePasswordController@password_change');
Route::PATCH('/auth/password/change', 'Auth\AuthChangePasswordController@password_change_update');	

Route::get('/auth/profile', 'Auth\AuthProfileController@auth_profile');
Route::PATCH('/auth/profile/personal/update', 'Auth\AuthProfileController@auth_profile_personal_update');
Route::get('/auth/school_profile', 'Auth\AuthProfileController@auth_school_profile');
Route::get('/auth/school_profile/edit', 'Auth\AuthProfileController@auth_school_profile_edit');
Route::PATCH('/auth/school_profile/update', 'Auth\AuthProfileController@auth_school_profile_update');
Route::get('/auth/app_profile', 'Auth\AuthProfileController@auth_app_profile');
Route::get('/auth/app/profile/edit', 'Auth\AuthProfileController@app_profile_edit');
Route::PATCH('/auth/app/profile/update', 'Auth\AuthProfileController@app_profile_update');
Route::PATCH('/auth/auth_logo_update', 'Auth\AuthProfileController@auth_logo_update');

Route::get('/student/register', 'Auth\Student\AuthStudentController@register');
Route::post('/student/register', 'Auth\Student\AuthStudentController@postregister');
Route::get('/student/{reg_no}', 'Auth\Student\AuthStudentController@students_profile');
Route::get('/student/profile/{uuid}/{reg_no}/update', 'Auth\Student\AuthStudentController@profile_edit');
Route::PATCH('/student/profile/{uuid}/{reg_no}/update', 'Auth\Student\AuthStudentController@profile_update');

Route::get('/auth/all_students', 'Auth\Student\StudentViewController@students');
Route::get('/auth/all_students/ajax', 'Auth\Student\StudentViewController@students_ajax');


Route::get('/teacher/register', 'Auth\TeacherStaff\AuthTeacherStaffController@register');
Route::get('/teacher/{reg_no}', 'Auth\TeacherStaff\AuthTeacherStaffController@teachers_profile');
Route::post('/teacher/register', 'Auth\TeacherStaff\AuthTeacherStaffController@postregister');
Route::get('/teacher/profile/{uuid}/{reg_no}/update', 'Auth\TeacherStaff\AuthTeacherStaffController@profile_edit');
Route::PATCH('/teacher/profile/{uuid}/{reg_no}/update', 'Auth\TeacherStaff\AuthTeacherStaffController@profile_update');

Route::get('/auth/all_teachers_staff', 'Auth\TeacherStaff\TeacherStaffViewController@teachers');
Route::get('/auth/all_teachers_staff/ajax', 'Auth\TeacherStaff\TeacherStaffViewController@teachers_ajax');

Route::resource('auth/courses_auth','Auth\Add\AuthAddCourseController',['except'=>['index','show','destroy','edit']]);
Route::resource('auth/asessions_auth','Auth\Add\AuthAddAsessionController',['except'=>['index','show','destroy','edit']]);
Route::resource('auth/districts_auth','Auth\Add\AuthAddDistrictController',['except'=>['index','show','destroy','edit']]);
Route::resource('auth/stopages_auth','Auth\Add\AuthAddStopagesController',['except'=>['index','show','destroy','edit']]);
Route::resource('auth/hostels_auth','Auth\Add\AuthAddHostelController',['except'=>['index','show','destroy','edit']]);
Route::resource('auth/busdetails_auth','Auth\Add\AuthAddBusDetailController',['except'=>['index','show','destroy','edit']]);

Route::get('/auth/resete/student','Auth\AuthResetPasswordController@auth_student_reset');
Route::PATCH('/auth/resete/student','Auth\AuthResetPasswordController@auth_student_reset_update');
Route::get('/auth/resete/teacher_staff','Auth\AuthResetPasswordController@auth_teacher_staff_reset');
Route::PATCH('/auth/resete/teacher_staff','Auth\AuthResetPasswordController@auth_teacher_staff_reset_update');

Route::get('/auth/bank_details/get','Auth\AuthBankAppDetailController@bank_details');
Route::post('/auth/bank_details/post','Auth\AuthBankAppDetailController@bank_details_post');
Route::PATCH('/auth/bank_details/{bankdetail}/{created_at}/update','Auth\AuthBankAppDetailController@bank_details_update');
Route::DELETE('/auth/bank_details/{bankdetail}/{created_at}/delete','Auth\AuthBankAppDetailController@bank_details_destroy')->name('bank_details_delete');
Route::get('/auth/app_details/get','Auth\AuthBankAppDetailController@app_details');
Route::post('/auth/app_details/post','Auth\AuthBankAppDetailController@app_details_post');
Route::PATCH('/auth/app_details/{appdetail}/{created_at}/update','Auth\AuthBankAppDetailController@app_details_update');
Route::DELETE('/auth/app_details/{appdetail}/{created_at}/delete','Auth\AuthBankAppDetailController@appp_details_destroy')->name('app_details_delete');


 Route::get('/auth/student/attendence/{reg_no}/details','Auth\Student\AuthStudentProfileController@attendence_details_students');
Route::get('/auth/student/course_profile/{reg_no}','Auth\Student\AuthStudentProfileController@course_profile');
Route::get('/auth/student/test_marks/{reg_no}/get_sessesion','Auth\Student\AuthStudentProfileController@get_sessesion_test_mark');
Route::get('/auth/student/{asession}/{created_at}/test_marks/{reg_no}/get_test_marks','Auth\Student\AuthStudentProfileController@get_test_marks');
Route::get('/auth/student/exam_marks/{reg_no}/get_sessesion','Auth\Student\AuthStudentProfileController@get_sessesion_exam_mark');
Route::get('/auth/student/{asession}/{created_at}/exam_marks/{reg_no}/get_exam_marks','Auth\Student\AuthStudentProfileController@get_exam_marks');
Route::get('/auth/student/get_grades/{reg_no}','Auth\Student\AuthStudentProfileController@get_grades');
Route::get('/auth/student/fee_confirmation_requests/{reg_no}','Auth\Student\AuthStudentProfileController@fee_confirmation_requests');
Route::get('/auth/student/fee_requests/{reg_no}','Auth\Student\AuthStudentProfileController@fee_fee_requests');
Route::get('/auth/student/marksheet_requests/{reg_no}','Auth\Student\AuthStudentProfileController@marksheet_requests');
Route::get('/auth/student/certificate_requests/{reg_no}','Auth\Student\AuthStudentProfileController@certificate_requests');
Route::get('/auth/student/log_requests/{reg_no}','Auth\Student\AuthStudentProfileController@log_requests');

Route::get('/auth/mysubscription','Auth\Subscription\AuthSubscriptionController@mysubscription');
Route::PATCH('/auth/plan/update','Auth\Subscription\AuthSubscriptionController@plan_update');
Route::get('/auth/bill','Auth\Subscription\AuthSubscriptionController@bill');
Route::get('/auth/bill/details','Auth\Subscription\AuthSubscriptionController@bill_details');
Route::get('/auth/bill/pay-online','Auth\Subscription\AuthSubscriptionController@pay_online');
Route::get('/auth/bill/online-confirmation','Auth\Subscription\AuthSubscriptionController@online_confirmation');
Route::post('/auth/bill/online-confirmation','Auth\Subscription\AuthSubscriptionController@online_confirmation_save');
Route::PATCH('/auth/bill/online-confirmation/{uuid}/update','Auth\Subscription\AuthSubscriptionController@online_confirmation_update');
Route::get('/auth/bill/{uuid}/{month}/invoice','Auth\Subscription\AuthSubscriptionController@bill_invoice');
//Route::get('/auth/bill/test','Auth\Subscription\AuthSubscriptionController@bill_details_test');

Route::get('/auth/send-message','Auth\Message\AuthMessageController@send_message');
Route::post('/auth/send-message','Auth\Message\AuthMessageController@send_message_post');

Route::get('/auth/{uuid}/{reg_no}/student/fee/status', 'Auth\Student\Fee\Status\AuthStudentFeeStatusController@fee_status');


Route::get('/auth/events/view', 'Auth\Event\EventViewController@event_view');
Route::get('/auth/events/view/calender', 'Auth\Event\EventViewController@event_view_calendor');



});

Route::get('/auth/bill/{uuid}/{month}/invoice/print','Auth\Subscription\AuthSubscriptionController@print_bill_invoice');
Route::get('/auth/bill/{uuid}/{month}/invoice/download','Auth\Subscription\AuthSubscriptionController@download_bill_invoice');

Route::get('/auth/ooops', function(){
    return view('error.error');
})->middleware('auth');