@extends('layouts.app')
@section('nav')
@include('teacher.teacher_nav')
@stop
@section('content')
   
<div class="row">
          @include('partial.errors')
		  <div class="col-md-12">
      @if(count($testmarks))
		     <div class="panel panel-default">
                <div class="panel-heading"><button class="btn btn-primary btn-block">Edit Student Marks</button></div>
                 <div class="panel-body">
                   @foreach($testmarks->slice(0, 1) as $testmark)
                   <form action="/teacher/student/{{$testmark->courses['id']}}/{{strtotime($testmark->courses['created_at'])}}/{{$testmark->sections['id']}}/{{strtotime($testmark->sections['created_at'])}}/{{$testmark->subjects['id']}}/{{strtotime($testmark->subjects['created_at'])}}/{{$testmark->testnames['id']}}/{{strtotime($testmark->testnames['created_at'])}}/test_amrks_update" method="POST" data-parsley-validate ="">
                    {{ csrf_field() }} {{ method_field('PATCH') }}

                     <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                            <tr>
                            	<th class="text-center">Course</th>
                                <th class="text-center">Section</th>
                            	<th class="text-center">Subject</th>
                                <th class="text-center">Test Name</th>
                                <th class="text-center">Max. Mark</th>
                                <th class="text-center">Test Date</th>
                                
                            </tr>
                           </thead>
                           <tbody class="text-center">
                           
                            <tr>
                            	<td>{{ $testmark->courses['name'] }}</td>                            	
                            	<td>{{ $testmark->sections['name'] }}</td>
                            	<td>{{ $testmark->subjects['name'] }}</td>
                                <td>{{ $testmark->testnames['name'] }}</td>                    
                                <td>{{ $testmark->testnames['max_mark'] }}</td>                                            
                            	<td>
                                  <div class="form-group">
                                     <input type="text" name="date" id="date_pic" class="form-control" value="{{ old('date',$testmark['date']->format('d/m/Y')) }}" placeholder="ex-02/11/2000" required="">
                                     </div>                            		
                            	</td>
                               
                            </tr>
                            @endforeach
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
                            @foreach($testmarks as $testmark)
                            <?php $i++ ?>
                            <tr>
                           
                            	<td>{{ $i }}</td>                            	
                            	<td>{{ $testmark->students['name'] }}</td>
                            	<td>{{ $testmark->students['reg_no'] }}</td>
                            	<td> 
                            	  <a href="/st/student/{{$testmark->students['reg_no'] }}" class="btn btn-primary btn-sm">
				                      	<i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
				                   </a>
				                </td>
				                <td>
				                 {{ $testmark->students->studentacadmic->sections['name'] }}{{ $testmark->students->studentacadmic['roll_no'] }}
				                </td>
                            	<td>
                            		<div class="form-group">
                                      <input type="text" name="score_mark[]" class="form-control" value="{{ old('score_mark[]',$testmark['score_mark']) }}" required="">
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
                   @foreach($testmarks->slice(0, 1) as $testmark)
                    <div class="col-sm-4 col-sm-offset-4">
                      <a class="btn-block btn-warning btn" href="/teacher/student/{{$testmark->courses['id']}}/{{ $testmark->sections['id'] }}/test_subject">BACK</a>
                    </div>
                  @endforeach  
		     	 </div>
         @else
         <h1 class="text-center">
           No Marks Found
         </h1> 
         @endif  	  
		  </div>
</div>

@stop

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
 @include('partial.datepicker')

@endsection