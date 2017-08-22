<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">

      <!-- Branding Image -->
          <a class="navbar-brand" href="{{ url('/home') }}">
               <b>{{ Auth::user()->appprofile['app_name'] }}</b>
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

      <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                           @include('layouts.logout')
                        </li>
                    </ul>
              </li>

      </ul>
      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav">
          <!-- Authentication Links -->



                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Academic <b class="caret"></b></a>
                    <ul class="dropdown-menu multi-level">


                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Register</a>
                              <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ url('/student/register') }}">Register Student</a>
                                </li>
                                 <li>
                                    <a href="{{ url('/teacher/register') }}">Register Teacher/Staff</a>
                                </li>
                              </ul>
                        </li>

                        <li role="separator" class="divider"></li>
                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add</a>
                              <ul class="dropdown-menu">
                                  <li>
                                     <a href="/auth/bank_details/get"><i class="fa fa-plus" aria-hidden="true"></i> Add Bank Details</a>
                                 </li>

                                 <li>
                                     <a href="/auth/app_details/get"><i class="fa fa-plus" aria-hidden="true"></i> Add App Details</a>
                                 </li>

                                <li>
                                     <a href="{{ route('asessions_auth.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Session</a>
                                 </li>
                                 <li>
                                     <a href="{{ route('courses_auth.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Class</a>
                                 </li>

                                 @if(!Auth::user()->schoolprofile['transport_service']==0)

                                  <li>
                                     <a href="{{ route('busdetails_auth.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Bus Details</a>
                                 </li>
                                 <li>
                                     <a href="{{ route('stopages_auth.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Stoppage</a>
                                 </li>
                                 @endif
                                  @if(!Auth::user()->schoolprofile['hostel_service']==0)
                                 <li>
                                     <a href="{{ route('hostels_auth.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Hostel Details</a>
                                 </li>
                                 @endif
                              </ul>
                        </li>

                        <li role="separator" class="divider"></li>

                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Message</a>
                              <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ url('/auth/send-message') }}">Send Message</a>
                                </li>
                              </ul>
                        </li>

                        <li role="separator" class="divider"></li>

                        <li class="dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Reset Password</a>
                              <ul class="dropdown-menu">
                                <li>
                                    <a href="/auth/resete/student"><i class="fa fa-eye" aria-hidden="true"></i> Student</a>
                                </li>
                                 <li>
                                    <a href="/auth/resete/teacher_staff"><i class="fa fa-eye" aria-hidden="true"></i> Teacher/Staff</a>
                                </li>
                              </ul>
                        </li>

                    </ul>
                </li>


              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-align-justify" aria-hidden="true"></i> View <span class="caret"></span></a>
                <ul class="dropdown-menu">

                 <li>
                     <a href="{{ url('/auth/all_students') }}">Students</a>
                 </li>
                 <li>
                     <a href="{{ url('/auth/all_teachers_staff') }}">Staff/Teacher</a>
                 </li>

                 <li>
                     <a href="{{ url('/auth/events/view') }}">Events</a>
                 </li>

                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-align-justify" aria-hidden="true"></i> My Account<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li>
                       <a href="{{ url('/auth/mysubscription') }}"><i class="fa fa-eye" aria-hidden="true"></i> My Subscription</a>
                  </li>
                  <li>
                       <a href="{{ url('/auth/bill') }}"><i class="fa fa-eye" aria-hidden="true"></i> My Bill</a>
                  </li>
                  <li>
                       <a href="{{ url('/auth/bill/online-confirmation') }}"><i class="fa fa-eye" aria-hidden="true"></i> Online Bill Confirmation</a>
                  </li>
                  <li>
                     <a href="/auth/profile"><i class="fa fa-eye" aria-hidden="true"></i>
                       My Profile
                     </a>
                  </li>

                  <li>
                     <a href="/auth/school_profile"><i class="fa fa-eye" aria-hidden="true"></i> My School Profile</a>
                  </li>
                  <li>
                     <a href="/auth/app_profile"><i class="fa fa-eye" aria-hidden="true"></i> My App Profile</a>
                  </li>

                  <li>
                     <a href="/auth/password/change"><i class="fa fa-eye" aria-hidden="true"></i> Change Password</a>
                  </li>

                </ul>
              </li>


        </ul>
      </div>
    </div>
</nav>
