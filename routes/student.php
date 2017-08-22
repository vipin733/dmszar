<?php

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/slogin', function () {
    return view('student.student_login');
})->name('student.login');

Route::post('/student/login', 'Student\StudentController@postlogin');

Route::get('/student/tution/{tutionfee}/{created_at}/fee_receipt/print', 'Student\Fee\StudentTutionFeeController@tution_fee_receipt_print');
Route::get('/student/tution/{tutionfee}/{created_at}/fee_receipt/download', 'Student\Fee\StudentTutionFeeController@tution_fee_receipt_download');

Route::get('/student/transport/{transportfee}/{created_at}/fee_receipt/print', 'Student\Fee\StudentTransportFeeController@transport_fee_receipt_print');
Route::get('/student/transport/{transportfee}/{created_at}/fee_receipt/download', 'Student\Fee\StudentTransportFeeController@transport_fee_receipt_download');

Route::get('/student/registraion/{registraionfee}/{created_at}/fee_receipt/print', 'Student\Fee\StudentRegistrationFeeController@registraion_fee_receipt_print');
Route::get('/student/registraion/{registraionfee}/{created_at}/fee_receipt/download', 'Student\Fee\StudentRegistrationFeeController@registraion_fee_receipt_download');

Route::get('/student/hostel/{hostelfee}/{created_at}/fee_receipt/print', 'Student\Fee\StudentHostelFeeController@hostel_fee_receipt_print');
Route::get('/student/hostel/{hostelfee}/{created_at}/fee_receipt/download', 'Student\Fee\StudentHostelFeeController@hostel_fee_receipt_download');


Route::group(['middleware' => 'revalidate'],function()
{


Route::get('/student/profile', 'Student\StudentController@profile');

Route::get('/student/tution/fee_detail/getsessions', 'Student\Fee\StudentTutionFeeController@tution_getsessions');
Route::get('/student/tution/fee_detail/{asession}/{created_at}', 'Student\Fee\StudentTutionFeeController@tution_fee_detail');
Route::get('/student/tution/{tutionfee}/{created_at}/fee_receipt', 'Student\Fee\StudentTutionFeeController@tution_fee_receipt');



Route::get('/student/transport/fee_detail/getsessions', 'Student\Fee\StudentTransportFeeController@transport_getsessions');
Route::get('/student/transport/fee_detail/{asession}/{created_at}', 'Student\Fee\StudentTransportFeeController@transport_fee_detail');
Route::get('/student/transport/{transportfee}/{created_at}/fee_receipt', 'Student\Fee\StudentTransportFeeController@transport_fee_receipt');

Route::get('/student/hostel/fee_detail', 'Student\Fee\StudentHostelFeeController@hostel_fee_detail');
Route::get('/student/hostel/{hostelfee}/{created_at}/fee_receipt', 'Student\Fee\StudentHostelFeeController@hostel_fee_receipt');

Route::get('/student/registraion/fee_detail', 'Student\Fee\StudentRegistrationFeeController@registraion_fee_detail');
Route::get('/student/registraion/{registraionfee}/{created_at}/fee_receipt', 'Student\Fee\StudentRegistrationFeeController@registraion_fee_receipt');

Route::get('/student/pay_online', 'Student\StudentFeeStuffController@pay_online');
Route::get('/student/online_fee/confirmation', 'Student\StudentFeeStuffController@online_fee_confirmation');
Route::post('/student/online_fee/confirmation', 'Student\StudentFeeStuffController@online_fee_confirmation_save');
Route::get('/student/fee/request', 'Student\StudentFeeStuffController@fee_request');
Route::post('/student/fee/request', 'Student\StudentFeeStuffController@fee_request_save');

Route::get('/student/grades', 'Student\StudentController@grades');

Route::get('/student/get_asessions', 'Student\StudentViewMarkController@get_asessions');
Route::get('/student/marks/{asession}/{created_at}', 'Student\StudentViewMarkController@get_marks');
Route::get('/student/get_asessions_fortest', 'Student\StudentViewMarkController@get_asessions_fortest');
Route::get('/student/test_marks/{asession}/{created_at}', 'Student\StudentViewMarkController@test_marks');

Route::get('/student/marks_sheet', 'Student\StudentCertificateController@marks_sheet');
Route::post('/student/marks_sheet', 'Student\StudentCertificateController@marks_sheet_save');
Route::get('/student/cetrificate/request', 'Student\StudentCertificateController@certificate_request');
Route::post('/student/cetrificate/request', 'Student\StudentCertificateController@certificate_request_save');

Route::get('/student/log_request', 'Student\StudentLogController@log_request');
Route::post('/student/log_request', 'Student\StudentLogController@log_request_save');
Route::get('/student/log_view', 'Student\StudentLogController@log_view');

Route::get('/student/notification/index', 'Student\StudentLogController@notification_index');
Route::get('/student/notification/show/{not}/{slug}', 'Student\StudentLogController@notification_show');

Route::get('/student/course_profile', 'Student\StudentController@course_profile');
Route::get('/student/attendence', 'Student\StudentController@attendence');
Route::get('/student/attendence/details', 'Student\StudentController@attendence_details');
Route::get('/student/change', 'Student\StudentController@changeget');
Route::post('/student/change', 'Student\StudentController@changepost');
Route::get('/student', 'Student\StudentController@index');

Route::get('/student/timetable', 'Student\Academic\StudentAcademicController@timetableview');

Route::get('/student/homework', 'Student\Academic\StudentHomeWorkController@homework_index');

Route::get('/student/fee/status', 'Student\Fee\Status\FeeStatusController@fee_status');

Route::get('/student/events/view', 'Student\Academic\EventViewController@event_view');
Route::get('/student/events/view/calender', 'Student\Academic\EventViewController@event_view_calendor');

});

Route::get('/student/timetable/print', 'Student\Academic\StudentAcademicController@print_timetable');


Route::get('/oops', 'Student\StudentController@oops')->name('oppss');
