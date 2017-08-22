
     <div id="ddmySidenav" class="ddsidenav">
      <a href="javascript:void(0)" class="ccclosebtn" onclick="closeNav()">&times;</a>
      <a href="" data-toggle="modal" data-target="#m{{$student->reg_no}}">Send Message</a>
      <a href="/st/student/attendence/{{$student->reg_no}}/details">Attendance</a>      
      <a href="/st/student/course_profile/{{$student->reg_no}}">Course Profile</a>
      <a href="/st/student/test_marks/{{$student->reg_no}}/get_sessesion">Test Marks</a>
      <a href="/st/student/exam_marks/{{$student->reg_no}}/get_sessesion">Marks</a>
      
      @if(Auth::user()->isStaff())
      <a href="/staff/{{$student->uuid}}/{{$student->reg_no}}/student/fee/status">Fee Status</a>
      <a href="/student/{{$student->reg_no}}/{{$student->uuid}}/tution_fee/take">Pay Fee</a>
      <a href="/student/tution_fee/{{$student->reg_no}}/{{$student->uuid}}/details">Last Transactions</a>
      <a href="/st/student/fee_confirmation_requests/{{$student->reg_no}}">Fee Confirmation Requests</a>
      <a href="/st/student/fee_requests/{{$student->reg_no}}">Fee Extension/Refund Requests</a>
      <a href="/st/student/marksheet_requests/{{$student->reg_no}}">Mark Sheet Requests</a>
      <a href="/st/student/certificate_requests/{{$student->reg_no}}">Certificate Requests</a>
      <a href="/st/student/log_requests/{{$student->reg_no}}">Log Requests</a>
      @endif
    </div>
    <span style="font-size:20px;cursor:pointer" onclick="openNav()">&#9776; View</span>

