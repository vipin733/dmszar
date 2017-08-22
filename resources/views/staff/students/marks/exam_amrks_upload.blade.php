@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')
   
        <div class="row">
          @include('partial.errors')
		  <div class="col-md-12">
		    @if(count($students))
		     <div class="panel panel-default">
                <div class="panel-heading"><button class="btn btn-primary btn-block">Upload Student Marks</button></div>
                 <div class="panel-body">

                   
                   <form action="/staff/students/{{$courseid->id}}/{{strtotime($courseid->created_at)}}/{{$sectionid->id}}/{{strtotime($sectionid->created_at)}}/{{$examnameid->id}}/{{strtotime($examnameid->created_at)}}/{{$subjectid->id}}/{{strtotime($subjectid->created_at)}}/exam_amrks_upload" method="POST" data-parsley-validate ="">
                    {{ csrf_field() }}

                     <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                            <tr>
                            	<th class="text-center">Course</th>
                                <th class="text-center">Section</th>
                            	<th class="text-center">Subject</th>
                                <th class="text-center">Session</th>
                                <th class="text-center">Test Name</th>
                                <th class="text-center">Max. Mark</th>
                                <th class="text-center">Test Date</th>
                              
                            </tr>
                           </thead>
                           <tbody class="text-center">
                            <tr>
                            	<td>{{$courseid['name'] }}</td>                            	
                            	<td>{{$sectionid['name'] }}</td>
                            	<td>{{$subjectid['name'] }}</td>
                                <td>{{$activesessionid['name'] }}</td>
                                <td>{{ $examnameid['name'] }}</td> 
                                <td>{{ $examnameid['max_mark'] }}</td>
                                <td>
                                  <div class="form-group">
                                     <input type="text" name="date" id="date_pic" class="form-control" value="{{ old('date') }}" placeholder="ex-02/11/2000" required="">
                                     </div>                            		
                            	</td>
                                
                            </tr>
                           </tbody>
                        </table>
                     </div> 

                     <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                            <tr>
                            	<th class="text-center">Serial No.</th>                                
                            	<th class="text-center">Student Name</th>
                            	<th  class="text-center">Student Reg. No</th>
                            	<th  class="text-center">View Profile</th>
                            	<th class="text-center">Roll no.</th>
                            	<th  class="text-center">Score Mark</th>
                            </tr>
                           </thead>
                           <tbody class="text-center" >
                            <?php $i = 0 ?>
                            @foreach($students as $student)
                            <?php $i++ ?>
                            <tr>
                           
                            	<td>{{ $i }}</td>                            	
                            	<td>{{ $student['name'] }}</td>
                            	<td>{{ $student['reg_no'] }}</td>
                            	<td> 
                            	  <a href="/st/student/{{$student['reg_no'] }}" class="btn btn-primary btn-sm">
				                      	<i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
				                   </a>
				                </td>
				                <td>
				                 {{ $student->studentacadmic->sections['name'] }}{{ $student->studentacadmic['roll_no'] }}
				                </td>
                            	<td>
                            		<div class="form-group">
                                      <input type="text" name="score_mark[]" class="form-control" value="{{ old('score_mark[]') }}" required="">
				                    </div>
                            	</td>
                          
                            </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                     <div class="form-group col-sm-4 col-sm-offset-4">
                         <button type="submit" class="btn-block btn-primary btn">Submit</button>
                     </div>           
		     	    </form>
                    <div class="col-sm-4 col-sm-offset-4">
                      <a class="btn-block btn-warning btn" href="/staff/students/{{$courseid->id}}/{{strtotime($courseid->created_at)}}/{{$sectionid->id}}/{{strtotime($sectionid->created_at)}}/manage_marks_exam_get_subjects">BACK</a>
                     </div>
		     	 </div>
		    @else
		    <h1 class="text-center">No student found.</h1>
		    @endif 	  
		  </div>
        </div>

@stop

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
 @include('partial.datepicker')

@endsection