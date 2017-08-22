
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{ url('/staff') }}">
                      <b>{{ $user->appprofile['app_name'] }}</b>
            </a>
        </div>
        <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav navbar-right">

                  <li>
                  <a href="/staff"><i class="fa fa-home" aria-hidden="true"></i> Home</a>        
                  </li>

                  <li>
                    <a href="/teacher/change"><i class="fa fa-key" aria-hidden="true"></i> Change Password</a>
                  </li>
                  <li>
                    @include('layouts.logout')           
                  </li>
                 
            </ul>
           
            <ul class="nav navbar-nav">

                <li>
                  <a href=""></a>
                </li>
                <li><a href=""></a></li>

                <li>
                  <a href="/staff/profile"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
                </li>

                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Transactions</a>
                              <ul class="dropdown-menu">
                              
                                <li>
                                  <a href="/staff/fee_analysis/registraion_transactions"><i class="fa fa-eye" aria-hidden="true"></i> Registration Fee</a>
                                </li>
                                <li>
                                  <a href="/staff/fee_analysis/tutions_transactions"><i class="fa fa-eye" aria-hidden="true"></i> Tuition Fee</a>
                                </li>
                                @if(!$user->schoolprofile['transport_service']==0)  
                                <li>
                                  <a href="/staff/fee_analysis/transport_transactions"><i class="fa fa-eye" aria-hidden="true"></i> Transport Fee</a>
                                </li>
                                @endif 
                                @if(!$user->schoolprofile['hostel_service']==0) 
                                <li>
                                  <a href="/staff/fee_analysis/hostel_transactions"><i class="fa fa-eye" aria-hidden="true"></i> Hostel Fee</a>
                                </li>
                                @endif
                              </ul>
                        </li>

                        <li role="separator" class="divider"></li>

                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Unpaid</a>
                              <ul class="dropdown-menu">
                              <li>
                                    <a href="/staff/registraion/unpaid">
                                      <i class="fa fa-eye" aria-hidden="true"></i> 
                                           Unpaid Registration Fee Students
                                    </a>
                                </li>
                                <li>
                                    <a href="/staff/tution/unpaid">
                                      <i class="fa fa-eye" aria-hidden="true"></i> 
                                           Unpaid Tuition Fee Students
                                    </a>
                                </li>
                                @if(!$user->schoolprofile['transport_service']==0)
                                <li>
                                    <a href="/staff/transport/unpaid">
                                    <i class="fa fa-eye" aria-hidden="true"></i> 
                                    Unpaid Transport Fee Students
                                    </a>
                                </li>
                                @endif
                                @if(!$user->schoolprofile['hostel_service']==0) 
                                <li>
                                  <a href="/staff/hostel/unpaid"><i class="fa fa-eye" aria-hidden="true"></i> Unpaid Hostel Fee Students</a>
                                </li>
                                @endif
                              </ul>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Academic Information</a>
                              <ul class="dropdown-menu">
                                <li>
                               <a href="{{ route('asessions.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Session</a>
                               </li>
                               <li>
                                   <a href="{{ route('courses.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Classes</a>
                               </li>
                               <li>
                                   <a href="{{ route('sections.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Section</a>
                               </li>
                               <li>
                                   <a href="{{ route('subjects.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Subject</a>
                               </li>

                               @if(!$user->schoolprofile['transport_service']==0)
                               <li>
                                   <a href="/acadmic/busdetails/create"><i class="fa fa-plus" aria-hidden="true"></i> Bus Details</a>
                               </li>
                                @endif

                               @if(!$user->schoolprofile['transport_service']==0)
                               <li>
                                   <a href="{{ route('stopages.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Stoppage</a>
                               </li>
                                @endif

                               @if(!$user->schoolprofile['hostel_service']==0) 
                               <li>
                                   <a href="{{ route('hostels.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Hostel Details</a>
                               </li>
                               @endif

                                <li>
                                   <a href="{{ route('testnames.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Test Name</a>
                               </li>

                                <li>
                                   <a href="{{ route('examnames.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Exam Name</a>
                               </li>
                              </ul>
                        </li>

                        <li role="separator" class="divider"></li>

                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category</a>
                              <ul class="dropdown-menu">
                                
                               <li>
                                   <a href="{{ route('ccategories.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>Add Certificate Name</a>
                               </li>
                              </ul>
                        </li>

                        <li role="separator" class="divider"></li>

                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Fee Structure</a>
                              <ul class="dropdown-menu">
                              <li>
                               <a href="/acadmic/add/registraion_fee"><i class="fa fa-plus" aria-hidden="true"></i> Add Registration Fee Structure</a>
                              </li>
                              <li>
                               <a href="/acadmic/add/tution_fee"><i class="fa fa-plus" aria-hidden="true"></i> Add Tuition Fee Structure</a>
                              </li>
                               @if(!$user->schoolprofile['transport_service']==0)
                               <li>
                                   <a href="/acadmic/add/transport_fee"><i class="fa fa-plus" aria-hidden="true"></i> Add Transport Fee Structure</a>
                               </li>
                               @endif 
                                @if(!$user->schoolprofile['hostel_service']==0) 
                               <li>
                                   <a href="/acadmic/add/Hostel_fee"><i class="fa fa-plus" aria-hidden="true"></i> Add Hostel Fee Structure</a>
                               </li>
                               @endif 
                              </ul>
                        </li>

                    </ul>
                </li>


                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Academic <b class="caret"></b></a>

                    <ul class="dropdown-menu multi-level">
                    

                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Attendance</a>
                              <ul class="dropdown-menu">
                               <li>
                               <a href="/staff/attendence"><i class="fa fa-eye" aria-hidden="true"></i> My Attendance</a>
                               </li>
                               <li>
                                   <a href="/st/teacher_staff/take_attendence"><i class="fa fa-plus" aria-hidden="true"></i> Take Teacher/Staff Attendance</a>
                               </li>
                              </ul>
                        </li>

                        <li role="separator" class="divider"></li>

                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reset Password</a>
                              <ul class="dropdown-menu">
                                <li>
                               <a href="/staff/resete/student"><i class="fa fa-eye" aria-hidden="true"></i> 
                                Student
                               </a>
                               </li>
                               <li>
                                   <a href="/staff/resete/teacher_staff"><i class="fa fa-eye" aria-hidden="true"></i>Teacher/Staff</a>
                               </li>
                              </ul>
                        </li>
                        
                        <li role="separator" class="divider"></li>

                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Requests</a>
                              <ul class="dropdown-menu">
                               <li>
                               <a href="/staff/teacher_students/logs"><i class="fa fa-eye" aria-hidden="true"></i> Log Request</a>
                               </li>
                                <li>
                                   <a href="/staff/students/confirmation_request"><i class="fa fa-eye" aria-hidden="true"></i> Online Fee Confirmation 
                                   </a>
                               </li>
                               <li>
                                   <a href="/staff/fee/extensions/refund/requests"><i class="fa fa-eye" aria-hidden="true"></i> Fee Extension/Refund</a>
                               </li>
                               <li>
                                   <a href="/staff/student/mark_sheets_requests"><i class="fa fa-eye" aria-hidden="true"></i> Mark Sheet</a>
                               </li>
                               <li>
                                   <a href="/staff/student/certificate/requests"><i class="fa fa-eye" aria-hidden="true"></i> Certificate</a>
                               </li>
                              
                              </ul>
                        </li>

                        <li role="separator" class="divider"></li>

                        <li>
                               
                               <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Leave</a>
                              <ul class="dropdown-menu">
                                <li>
                                 <a href="/teacher_staff/apply_leave"><i class="fa fa-plus" aria-hidden="true"> 
                                 </i> Apply For Leave</a>
                                </li>
                             
                               <li>
                                   <a href="/teacher_staff/applied/leaves">
                                   <i class="fa fa-eye" aria-hidden="true"></i>
                                    Applied Leaves</a>
                               </li>
                               
                              </ul>
                        </li>

                   

                        <li role="separator" class="divider"></li>

                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Information</a>
                              <ul class="dropdown-menu">
                                <li>
                               <a href="/staff/notification/get_form">
                               <i class="fa fa-plus" aria-hidden="true"></i>
                                Make Notification</a>
                               </li>
                               <li>
                                   <a href="/notification/index">
                                   <i class="fa fa-eye" aria-hidden="true"></i>
                                    View Notifications</a>
                               </li>
                               <li>
                                   <a href="/staff/message/send">
                                   <i class="fa fa-plus" aria-hidden="true"></i> Send Message
                                   </a>
                               </li>
                               <li>
                                   <a href="/staff/events/make">
                                   <i class="fa fa-plus" aria-hidden="true"></i> Make Event
                                   </a>
                               </li>
                               <li>
                                   <a href="/staff/events/view">
                                   <i class="fa fa-eye" aria-hidden="true"></i> View Event
                                   </a>
                               </li>
                              </ul>
                        </li>

                        <li role="separator" class="divider"></li>
                        <li>
                          <a href="/staff/students/manage_marks_get_courses">
                               <i class="fa fa-plus" aria-hidden="true"></i> Manage Students Marks
                          </a>
                        </li>

                        <li role="separator" class="divider"></li>

                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Assign</a>
                              <ul class="dropdown-menu">
                                <li>
                               <a href="/staff/course_section/attach"><i class="fa fa-plus" aria-hidden="true"></i> Assign Class Section</a>
                               </li>
                               <li>
                                   <a href="/staff/course_subject/attach"><i class="fa fa-plus" aria-hidden="true"></i> Assign Class Subject</a>
                               </li>
                               <li>
                                   <a href="/staff/course_section_teacher/attach"><i class="fa fa-plus" aria-hidden="true"></i> Assign Class Teacher</a>
                               </li>

                               <li>
                                   <a href="/staff/acadmic/teacher_teaching_subject/attach"><i class="fa fa-plus" aria-hidden="true"></i> Assign Teacher Teaching Subject </a>
                               </li>

                               <li>
                                   <a href="/staff/section_student/courses_link"><i class="fa fa-plus" aria-hidden="true"></i> Assign Student Section</a>
                               </li>
                              </ul>
                        </li>

                        <li role="separator" class="divider"></li>

                        
                        <li>
                          <a href="/staff/acadmic/timetabel/get_class_section">
                               <i class="fa fa-plus" aria-hidden="true"></i> Generate Time Table
                          </a>
                        </li>

                        <li role="separator" class="divider"></li>

                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Register</a>
                              <ul class="dropdown-menu">
                                <li>
                               <a href="/st/student/register"><i class="fa fa-plus" aria-hidden="true"></i> Register Student</a>
                               </li>
                               <li>
                                   <a href="/st/teacher_staff/register"><i class="fa fa-plus" aria-hidden="true"></i> Register Teacher/Staff</a>
                               </li>
                              </ul>
                        </li>

                    </ul>
                </li>

                
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">View <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Records</a>
                              <ul class="dropdown-menu">

                                <li>
                                  <a href="/st/all_students"><i class="fa fa-eye" aria-hidden="true"></i> Students</a>
                                </li>

                                <li>
                                  <a href="/st/active/students"><i class="fa fa-eye" aria-hidden="true"></i> Active Students</a>
                                </li>

                                <li>
                                   <a href="/st/all_teachers_staffs"><i class="fa fa-eye" aria-hidden="true"></i> Teacher/Staff</a>
                                </li>

                                <li>
                                  <a href="/school/records">
                                  <i class="fa fa-eye" aria-hidden="true"></i> 
                                   School Current Status
                                  </a>
                                </li>

                                <li>
                              </ul>
                        </li>

                        <li role="separator" class="divider"></li>

                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Analysis</a>
                              <ul class="dropdown-menu">
                                <li>
                                    <a href="/staff/students/mix_analysis"><i class="fa fa-eye" aria-hidden="true"></i> 
                                    Analysis 
                                    </a>
                                </li>
                              </ul>
                        </li>

                    </ul>
                </li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
