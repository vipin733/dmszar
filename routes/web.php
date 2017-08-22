<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['middleware' => 'revalidate'],function()
{



Route::get('/teacher_staff/apply_leave', 'TeacherStaffLeaveController@apply_leave_get')->middleware(['auth:teacher','active']);
Route::post('/teacher_staff/apply_leave/post', 'TeacherStaffLeaveController@apply_leave_post')->middleware(['auth:teacher','active']);
Route::get('/teacher_staff/applied/leaves', 'TeacherStaffLeaveController@applied_leave_get')->middleware(['auth:teacher','active','staffs']);
Route::get('/teacher_staff/applied/{applied_leave}/leave-view', 'TeacherStaffLeaveController@applied_leave_details')->middleware(['auth:teacher','active','staffs']);
Route::PATCH('/teacher_staff/applied/{applied_leave}/update', 'TeacherStaffLeaveController@applied_leave_update')->middleware(['auth:teacher','active','staffs']);




Route::get('/staff', 'Staff\Home\StaffHomeControllerController@home');
Route::get('/staff/profile', 'Staff\Home\StaffHomeControllerController@profile');


Route::get('/staff/fee_analysis/tutions_transactions', 'Staff\Fee\Transaction\StaffTutionTransactionsController@tutions_transactions');
Route::get('/staff/fee_analysis/tutions_transactions/ajax', 'Staff\Fee\Transaction\StaffTutionTransactionsController@tutions_transactions_ajax');


Route::get('/staff/fee_analysis/transport_transactions', 'Staff\Fee\Transaction\StaffTransportTransactionsController@transport_transactions');
Route::get('/staff/fee_analysis/transport_transactions/ajax', 'Staff\Fee\Transaction\StaffTransportTransactionsController@transport_transactions_ajax');


Route::get('/staff/fee_analysis/hostel_transactions', 'Staff\Fee\Transaction\StaffHostelTransactionsController@hostel_transactions');
Route::get('/staff/fee_analysis/hostel_transactions/ajax', 'Staff\Fee\Transaction\StaffHostelTransactionsController@hostel_transactions_ajax');


Route::get('/staff/fee_analysis/registraion_transactions', 'Staff\Fee\Transaction\StaffRegistrationTransactionsController@registraion_transactions');
Route::get('/staff/fee_analysis/registraion_transactions/ajax', 'Staff\Fee\Transaction\StaffRegistrationTransactionsController@registraion_transactions_ajax');



Route::get('/staff/students/confirmation_request', 'StaffFeeConfirmationCController@confirmation_request');
Route::get('/staff/students/confirmation_request/{ticket_no}/{feeconfirmation}/{created_at}/view', 'StaffFeeConfirmationCController@confirmation_request_view');
Route::post('/staff/students/confirmation_request/{ticket_no}/{feeconfirmation}/{created_at}/save', 'StaffFeeConfirmationCController@confirmation_request_save');

Route::get('/staff/students/manage_marks_get_courses', 'StudentExamMarkController@manage_marks_exam_get_courses');
Route::get('/staff/students/{course}/{created_at}/{section}/{screated_at}/manage_marks_exam_get_subjects', 'StudentExamMarkController@manage_marks_exam_get_subjects');
Route::get('/staff/students/{course}/{created_at}/{section}/{screated_at}/{examname}/{ex_created_at}/{subject}/{su_created_at}/exam_amrks_upload', 'StudentExamMarkController@exam_amrks_upload_get');
Route::post('/staff/students/{course}/{created_at}/{section}/{screated_at}/{examname}/{ex_created_at}/{subject}/{su_created_at}/exam_amrks_upload', 'StudentExamMarkController@exam_amrks_upload_post');
Route::get('/staff/students/{course}/{created_at}/{section}/{screated_at}/{examname}/{ex_created_at}/{subject}/{su_created_at}/exam_amrks_edit', 'StudentExamMarkController@exam_amrks_edit');
Route::PATCH('/staff/students/{course}/{created_at}/{section}/{screated_at}/{examname}/{ex_created_at}/{subject}/{su_created_at}/exam_amrks_update', 'StudentExamMarkController@exam_amrks_update');


Route::get('/staff/tution/unpaid', 'Staff\Students\UnpaidTutionStudentsController@unpaid_tution');
Route::get('/staff/tution/unpaid/ajax', 'Staff\Students\UnpaidTutionStudentsController@unpaid_tution_ajax');

Route::get('/staff/transport/unpaid', 'Staff\Students\UnpaidTansportStudentsController@unpaid_transport');
Route::get('/staff/transport/unpaid/ajax', 'Staff\Students\UnpaidTansportStudentsController@unpaid_transport_ajax');

Route::get('/staff/registraion/unpaid', 'Staff\Students\UnpaidRegistrationStudentsController@unpaid_registraion');
Route::get('/staff/registraion/unpaid/ajax', 'Staff\Students\UnpaidRegistrationStudentsController@unpaid_registraion_ajax');

Route::get('/staff/hostel/unpaid', 'Staff\Students\UnpaidHostelStudentsController@unpaid_hostel');
Route::get('/staff/hostel/unpaid/ajax', 'Staff\Students\UnpaidHostelStudentsController@unpaid_hostel_ajax');



Route::get('/student/{reg_no}/{uuid}/tution_fee/take', 'Staff\Fee\TutionFeeCollectionController@tution_fee_get');
Route::post('/student/{reg_no}/{uuid}/tution_fee/take', 'Staff\Fee\TutionFeeCollectionController@tution_fee_post');
Route::get('/student/tution_fee/{reg_no}/{uuid}/details', 'Staff\Fee\TutionFeeCollectionController@fee_detail_tution');
Route::get('/staff/student/receipt/{tution}/{created_at}/fee/tution', 'Staff\Fee\TutionFeeCollectionController@fee_receipt_tution_view');
Route::PATCH('/staff/student/{reg_no}/{uuid}/fee/tution/{tution_fee}/{created_at}/delete', 'Staff\Fee\TutionFeeCollectionController@delete_tution_fee')->name('tution.destroy');

Route::get('/student/{reg_no}/{uuid}/transport_fee/take', 'Staff\Fee\TransportFeeCollectionController@transport_fee_get');
Route::post('/student/{reg_no}/{uuid}/transport_fee/take', 'Staff\Fee\TransportFeeCollectionController@transport_fee_post');
Route::get('/student/transport_fee/{reg_no}/{uuid}/details', 'Staff\Fee\TransportFeeCollectionController@fee_detail_transport');
Route::get('/staff/student/receipt/{transport}/{created_at}/fee/transport', 'Staff\Fee\TransportFeeCollectionController@fee_receipt_transport_view');
Route::PATCH('/staff/student/{reg_no}/{uuid}/fee/transport/{transport_fee}/{created_at}/delete', 'Staff\Fee\TransportFeeCollectionController@delete_transport_fee')->name('transport.destroy');

Route::get('/student/{reg_no}/{uuid}/hostel_fee/take', 'Staff\Fee\HostelFeeCollectionController@hostel_fee_get');
Route::post('/student/{reg_no}/{uuid}/hostel_fee/take', 'Staff\Fee\HostelFeeCollectionController@hostel_fee_post');
Route::get('/student/hostel_fee/{reg_no}/{uuid}/details', 'Staff\Fee\HostelFeeCollectionController@fee_detail_hostel');
Route::get('/staff/student/receipt/{hostel}/{created_at}/fee/hostel', 'Staff\Fee\HostelFeeCollectionController@fee_receipt_hostel_view');
Route::PATCH('/staff/student/{reg_no}/{uuid}/fee/hostel/{hostel_fee}/{created_at}/delete', 'Staff\Fee\HostelFeeCollectionController@delete_hostel_fee')->name('hostel.destroy');

Route::get('/student/{reg_no}/{uuid}/registraion_fee/take', 'Staff\Fee\RegistraionFeeCollectionController@registraion_fee_get');
Route::post('/student/{reg_no}/{uuid}/registraion_fee/take', 'Staff\Fee\RegistraionFeeCollectionController@registraion_fee_post');
Route::get('/student/registraion_fee/{reg_no}/{uuid}/details', 'Staff\Fee\RegistraionFeeCollectionController@fee_detail_registraion');
Route::get('/staff/student/receipt/{registraion}/{created_at}/fee/registraion', 'Staff\Fee\RegistraionFeeCollectionController@fee_receipt_registraion_view');
Route::PATCH('/staff/student/{reg_no}/{uuid}/fee/registration/{registration_fee}/{created_at}/delete', 'Staff\Fee\RegistraionFeeCollectionController@delete_registration_fee')->name('registration.destroy');

Route::get('/staff/teacher_students/logs', 'StaffLogViewCController@logs');
Route::get('/staff/teacher_students/logs/{ticket_no}/{logrequest}/{created_at}/view', 'StaffLogViewCController@log_view');
Route::post('/staff/teacher_students/logs/{ticket_no}/{logrequest}/{created_at}/save', 'StaffLogViewCController@log_reply_save');

Route::get('/staff/fee/extensions/refund/requests', 'StaffFeeRequestCController@fee_extension_refund_request');
Route::get('/staff/fee/extensions/refund/{ticket_no}/{feerequest}/{created_at}/request_view', 'StaffFeeRequestCController@fee_extensions_refund_request_view');
Route::post('/staff/fee/extensions/refund/{ticket_no}/{feerequest}/{created_at}/request_save', 'StaffFeeRequestCController@fee_extensions_refund_request_save');

Route::get('/staff/student/mark_sheets_requests', 'StaffStudentCertificateRequestCController@mark_sheets_requests');
Route::get('/staff/student/{ticket_no}/{marksheetrequest}/{created_at}/mark_sheet_view', 'StaffStudentCertificateRequestCController@mark_sheet_view');
Route::post('/staff/student/{ticket_no}/{marksheetrequest}/{created_at}/mark_sheet_save', 'StaffStudentCertificateRequestCController@mark_sheet_save');
Route::get('/staff/student/certificate/requests', 'StaffStudentCertificateRequestCController@certificate_requests');
Route::get('/staff/student/certificate/{ticket_no}/{ccrequest}/{created_at}/request/view', 'StaffStudentCertificateRequestCController@certificate_request_view');
Route::post('/staff/student/certificate/{ticket_no}/{ccrequest}/{created_at}/request/save', 'StaffStudentCertificateRequestCController@certificate_request_save');


Route::get('/staff/attendence', 'StaffAttandanceController@attendence');
Route::get('/staff/attendence/details', 'StaffAttandanceController@attendence_details');

Route::get('/staff/notification/get_form', 'Staff\StaffNotificationController@notification_form');
Route::post('/staff/notification/post_form', 'Staff\StaffNotificationController@notification_form_post');
Route::get('/notification/index', 'Staff\StaffNotificationController@notification_index')->middleware(['auth:teacher','active']);
Route::get('/notification/show/{not}/{slug}', 'Staff\StaffNotificationController@notification_show')->middleware(['auth:teacher','active']);
Route::get('/staff/notification/edit_form/{not}/{slug}', 'Staff\StaffNotificationController@notification_edit_form');
Route::PATCH('/staff/notification/edit_form/{not}', 'Staff\StaffNotificationController@notification_update_form');

Route::get('/staff/message/send', 'Staff\StaffMessageController@message_form');
Route::post('/staff/message/send', 'Staff\StaffMessageController@message_post');

Route::get('/staff/events/make', 'Staff\Acadmic\Event\AcademicEventController@event_form');
Route::post('/staff/events/make', 'Staff\Acadmic\Event\AcademicEventController@event_post');
Route::get('/staff/events/view', 'Staff\Acadmic\Event\AcademicEventController@event_view');


Route::resource('acadmic/courses','Add\AddCourseController',['only'=>['create','store','update','edit']]);
Route::resource('acadmic/sections','Add\AddSectionController',['only'=>['create','store','update','edit']]);
Route::resource('acadmic/subjects','Add\AddSubjectController',['only'=>['create','store','update','edit']]);
Route::resource('acadmic/districts','Add\AddDistrictController',['only'=>['create','store','update','edit']]);
Route::resource('acadmic/stopages','Add\AddStopagesController',['only'=>['create','store','update','edit']]);
Route::resource('acadmic/hostels','Add\AddHostelController',['only'=>['create','store','update','edit']]);
Route::resource('acadmic/asessions','Add\AddAsessionController',['only'=>['create','store','update','edit']]);
Route::resource('acadmic/testnames','Add\AddTestNameController',['only'=>['create','store','update','edit']]);
Route::resource('acadmic/examnames','Add\AddExamNameController',['only'=>['create','store','update','edit']]);
Route::resource('acadmic/feerequestcategories','Add\AddFeeRequestCategoryController',['only'=>['create','store','update','edit']]);
Route::resource('acadmic/logrequestcategories','Add\AddLogRequestCategoryController',['only'=>['create','store','update','edit']]);
Route::resource('acadmic/ccategories','Add\AddCertificateNameController',['only'=>['create','store','update','edit']]);

Route::get('/acadmic/busdetails/create', 'Staff\Add\AddBusDetailController@create');
Route::post('/acadmic/busdetails/store', 'Staff\Add\AddBusDetailController@store');
Route::PATCH('/acadmic/busdetails/{stopage}/update', 'Staff\Add\AddBusDetailController@update');

Route::get('/acadmic/add/tution_fee', 'Add\AddTutionFeeController@tution_fee_get');
Route::post('/acadmic/add/tution_fee', 'Add\AddTutionFeeController@tution_fee_post');
Route::get('/acadmic/tution_fee/{tution_fee}/{created_at}/edit', 'Add\AddTutionFeeController@tution_fee_edit');
Route::patch('/acadmic/tution_fee/{tution_fee}/{created_at}/edit', 'Add\AddTutionFeeController@tution_fee_update');
Route::DELETE('/acadmic/tution_fee/{tution_fee}/{created_at}/delete',['as' => 'delete_tution','uses' => 'Add\AddTutionFeeController@tution_fee_delete']);

Route::get('/acadmic/add/transport_fee', 'Add\AddTransportFeeController@transport_fee_get');
Route::post('/acadmic/add/transport_fee', 'Add\AddTransportFeeController@transport_fee_post');
Route::get('/acadmic/transport_fee/{transport_fee}/{created_at}/edit', 'Add\AddTransportFeeController@transport_fee_edit');
Route::patch('/acadmic/transport_fee/{transport_fee}/{created_at}/edit', 'Add\AddTransportFeeController@transport_fee_update');
Route::DELETE('/acadmic/transport_fee/{transport_fee}/{created_at}/delete',['as' => 'delete_transport','uses' => 'Add\AddTransportFeeController@transport_fee_delete']);

Route::get('/acadmic/add/Hostel_fee', 'Add\AddHostelFeeController@Hostel_fee_get');
Route::post('/acadmic/add/Hostel_fee', 'Add\AddHostelFeeController@Hostel_fee_post');
Route::get('/acadmic/Hostel_fee/{hostel_fee}/{created_at}/edit', 'Add\AddHostelFeeController@Hostel_fee_edit');
Route::patch('/acadmic/Hostel_fee/{hostel_fee}/{created_at}/edit', 'Add\AddHostelFeeController@Hostel_fee_update');
Route::DELETE('/acadmic/Hostel_fee/{hostel_fee}/{created_at}/delete',['as' => 'delete_Hostel','uses' => 'Add\AddHostelFeeController@Hostel_fee_delete']);

Route::get('/acadmic/add/registraion_fee', 'Add\RegistrationFeeController@registraion_fee_get');
Route::post('/acadmic/add/registraion_fee_post', 'Add\RegistrationFeeController@registraion_fee_post');
Route::patch('/acadmic/registraion_fee/{registraion_fee}/{created_at}/edit', 'Add\RegistrationFeeController@registraion_fee_update');
Route::DELETE('/acadmic/registraion_fee/{registraion_fee}/{created_at}/delete',['as' => 'delete_registraion','uses' => 'Add\RegistrationFeeController@registraion_fee_delete']);


Route::get('/staff/course_section/attach', 'StaffController@course_section_get');
Route::post('/staff/course_section/attach', 'StaffController@course_section_post');

Route::get('/staff/course_subject/attach', 'StaffController@course_subject_get');
Route::post('/staff/course_subject/attach', 'StaffController@course_subject_post');

Route::get('/staff/section_student/courses_link', 'AttachStudentAcadmicController@courses_for_students_sections');
Route::get('/staff/section_student/{course}/{created_at}/attach', 'AttachStudentAcadmicController@section_student_get');
Route::post('/staff/section_student/{course}/{created_at}/attach', 'AttachStudentAcadmicController@section_student_post');


Route::get('/staff/acadmic/teacher_teaching_subject/attach','Staff\Acadmic\TeacherSubjectContrller@teacher_subject_get');
Route::post('/staff/acadmic/teacher_teaching_subject/attach', 'Staff\Acadmic\TeacherSubjectContrller@teacher_subject_post');
Route::DELETE('/staff/acadmic/teacher_subject/{subject}/{teacher}/detattach',
	'Staff\Acadmic\TeacherSubjectContrller@teacher_subject_delete')->name('teacher_subject_delete');

Route::get('/staff/teacher_teaching_courses_sections_subject/attach', 'AttachTeacherAcadmicController@teacher_teaching_courses_sections_subject_get');
Route::post('/staff/teacher_teaching_courses_sections_subject/attach', 'AttachTeacherAcadmicController@teacher_teaching_courses_sections_subject_post');

Route::get('/staff/teacher_teaching_courses_sections_subject/{id}/{uuid}/{reg_no}/edit', 'AttachTeacherAcadmicController@teacher_teaching_courses_sections_subject_edit');
Route::PATCH('/staff/teacher_teaching_courses_sections_subject/{id}/{uuid}/{reg_no}/update', 'AttachTeacherAcadmicController@teacher_teaching_courses_sections_subject_update');
Route::DELETE('/staff/teacher_teaching_courses_sections_subject/{id}/{uuid}/{reg_no}/delete',
	'AttachTeacherAcadmicController@teacher_teaching_courses_sections_subject_delete')->name('course_section_teacher_subject_delete');

Route::get('/staff/course_section_teacher/attach', 'AttachTeacherAcadmicController@course_section_teacher_get');
Route::get('/staff/course_section_teacher/{id}', 'AttachTeacherAcadmicController@course_section_teacher_ajax');
Route::post('/staff/course_section_teacher/attach', 'AttachTeacherAcadmicController@course_section_teacher_post');
Route::get('/staff/course_section_teacher/attach/{id}/{uuid}/{reg_no}/edit',
	'AttachTeacherAcadmicController@course_section_teacher_edit');
Route::PATCH('/staff/course_section_teacher/attach/{id}/{uuid}/{reg_no}/post',
	'AttachTeacherAcadmicController@course_section_teacher_edit_post');
Route::DELETE('/staff/course_section_teacher/attach/{id}/{uuid}/{reg_no}/delete',
	'AttachTeacherAcadmicController@course_section_teacher_delete')->name('course_section_teacher_delete');


Route::get('/staff/students/mix_analysis', 'Staff\Students\StudentAnalysisController@mix_analysis');

Route::get('/st/student/register', 'StaffStudentController@register');
Route::post('/st/student/register', 'StaffStudentController@postregister');

Route::get('/st/all_students', 'Staff\Students\View\AllStudentsViewController@students');
Route::get('/st/students_ajax', 'Staff\Students\View\AllStudentsViewController@students_ajax');

Route::get('/st/active/students', 'Staff\Students\View\ActiveStudentsViewController@activestudents');
Route::get('/st/active/students_ajax', 'Staff\Students\View\ActiveStudentsViewController@active_students_ajax');

Route::get('/st/student/{reg_no}', 'StaffStudentController@students_profile');

Route::get('/st/student/profile/{uuid}/{reg_no}/update', 'StaffStudentController@profile_edit');

Route::PATCH('/st/student/profile/{uuid}/{reg_no}/update', 'StaffStudentController@profile_update');

Route::get('/st/student/attendence/{reg_no}','StaffStudentController@attendence_st_students');

Route::get('/st/student/attendence/{reg_no}/details','StaffStudentController@attendence_details_students');

Route::get('/st/student/course_profile/{reg_no}','StaffStudentProfileController@course_profile');

Route::get('/st/student/test_marks/{reg_no}/get_sessesion','StaffStudentProfileController@get_sessesion_test_mark');
Route::get('/st/student/{asession}/{created_at}/test_marks/{reg_no}/get_test_marks','StaffStudentProfileController@get_test_marks');
Route::get('/st/student/exam_marks/{reg_no}/get_sessesion','StaffStudentProfileController@get_sessesion_exam_mark');
Route::get('/st/student/{asession}/{created_at}/exam_marks/{reg_no}/get_exam_marks','StaffStudentProfileController@get_exam_marks');
Route::get('/st/student/get_grades/{reg_no}','StaffStudentProfileController@get_grades');
Route::get('/st/student/fee_confirmation_requests/{reg_no}','StaffStudentProfileController@fee_confirmation_requests');
Route::get('/st/student/fee_requests/{reg_no}','StaffStudentProfileController@fee_fee_requests');
Route::get('/st/student/marksheet_requests/{reg_no}','StaffStudentProfileController@marksheet_requests');
Route::get('/st/student/certificate_requests/{reg_no}','StaffStudentProfileController@certificate_requests');
Route::get('/st/student/log_requests/{reg_no}','StaffStudentProfileController@log_requests');
//Route::get('/st/student/attendence/{reg_no}/details','StaffStudentProfileController@attendence_details_students');

Route::get('/st/teacher_staff/register', 'StaffTeacherController@register');
Route::post('/st/teacher_staff/register', 'StaffTeacherController@postregister');

Route::get('/st/all_teachers_staffs', 'StaffTeacherController@teachers_staffs');
Route::get('/st/all_teachers_staffs/ajax', 'StaffTeacherController@teachers_staffs_ajax');

Route::get('/st/teacher_staff/take_attendence', 'Staff\StaffTeacher\StaffTeacherAttendenceController@teacher_staff_attendence');
Route::get('/st/teacher_staff/take_attendence/{uuid}/{reg_no}',
	    'Staff\StaffTeacher\StaffTeacherAttendenceController@teacher_staff_attendence_get');
Route::post('/st/teacher_staff/take_attendence/{uuid}/{reg_no}',
	    'Staff\StaffTeacher\StaffTeacherAttendenceController@teacher_staff_attendence_post');
Route::PATCH('/st/teacher_staff/take_attendence/{uuid}/{reg_no}/{id}/update',
	    'Staff\StaffTeacher\StaffTeacherAttendenceController@teacher_staff_attendence_update');
Route::DELETE('/st/teacher_staff/take_attendence/{uuid}/{reg_no}/{id}/delete',
	    'Staff\StaffTeacher\StaffTeacherAttendenceController@teacher_staff_attendence_delte');
Route::get('/st/teacher_staff/take_attendence/{uuid}/{reg_no}/details',
	    'Staff\StaffTeacher\StaffTeacherAttendenceController@teacher_staff_attendence_details');

Route::get('/st/teacher_staff/{reg_no}', 'StaffTeacherController@teacher_staff_profile');

Route::get('/st/teacher/profile/{uuid}/{reg_no}/update',
	'StaffTeacherController@teacher_staff_profile_edit');
Route::PATCH('/st/teacher/profile/{uuid}/{reg_no}/update',
	'StaffTeacherController@teacher_staff_profile_update');

Route::get('/staff/resete/student','Staff\StaffResetPasswordController@auth_student_reset');
Route::PATCH('/staff/resete/student','Staff\StaffResetPasswordController@auth_student_reset_update');
Route::get('/staff/resete/teacher_staff','Staff\StaffResetPasswordController@auth_teacher_staff_reset');
Route::PATCH('/staff/resete/teacher_staff','Staff\StaffResetPasswordController@auth_teacher_staff_reset_update');

Route::get('/staff/acadmic/timetabel/get_class_section','Staff\Acadmic\MakeTimeTableController@get_class_section');
Route::get('/staff/acadmic/teacher_subject_ajax/{subject}','Staff\Acadmic\MakeTimeTableController@get_teacher_subject_ajax');
Route::get('/staff/acadmic/{course}/{created_at}/{section}/{screated_at}/make_timetable','Staff\Acadmic\MakeTimeTableController@make_timetable');
Route::post('/staff/acadmic/{course}/{created_at}/{section}/{screated_at}/make_timetable_store','Staff\Acadmic\MakeTimeTableController@make_timetable_store');
Route::DELETE('/staff/acadmic/{time_table}/timetable_destroy','Staff\Acadmic\MakeTimeTableController@timetable_destroy')->name('timetable.destroy');

Route::post('/staff/acadmic/school_break_store','Staff\Acadmic\MakeTimeTableController@school_break_store');
Route::PATCH('/staff/acadmic/{luchtime}/school_break_update','Staff\Acadmic\MakeTimeTableController@school_break_update');

Route::get('/school/records','Staff\Records\SchoolCureentRecordsController@records');

Route::get('/teacher_staff/{reg_no}/applied_leave', 'Staff\StaffTeacher\StaffTeacherProfileViewController@applied_leave_by_teacher_staff');
Route::get('/teacher_staff/{reg_no}/log_request', 'Staff\StaffTeacher\StaffTeacherProfileViewController@log_request_by_teacher_staff');
Route::post('/teacher/{reg_no}/message', 'Staff\StaffTeacher\StaffTeacherProfileViewController@send_message');

Route::get('/teacher/{reg_no}/teacher_academic_profile', 'Staff\StaffTeacher\Teacher\TeacherProfileViewController@teacher_academic_profile');
Route::get('/teacher/{reg_no}/teacher_timetable', 'Staff\StaffTeacher\Teacher\TeacherProfileViewController@teacher_timetable');
Route::get('/teacher/{asession}/{reg_no}/teacher_timetable/view', 'Staff\StaffTeacher\Teacher\TeacherProfileViewController@teacher_timetableview');
Route::get('/teacher/{reg_no}/homeworks', 'Staff\StaffTeacher\Teacher\TeacherProfileViewController@teacher_homeworks');

Route::get('/staff/{uuid}/{reg_no}/student/fee/status', 'Staff\Students\Fee\Status\StudentFeeStatusController@fee_status');


});

