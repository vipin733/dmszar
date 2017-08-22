<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use App\Notification;
use Carbon\Carbon;
use App\Asession;
use App\Event;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        Schema::defaultStringLength(191);

           view()->composer(['student.create.sprofile','auth.students.students','student.edit.sprofile_edit','student.stuff.marks_sheet','auth.message.get_message_form'],function($view){
          $view->with('courses',\DB::table("courses")->where('user_id',Auth::id())->pluck("name","id"));
        });

           view()->composer(['staff.fee_analysis.tution.tutions_transactions','staff.fee_analysis.transport.transport_transactions','staff.fee_analysis.hostel.hostel_transactions','staff.fee_request.confirmation.confirmation_request',
            'staff.students.students','staff.certificate_request.mark_sheet_request.mark_sheets_requests','staff.certificate_request.certificate_requests.certificate_requests','staff.fee_request.fee.fee_extension_refund_requests','staff.students.create.sprofile','staff.students.edit.sprofile_edit','staff.students.fee.unpaid_tution','staff.students.fee.unpaid_transport',
            'staff.students.fee.hostel.unpaid_hostel','staff.students.fee.unpaid_registraion','staff.notification_message.message',
            'staff.attachment.course_teacher','staff.attachment.course_section','staff.attachment.section_student','staff.attachment.course_subject','staff.attachment.teacher_teaching_courses_sections_subjects','staff.attachment.teacher_teaching_courses_sections_subject_edit','staff.tution_fee.tution_fee_structure','staff.registraion_fee.registraion_fee_structure','staff.fee_analysis.registraion.registraion_transactions','staff.students.active_all_students','teacher.student.homework.view.homework_index','staff.teachers_staff.profile.homework.teacher_homeworks'],function($view){
          $view->with('courses',\DB::table("courses")->where('user_id',Auth::user()->owner->id)->pluck("name","id"));
        });

          view()->composer(['staff.attachment.course_section','staff.students.active_all_students','teacher.student.homework.view.homework_index','staff.teachers_staff.profile.homework.teacher_homeworks'],function($view){
          $view->with('sections',\DB::table("sections")->where('user_id',Auth::user()->owner->id)->pluck("name","id"));
        });


        view()->composer(['staff.notification_message.notification','staff.notification_message.notification_edit','staff.notification_message.notification_index','student.notification_message.notification_index'],function($view){
          $view->with('categories',\DB::table("notification__categories")->pluck("name","id"));
        });

        view()->composer(['student.create.saddress','teacher.create.taddress','student.edit.saddress_edit','teacher.edit.taddress_edit','staff.students.create.saddress','staff.teachers_staff.create.taddress','staff.students.edit.saddress_edit','staff.teachers_staff.edit.taddress_edit','auth.stuff.edit.school_profile.get_school_profile'],function($view){
          $view->with('states',\DB::table("states")->pluck("name","id"));
        });

        view()->composer(['auth.stuff.edit.school_profile.get_school_profile'],function($view){
          $view->with('school_boards',\DB::table("school_boards")->pluck("name","id"));
        });

        view()->composer(['student.create.sprofile','teacher.create.tprofile','student.edit.sprofile_edit','teacher.edit.tprofile_edit','staff.students.fee.unpaid_transport'],function($view){
          $view->with('stopages',\DB::table("stopages")->where('user_id',Auth::id())->pluck("name","id"));
        });

         view()->composer(['student.create.sprofile','student.edit.sprofile_edit'],function($view){
          $view->with('hostels',\DB::table("hostels")->where('user_id',Auth::id())->pluck("name","id"));
        });

         view()->composer(['staff.students.create.sprofile','staff.hostel_fee.hostel_fee_structure','staff.students.edit.sprofile_edit','staff.students.fee.hostel.unpaid_hostel'],function($view){
          $view->with('hostels',\DB::table("hostels")->where('user_id',Auth::user()->owner->id)->pluck("name","id"));
        });

         view()->composer(['staff.students.create.sprofile','staff.students.edit.sprofile_edit','staff.log_control.logs','teacher.student.homework.view.homework_index','teacher_staff.applied_leaves.applied_leaves','staff.teachers_staff.profile.leave.applied_leaves','staff.teachers_staff.profile.homework.teacher_homeworks','staff.teachers_staff.profile.log.log_requests'],function($view){
          $view->with('asessions',\DB::table("asessions")->where('user_id',Auth::user()->owner->id)->pluck("name","id"));
        });

          view()->composer(['student.log.log_request','teacher.log.log_request','staff.log_control.logs','staff.teachers_staff.profile.log.log_requests'],function($view){
          $view->with('logrequestcategories',\DB::table("log_request_categories")->pluck("name","id"));
        });

         view()->composer(['staff.staff','teacher.teacher','staff.students.fee.unpaid_tution','staff.students.fee.unpaid_transport','staff.students.fee.hostel.unpaid_hostel','staff.students.fee.unpaid_registraion','staff.fee_analysis.tution.tutions_transactions','staff.fee_analysis.transport.transport_transactions','staff.fee_analysis.hostel.hostel_transactions','student.stuff.course_profile','staff.attachment.course_section_teacher','staff.students.marks.manage_marks_exam_get_subjects','staff.fee_analysis.registraion.registraion_transactions','teacher.student.homework.view.homework_index'],function($view){
          $view->with('asession',Asession::where('user_id', Auth::user()->owner->id)
                                        ->where('active',1)
                                        ->select('id','name')
                                         ->first());
        });

         view()->composer(['student.create.sprofile','student.edit.sprofile_edit'],function($view){
          $view->with('asessions',\DB::table("asessions")->where('user_id',Auth::id())->pluck("name","id"));
        });

        view()->composer(['staff.students.create.sprofile','staff.teachers_staff.create.tprofile','staff.students.edit.sprofile_edit','staff.teachers_staff.edit.tprofile_edit','staff.transport_fee.trans_fee_structure'],function($view){
          $view->with('stopages',\DB::table("stopages")->where('user_id',Auth::user()->owner->id)->pluck("name","id"));
        });

          view()->composer(['staff.attachment.teacher_teaching_courses_sections_subjects','staff.attachment.teacher_teaching_courses_sections_subject_edit','staff.attachment.course_subject','staff.acadmic.time_table.partial.select_component','staff.acadmic.time_table.get_time_table_form','teacher.student.homework.view.homework_index','staff.teachers_staff.profile.homework.teacher_homeworks'],function($view){
          $view->with('subjects',\DB::table("subjects")->where('user_id',Auth::user()->owner->id)->pluck("name","id"));
        });

           view()->composer(['staff.staff_nav','student.student_nav','teacher.teacher_nav'],function($view){
          $view->with('user',Auth::user()->owner->load('schoolprofile','appprofile'));
        });


          view()->composer(['staff.staff','teacher.teacher','student.student'],function($view){
          $view->with('notifications',Notification::where('user_id',Auth::user()->owner->id)
                                       ->with('notifications_categories')->latest()->take(3)->get());
        });

          view()->composer(['auth.onlinetransfer.bank.bank_details'],function($view){
          $view->with('banknames',\DB::table("bank_names")->pluck("name","id"));
        });

          view()->composer(['auth.onlinetransfer.app.app_details'],function($view){
          $view->with('appnames',\DB::table("app_names")->pluck("name","id"));
        });

          view()->composer(['superadmin.blog.create_blog','superadmin.blog.edit_blog'],function($view){
          $view->with('blog_categories',\DB::table("blog_categories")->pluck("name","id"));
        });

          Validator::extend('unique_multiple', function ($attribute, $value, $parameters, $validator)
         {
           // Get the other fields
           $fields = $validator->getData();

           // Get table name from first parameter
           $table = array_shift($parameters);

          // Build the query
          $query = \DB::table($table);

          // Add the field conditions
          foreach ($parameters as $i => $field) {
              $query->where($field, $fields[$field]);
          }

          // Validation result will be false if any rows match the combination
          return ($query->count() == 0);
       });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind('mailgun.client', function() {
      	return \Http\Adapter\Guzzle6\Client::createWithConfig([
      		// your Guzzle6 configuration
      	]);
      });
    }
}
