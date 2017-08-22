<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/student') }}">                   
                <b>{{ $user->appprofile['app_name'] }}</b>
            </a>
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
                   <a href="/student/profile"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-align-justify" aria-hidden="true"></i> Fees <span class="caret"></span></a>
                  <ul class="dropdown-menu">

                   <li>
                       <a href="/student/fee/status"><i class="fa fa-eye" aria-hidden="true"></i> My Fee Status
                   </li>

                  <li role="separator" class="divider"></li>

                  <li>
                       <a href="/student/registraion/fee_detail"><i class="fa fa-eye" aria-hidden="true"></i> Last Registration Transaction</a>
                   </li>
                   <li>
                       <a href="/student/tution/fee_detail/getsessions"><i class="fa fa-eye" aria-hidden="true"></i> Last Tuition Transaction</a>
                   </li>
                   @if(Auth::user()->TransportationTaken())
                   <li>
                       <a href="/student/transport/fee_detail/getsessions"><i class="fa fa-eye" aria-hidden="true"></i> Last Transport Transaction</a>
                   </li>
                   @endif
                   @if(Auth::user()->HostelTaken())
                   <li>
                       <a href="/student/hostel/fee_detail"><i class="fa fa-eye" aria-hidden="true"></i> Last Hostel Transaction</a>
                   </li>
                   @endif
                   <li role="separator" class="divider"></li>

                    <li>
                       <a href="/student/pay_online"><i class="fa fa-eye" aria-hidden="true"></i> Pay Online Fee</a>
                   </li>
                   
                   <li>
                       <a href="/student/online_fee/confirmation"><i class="fa fa-eye" aria-hidden="true"></i> Online Fee Confirmation</a>
                   </li>
                  

                   <li>
                       <a href="/student/fee/request"><i class="fa fa-eye" aria-hidden="true"></i> Fee Extension/Fee Refund
                       </a>
                   </li>
                   
                  </ul>
                  </li>

                

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-align-justify" aria-hidden="true"></i> Request <span class="caret"></span></a>
                  <ul class="dropdown-menu">

                   <li>
                       <a href="/student/log_request"><i class="fa fa-plus" aria-hidden="true"></i> Log Request</a>
                   </li>

                   <li>
                       <a href="/student/log_view"><i class="fa fa-eye" aria-hidden="true"></i> View Request</a>
                   </li>

                   <li role="separator" class="divider"></li>

                   <li>
                       <a href="/student/marks_sheet">
                       <i class="fa fa-plus" aria-hidden="true"></i> 
                       Apply For Marks Sheet
                       </a>
                   </li>

                   <li>
                       <a href="/student/cetrificate/request">
                       <i class="fa fa-plus" aria-hidden="true"></i> 
                       Apply For  Certificate
                       </a>
                   </li>

                  </ul>
                  </li>

                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-align-justify" aria-hidden="true"></i> Academic <span class="caret"></span></a>
                  <ul class="dropdown-menu">

                   <li>
                       <a href="/student/course_profile"><i class="fa fa-eye" aria-hidden="true"></i> My Academic Profile</a>
                   </li>

                   <li>
                       <a href="/student/homework"><i class="fa fa-eye" aria-hidden="true"></i> My HomeWork</a>
                   </li>

                   <li>
                       <a href="/student/get_asessions"><i class="fa fa-eye" aria-hidden="true"></i> My Marks</a>
                   </li>

                   <li>
                       <a href="/student/get_asessions_fortest"><i class="fa fa-eye" aria-hidden="true"></i> My Test Marks</a>
                   </li>
                   
                   <li>
                       <a href="/student/attendence"><i class="fa fa-eye" aria-hidden="true"></i> My Attendance</a>
                   </li>


                   <li>
                       <a href="/student/timetable"><i class="fa fa-eye" aria-hidden="true"></i> My Time Table</a>
                   </li>

                   <li>
                       <a href="/student/events/view"><i class="fa fa-eye" aria-hidden="true"></i> Events</a>
                   </li>

                  </ul>
                  </li>

                <li>
                 <a href="/student"><i class="fa fa-home" aria-hidden="true"></i> Home
                 </a>        
                </li>

                <li>
                 <a href="/student/change"><i class="fa fa-key" aria-hidden="true"></i> Change Password
                 </a>        
                </li>

                <li>
                 @include('layouts.logout')           
                </li>
                                              
            </ul>
        </div>
    </div>
</nav>
