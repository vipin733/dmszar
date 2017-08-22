
     <div id="ddmySidenav" class="ddsidenav">
      <a href="javascript:void(0)" class="ccclosebtn" onclick="closeNav()">&times;</a>
      <a href="/auth/student/attendence/{{$student->reg_no}}/details">Attendance</a>
      
      <a href="/auth/{{$student->uuid}}/{{$student->reg_no}}/student/fee/status">Fee Status</a>
      <a href="/auth/student/course_profile/{{$student->reg_no}}">Academic Profile</a>
      <a href="/auth/student/test_marks/{{$student->reg_no}}/get_sessesion">Test Marks</a>
      <a href="/auth/student/exam_marks/{{$student->reg_no}}/get_sessesion">Marks</a>
    {{--   <a href="/auth/student/get_grades/{{$student->reg_no}}">Grades</a> --}}
      <a href="/auth/student/fee_confirmation_requests/{{$student->reg_no}}">Fee Confirmation Requests</a>
      <a href="/auth/student/fee_requests/{{$student->reg_no}}">Fee Extension/Refund Requests</a>
      <a href="/auth/student/marksheet_requests/{{$student->reg_no}}">Mark Sheet Requests</a>
      <a href="/auth/student/certificate_requests/{{$student->reg_no}}">Certificate Requests</a>
      <a href="/auth/student/log_requests/{{$student->reg_no}}">Log Requests</a>
    </div>
    <span style="font-size:20px;cursor:pointer" onclick="openNav()">&#9776; View</span>