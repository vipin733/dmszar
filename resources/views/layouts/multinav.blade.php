        <nav class="navbar navbar-inverse navbar-static-top marginBottom-0" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              <a class="navbar-brand" href="#" target="_blank">NewWindow</a>
            </div>
            
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Active Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Dropdown Link 1</a></li>
                            <li><a href="#">Dropdown Link 2</a></li>
                            <li><a href="#">Dropdown Link 3</a></li>
                            <li class="divider"></li>
                            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Link 4</a>
								<ul class="dropdown-menu">
									<li><a href="#">Dropdown Submenu Link 4.1</a></li>
									<li><a href="#">Dropdown Submenu Link 4.2</a></li>
									<li><a href="#">Dropdown Submenu Link 4.3</a></li>
									<li><a href="#">Dropdown Submenu Link 4.4</a></li>
								</ul>
							</li>
                            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Link 5</a>
								<ul class="dropdown-menu">
									<li><a href="#">Dropdown Submenu Link 5.1</a></li>
									<li><a href="#">Dropdown Submenu Link 5.2</a></li>
									<li><a href="#">Dropdown Submenu Link 5.3</a></li>
									<li class="divider"></li>
									<li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Submenu Link 5.4</a>
										<ul class="dropdown-menu">
											<li><a href="#">Dropdown Submenu Link 5.4.1</a></li>
											<li class="divider"></li>
											<li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown Submenu Link 5.4.3</a>
												<ul class="dropdown-menu">
													<li><a href="#">Dropdown Submenu Link 5.4.3.1</a></li>
													<li><a href="#">Dropdown Submenu Link 5.4.3.2</a></li>
													<li><a href="#">Dropdown Submenu Link 5.4.3.3</a></li>
													<li><a href="#">Dropdown Submenu Link 5.4.3.4</a></li>
												</ul>
											</li>
											
										</ul>
									</li>
								</ul>
							</li>
                        </ul>
                    </li>
                    
        </nav>
        

       



.marginBottom-0 {margin-bottom:0;}

.dropdown-submenu{position:relative;}
.dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;}
.dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#cccccc;margin-top:5px;margin-right:-10px;}
.dropdown-submenu:hover>a:after{border-left-color:#555;}
.dropdown-submenu.pull-left{float:none;}.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}






<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">NavBar</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="https://github.com/fontenele/bootstrap-navbar-dropdowns" target="_blank">GitHub Project</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu 1 <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                           </ul>
                        </li>        
                    </ul>
                </li>
                
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">
    <div class="navbar-template text-center">
        <h1>Bootstrap NavBar</h1>
        <p class="lead text-info">NavBar with too many childs.</p>
        <a target="_blank" href="http://bootsnipp.com/snippets/featured/multi-level-dropdown-menu-bs3">Thanks to msurguy (Multi level dropdown menu BS3)</a>
    </div>
</div>



<nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">

                <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/staff') }}">
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
                           <a href="/staff/profile"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
                        </li>

                        <li>
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                              <li class="dropdown">
                                  <a tabindex="-1" href="#" class="dropdown-toggle" data-toggle="dropdown">Transactions <b class="caret"></b></a>
                                  <ul class="dropdown-menu">
                                      <li>
                                         <a href="/staff/fee_analysis/tutions_transactions"><i class="fa fa-eye" aria-hidden="true"></i> Tutions Fee</a>
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

                              <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Unpaid <b class="caret"></b></a>
                                  <ul class="dropdown-menu">
                                      <li>
                                         <a href="/staff/tution/unpaid">
                                         <i class="fa fa-eye" aria-hidden="true"></i> 
                                           Unpaid Tution Fee Students
                                         </a>
                                     </li>
                                     @if(!$user->schoolprofile['transport_service']==0)
                                     <li>
                                         <a href="/staff/transport/unpaid"><i class="fa fa-eye" aria-hidden="true"></i> Unpaid Transport Fee Students</a>
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


                          <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-align-justify" aria-hidden="true"></i> Reset Password<span class="caret"></span></a>
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


                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-align-justify" aria-hidden="true"></i> Requests <span class="caret"></span></a>
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

                          <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-align-justify" aria-hidden="true"></i> Acadmic <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                           <li>
                               <a href="/staff/attendence"><i class="fa fa-eye" aria-hidden="true"></i> My Attendence</a>
                           </li>
                           <li>
                               <a href="/st/teacher_staff/take_attendence"><i class="fa fa-plus" aria-hidden="true"></i> Take Teacher/Staff Attendence</a>
                           </li>
                           <li>
                               <a href="/teacher_staff/apply_leave"><i class="fa fa-plus" aria-hidden="true"></i> Apply For Leave</a>
                           </li>
                            <li role="separator" class="divider"></li>
                           <li>
                               <a href="/staff/notification/get_form">
                               <i class="fa fa-plus" aria-hidden="true"></i>
                                Make Notification</a>
                           </li>
                           <li>
                               <a href="/staff/notification/index">
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
                           <li role="separator" class="divider"></li>
                               <li>
                               <a href="/staff/students/manage_marks_get_courses">
                               <i class="fa fa-plus" aria-hidden="true"></i> Manage Students Marks
                               </a>
                           </li>
                           <li role="separator" class="divider"></li>
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
                               <a href="/staff/teacher_teaching_courses_sections_subject/attach"><i class="fa fa-plus" aria-hidden="true"></i> Assign Teacher Teaching Classes </a>
                           </li>
                           <li>
                               <a href="/staff/section_student/courses_link"><i class="fa fa-plus" aria-hidden="true"></i> Assign Student Section</a>
                           </li>
                           <li role="separator" class="divider"></li>
                           <li>
                               <a href="/st/student/register"><i class="fa fa-plus" aria-hidden="true"></i> Register Student</a>
                           </li>
                           <li>
                               <a href="/st/teacher_staff/register"><i class="fa fa-plus" aria-hidden="true"></i> Register Teacher/Staff</a>
                           </li>
                          </ul>
                          </li>

                           <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-align-justify" aria-hidden="true"></i> Add <span class="caret"></span></a>
                          <ul class="dropdown-menu">

                          <li>
                               <a href="{{ route('asessions.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add Session</a>
                           </li>
                           <li>
                               <a href="{{ route('courses.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add Course</a>
                           </li>
                           <li>
                               <a href="{{ route('sections.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add Section</a>
                           </li>
                           <li>
                               <a href="{{ route('subjects.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add Subject</a>
                           </li>
                           <li>
                               <a href="{{ route('districts.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add District</a>
                           </li>
                           <li>
                               <a href="{{ route('stopages.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add Stopage</a>
                           </li>
                           <li>
                               <a href="{{ route('hostels.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add Hostel Details</a>
                           </li>

                            <li>
                               <a href="{{ route('testnames.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add Test Name</a>
                           </li>

                            <li>
                               <a href="{{ route('examnames.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add Exam Name</a>
                           </li>

                           <li>
                               <a href="{{ route('feerequestcategories.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>Add Fee Rquest Category</a>
                           </li>

                           <li>
                               <a href="{{ route('logrequestcategories.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>Add Log Rquest Category</a>
                           </li>
                           <li>
                               <a href="{{ route('ccategories.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>Add Certificate Name</a>
                           </li>
                        
                            <li role="separator" class="divider"></li>
                            <li>
                               <a href="/acadmic/add/tution_fee"><i class="fa fa-plus" aria-hidden="true"></i> Add Tution Fee Structure</a>
                           </li>
                           <li>
                               <a href="/acadmic/add/transport_fee"><i class="fa fa-plus" aria-hidden="true"></i> Add Transport Fee Structure</a>
                           </li>
                           <li>
                               <a href="/acadmic/add/Hostel_fee"><i class="fa fa-plus" aria-hidden="true"></i> Add Hostel Fee Structure</a>
                           </li>
                           
                          </ul>
                          </li>

                           <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-align-justify" aria-hidden="true"></i> View <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                           <li>
                               <a href="/st/all_students"><i class="fa fa-plus" aria-hidden="true"></i> Students</a>
                           </li>
                           <li>
                               <a href="/st/all_teachers_staffs"><i class="fa fa-eye" aria-hidden="true"></i> Teachers</a>
                           </li>
                           <li>
                               <a href="/staff/students/mix_analysis"><i class="fa fa-eye" aria-hidden="true"></i> Analysis</a>
                           </li>
                          </ul>
                          </li>
                          

                        <li>
                         <a href="/staff"><i class="fa fa-home" aria-hidden="true"></i> Home
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

<li>
                             <a href="{{ url('/student/register') }}">Register Student</a>
                            </li>
                            <li>
                             <a href="{{ url('/teacher/register') }}">Register Teacher/Staff</a>
                            </li>

                            <li>
                             <a href="{{ url('/all_students') }}">Students</a>
                            </li>

                            <li>
                             <a href="{{ url('/all_teachers') }}">Staff/Teacher</a>
                            </li>


                                                             <li>
                                     <a href="{{ route('districts_auth.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> District</a>
                                 </li>




                                                                <li>
                                   <a href="{{ route('districts.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> District</a>
                               </li>


                               <li>
                               <a href="{{ route('feerequestcategories.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>Add Fee Request Category</a>
                               </li>

                               <li>
                                   <a href="{{ route('logrequestcategories.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>Add Log Request Category</a>
                               </li>

                               <a href="/st/student/get_grades/{{$student->reg_no}}">Grades</a>


                               <li>
                               <a href="/student/grades"><i class="fa fa-eye" aria-hidden="true"></i> My Grades</a>
                           </li>















 <div class="table-responsive text-center col-sm-12">
                    <table class="table table-bordered  table-hover">
                        <thead>
                            <tr>
                              <th class="text-center">Class</th>
                              <th class="text-center">Section</th>
                              <th class="text-center">Subject</th>
                              <th class="text-center">Submission DateTime</th>
                              <th class="text-center">Given At</th>
                              <th class="text-center">Edit</th>
                              <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{$homework->courses->name}}</td>
                            <td>{{$homework->sections->name}}</td>
                            <td>{{$homework->subjects->name}}</td>
                            <td>{{$homework->submit_at->format('d/m/Y h:i A')}}</td>
                            <td>{{$homework->created_at->format('d/m/Y h:i A')}}</td>
                            <td>@include('teacher.student.homework.edit_homework_modal')</td>
                            <td>@include('teacher.student.homework.delete_homework_modal')</td>
                          </tr>
                        </tbody>
                    </table>
                </div> 

                <div class="col-sm-6 col-sm-offset-3 text-center">
                  <p>{{ $homework->homework }}</p>
                  @if($homework->remarks)
                    <br>
                    <p style="font-style: italic;"><b>{{ $homework->remarks}}</b></p>
                  @endif
                </div>