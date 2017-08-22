@extends('layouts.app')
@section('nav')
@if(Auth::user()->isStaff())
@include('staff.staff_nav')
@else
@include('teacher.teacher_nav')
@endif
@stop
@section('content')

<div class="row">

      <div class="col-md-12">
        <div class="panel panel-default">
                <div class="panel-heading">
                      <button class="btn btn-primary btn-block">Student Information</button>
                </div>
                <div class="panel-body">
                      <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                            <tr>
                              <th class="text-center">Reg No.</th>
                              <th  class="text-center">Student Name</th>
                              <th  class="text-center">Father Name</th>
                              <th  class="text-center">Course</th>
                              <th  class="text-center">Session</th>
                              <th class="text-center">View Profile</th>                          
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td>{{ $student['reg_no'] }}</td>
                               <td>{{ $student['name'] }}</td>
                               <td>{{ $student['father_name'] }}</td>
                               <td>{{ $student->studentacadmic->courses['name'] }}</td>
                               <td>{{ $activesessionid['name'] }}</td>
                               <td>
                               <a href="/st/student/{{$student['reg_no']}}" class="btn btn-primary">
                               <i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
                               </a>
                               </td>
                             </tr>
                           </tbody>
                        </table>
                      </div>
                </div>
        </div>
      </div>                     

      <div class="col-md-12">
  		    <div class="panel panel-default">
                <div class="panel-heading">
                      <button class="btn btn-primary btn-block">Test Marks</button>
                </div>
                <div class="panel-body">

                      <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                              <tr>
                                <th class="text-center">Serial No.</th>
                                <th  class="text-center">Date</th>
                            	<th  class="text-center">Taken By</th>
                            	<th  class="text-center">Test</th>
                                <th class="text-center">Subject</th>
                            	<th class="text-center">Max. Mark</th>
                            	<th  class="text-center">Score Mark</th>                          
                               </tr>
                            </thead>
                            <tbody class="text-center">
                             <?php $i = 0 ?>
                              @foreach($test_marks as $test_mark)
                            <?php $i++ ?>
                            	<tr>
                            		<td>{{ $i }}</td>
                            		<td>{{ $test_mark['date']->format('d/m/Y') }}</td>
                            		<td>{{ $test_mark->teachers['name'] }}</td>
                            		<td>{{ $test_mark->testnames['name'] }}</td>
                            		<td>{{ $test_mark->subjects['name'] }}</td>
                            		<td>{{ $test_mark['max_mark'] }}</td>
                            		<td>{{ $test_mark['score_mark'] }}</td>
                            	</tr>
                            	@endforeach
                            </tbody>
                        </table>
                      </div>   
                </div>
          </div>
      </div> 

</div>

@stop    