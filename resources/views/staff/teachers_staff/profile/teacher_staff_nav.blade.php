    <div id="ddmySidenav" class="ddsidenav">
      <a href="javascript:void(0)" class="ccclosebtn" onclick="closeNav()">&times;</a>
      <a href="" data-toggle="modal" data-target="#m">Send Message</a>
      <a href="/st/teacher_staff/take_attendence/{{$teacher->uuid}}/{{$teacher->reg_no}}">Attendance</a> 
      <a href="/teacher_staff/{{$teacher->reg_no}}/applied_leave">Applied Leave</a>
      @if(!$teacher->isStaff())       
        <a href="/teacher/{{$teacher->reg_no}}/teacher_academic_profile">Academic Profile</a>
        <a href="/teacher/{{$teacher->reg_no}}/teacher_timetable">Time Table</a>
        <a href="/teacher/{{$teacher->reg_no}}/homeworks">Home Work</a>
      @endif  
      <a href="/teacher_staff/{{$teacher->reg_no}}/log_request">Log Request</a>
    </div>
    <span style="font-size:20px;cursor:pointer" onclick="openNav()">&#9776; View</span>

