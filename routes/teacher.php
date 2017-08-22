<?php

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/teacher_staff/login', 'Teacher\TeacherController@login')->name('teacher.login');
Route::post('/teacher/login', 'Teacher\TeacherController@postlogin');

  Route::group(['middleware' => 'revalidate'],function()
{
Route::get('/teacher/change', 'Teacher\TeacherController@changeget')->middleware(['auth:teacher','active']);
Route::post('/teacher/change', 'Teacher\TeacherController@changepost')->middleware(['auth:teacher','active']);

Route::get('/teacher', 'Teacher\Home\TeacherHomeController@home');
Route::get('/teacher/profile', 'Teacher\Home\TeacherHomeController@profile');
Route::get('/teacher/course_profile', 'Teacher\Home\TeacherHomeController@course_profile');

Route::get('/teacher/attendence', 'Teacher\TeacherAttandanceController@attendance');
Route::get('/teacher/attendence/details', 'Teacher\TeacherAttandanceController@attendance_details');


Route::get('/teacher/log/create', 'Teacher\TeacherLogController@log_request');
Route::post('/teacher/log/create', 'Teacher\TeacherLogController@log_request_save');
Route::get('/teacher/log/view', 'Teacher\TeacherLogController@log_view');

Route::get('/teacher/student/take_attendence', 'Teacher\Student\TeacherStudentController@student_take_attendence_get');
Route::post('/teacher/student/take_attendence', 'Teacher\Student\TeacherStudentController@student_take_attendence_post');

Route::get('/teacher/student/test_course_section', 'Teacher\Student\TeacherStudentTestMarkController@test_course_section_get');
Route::get('/teacher/student/{course}/{section}/test_subject', 'Teacher\Student\TeacherStudentTestMarkController@test_subject_get');
Route::get('/teacher/student/{course}/{c_created_at}/{section}/{s_created_at}/{subject}/{su_created_at}/{testname}/{ts_created_at}/test_amrks_upload', 'Teacher\Student\TeacherStudentTestMarkController@test_amrks_upload_get');
Route::post('/teacher/student/test_amrks/{course}/{c_created_at}/{section}/{s_created_at}/{subject}/{su_created_at}/{testname}/{ts_created_at}/upload', 'Teacher\Student\TeacherStudentTestMarkController@test_amrks_upload_post');
Route::get('/teacher/student/{course}/{c_created_at}/{section}/{s_created_at}/{subject}/{su_created_at}/{testname}/{ts_created_at}/test_amrks_edit', 'Teacher\Student\TeacherStudentTestMarkController@test_amrks_edit');
Route::PATCH('/teacher/student/{course}/{c_created_at}/{section}/{s_created_at}/{subject}/{su_created_at}/{testname}/{ts_created_at}/test_amrks_update', 'Teacher\Student\TeacherStudentTestMarkController@test_amrks_update');


Route::get('/send_message/get', 'Teacher\Student\SendMessageToStudentController@get_form');
Route::post('/send_message/post', 'Teacher\Student\SendMessageToStudentController@post_form');
Route::get('/teacher/course/{id}', 'Teacher\Student\SendMessageToStudentController@get_course_ajax');
Route::get('/st/student/send_message/{reg_no}', 'Teacher\Student\SendMessageToStudentController@get_s_form');
Route::post('/st/student/send_message/{reg_no}', 'Teacher\Student\SendMessageToStudentController@post_s_form');

Route::get('/teacher/timetable', 'Teacher\Academic\TeacherAcademicController@timetableview');

Route::get('/teacher/all_students', 'Teacher\Student\TeacherStudentViewController@students');
Route::get('/teacher/students_ajax', 'Teacher\Student\TeacherStudentViewController@students_ajax');


Route::get('/teacher/student/homework_index', 'Teacher\Student\HomeWork\StudentHomeWorkViewController@homework_index');
Route::get('/teacher/student/{homework}/homework_show', 'Teacher\Student\HomeWork\StudentHomeWorkViewController@homework_show');

Route::get('/teacher/student/homework_class_section', 'Teacher\Student\HomeWork\StudentHomeWorkController@homework_course_section_get');
Route::get('/teacher/student/{course}/{section}/homework_subject', 'Teacher\Student\HomeWork\StudentHomeWorkController@homework_subject_get');
Route::get('/teacher/student/{course}/{section}/{subject}/homework_upload_form', 'Teacher\Student\HomeWork\StudentHomeWorkController@homework_upload_form');
Route::post('/teacher/student/{course}/{section}/{subject}/homework_upload', 'Teacher\Student\HomeWork\StudentHomeWorkController@homework_upload');
Route::PATCH('/teacher/student/{homework}/homework_update', 'Teacher\Student\HomeWork\StudentHomeWorkController@homework_update');
Route::DELETE('/teacher/student/{homework}/homework_delete', 'Teacher\Student\HomeWork\StudentHomeWorkController@homework_delete');

Route::get('/teacher/events/view', 'Teacher\Academic\EventViewController@event_view');
Route::get('/teacher/events/view/calender', 'Teacher\Academic\EventViewController@event_view_calendor');

});

Route::get('/teacher/timetable/print', 'Teacher\Academic\TeacherAcademicController@print_timetable');

Route::get('/oopst', 'Teacher\TeacherController@oops')->name('oppst');