Route::get('/staff/student/receipt/{tution_fee}/{created_at}/fee/tution/print', 'Staff\Fee\TutionFeeCollectionController@print_tution_pdf');
Route::get('/staff/student/receipt/{tution_fee}/{created_at}/fee/tution/download', 'Staff\Fee\TutionFeeCollectionController@download_tution_pdf');

Route::get('/staff/student/receipt/{transport_fee}/{created_at}/fee/transport/print', 'Staff\Fee\TransportFeeCollectionController@print_transport_pdf');
Route::get('/staff/student/receipt/{transport_fee}/{created_at}/fee/transport/download', 'Staff\Fee\TransportFeeCollectionController@download_transport_pdf');

Route::get('/staff/student/receipt/{hostel_fee}/{created_at}/fee/hostel/print', 'Staff\Fee\HostelFeeCollectionController@print_hostel_pdf');
Route::get('/staff/student/receipt/{hostel_fee}/{created_at}/fee/hostel/download', 'Staff\Fee\HostelFeeCollectionController@download_hostel_pdf');

Route::get('/staff/student/receipt/{registration_fee}/{created_at}/fee/registration/print', 'Staff\Fee\RegistraionFeeCollectionController@print_registration_pdf');
Route::get('/staff/student/receipt/{registration_fee}/{created_at}/fee/registration/download', 'Staff\Fee\RegistraionFeeCollectionController@download_registration_pdf');

Route::get('/staff/acadmic/{course}/{created_at}/{section}/{screated_at}/print_timetable','Staff\Acadmic\MakeTimeTableController@print_timetable');

Route::get('/teacher/{asession}/{reg_no}/teacher_timetable/print', 'Staff\StaffTeacher\Teacher\TeacherProfileViewController@teacher_timetable_print');
