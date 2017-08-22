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
			  <button class="btn btn-primary btn-block">
			  <b>Marks</b>
			  </button>
		    </div>
		    <div class="panel-body">
			    <div class="table-responsive">
			          <table class=" table table-bordered  table-hover">
			             <thead >  
			                 <tr>
				                 <th rowspan="2" class="text-center">Subject</th>
				                 @foreach($testnames as $testname)
				                 <th colspan="2" class="text-center">{{ $testname->testnames['name'] }}</th>
				                 @endforeach
				                 @foreach($examnames as $examname)
				                 <th colspan="2" class="text-center">{{ $examname->examnames['name'] }}</th>
				                 @endforeach		                
			                 </tr> 
			                 <tr>
			                 @foreach($testnames as $testname)
			                 	<th class="text-center">Max. Mark</th>
			                 	<th class="text-center">Obt. Mark</th>
			                 @endforeach 
			                 @foreach($examnames as $examname)	
			                 	<th class="text-center">Max. Mark</th>
			                 	<th class="text-center">Obt. Mark</th>
			                 @endforeach			                 
			                 </tr> 

			                                   
			             </thead>
			             <tbody >

			              @foreach($subjects as $subject)
			             	<tr >			             	  
			             	 <td class="text-center">{{ $subject['name'] }}</td>
			             	 @foreach($subject->testmarks as $testmark)
			             	 <td class="text-center">{{ $testmark['max_mark'] }}</td>
			             	 <td class="text-center">{{ $testmark['score_mark'] }}</td>
			             	 @endforeach
			             	 @foreach($subject->exammarks as $exammark)
			             	 <td class="text-center">{{ $exammark['max_mark'] }}</td>
			             	 <td class="text-center">{{ $exammark['score_mark'] }}</td>
			             	 @endforeach			  
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

  