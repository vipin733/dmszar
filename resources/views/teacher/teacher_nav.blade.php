<nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/teacher') }}">
                         <b>{{ $user->appprofile['app_name'] }}</b>
                    </a>

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        
                        <li>
                           <a href="/teacher/profile"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
                        </li>
                                               

                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-align-justify" aria-hidden="true"></i> Request <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                           <li>
                               <a href="/teacher/log/create"><i class="fa fa-plus" aria-hidden="true"></i> Log Request</a>
                           </li>
                           <li>
                               <a href="/teacher/log/view"><i class="fa fa-eye" aria-hidden="true"></i> View Request</a>
                           </li>
                          </ul>
                          </li>

                          <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-align-justify" aria-hidden="true"></i> Academic <span class="caret"></span></a>
                          <ul class="dropdown-menu">

                           <li>
                               <a href="/teacher/course_profile"><i class="fa fa-eye" aria-hidden="true"></i> My Academic Profile</a>
                           </li>

                           <li>
                               <a href="/teacher/timetable"><i class="fa fa-eye" aria-hidden="true"></i> My Time Table</a>
                           </li>

                           <li>
                               <a href="/teacher/attendence"><i class="fa fa-eye" aria-hidden="true"></i> My Attendance</a>
                           </li>

                           <li role="separator" class="divider"></li>

                            <li>
                               <a href="/teacher/events/view"><i class="fa fa-eye" aria-hidden="true"></i> Events</a>
                           </li>

                           <li role="separator" class="divider"></li>

                           <li>
                               <a href="/teacher_staff/apply_leave"><i class="fa fa-plus" aria-hidden="true"></i> Apply For Leave</a>
                           </li>
                          
                           <li role="separator" class="divider"></li>

                          <li class="dropdown-submenu">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Homework</a>
                                <ul class="dropdown-menu">

                                  <li>
                                     <a href="/teacher/student/homework_class_section"><i class="fa fa-plus" aria-hidden="true"></i> Assign Homework</a>
                                  </li>

                                  <li>
                                     <a href="/teacher/student/homework_index"><i class="fa fa-eye" aria-hidden="true"></i> All Homework</a>
                                  </li>
                                  
                                </ul>
                          </li>


                           <li role="separator" class="divider"></li>
                           
                            <li>
                               <a href="/teacher/student/test_course_section"><i class="fa fa-plus" aria-hidden="true"></i> Assign Test Marks</a>
                           </li>

                           <li role="separator" class="divider"></li>

                           <li>
                               <a href="/send_message/get"><i class="fa fa-plus" aria-hidden="true"></i> Send Message</a>
                           </li>
                           {{-- <li>
                               <a href=""><i class="fa fa-plus" aria-hidden="true"></i> Assign Exam Marks</a>
                           </li> --}}
                           <li role="separator" class="divider"></li>
                           <li>
                               <a href="/teacher/student/take_attendence"><i class="fa fa-plus" aria-hidden="true"></i> Take Attendance</a>
                           </li>
                          </ul>
                          </li>

                        <li>
                         <a href="/teacher/all_students"><i class="fa fa-users" aria-hidden="true"></i> Students
                         </a>        
                        </li>

                        <li>
                         <a href="/teacher"><i class="fa fa-home" aria-hidden="true"></i> Home
                         </a>        
                        </li>

                        <li>
                         <a href="/teacher/change"><i class="fa fa-key" aria-hidden="true"></i> Change Password
                         </a>        
                        </li>

                        <li>
                         @include('layouts.logout')           
                        </li>
                                                      
                    </ul>
                </div>
            </div>
        </nav>