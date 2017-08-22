@extends('layouts.app')
@section('nav')
@include('teacher.teacher_nav')
@stop

@section('content')

<div class="row">
  @include('partial.errors')
    <div class="col-md-8 col-md-offset-2">
     @if($students)
  		<div class="panel panel-default">
              <div class="panel-heading"><button class="btn btn-primary btn-block">Take Student Attendance</button></div>
                <div class="panel-body">
                <form action="/teacher/student/take_attendence" method="POST" data-parsley-validate ="">
                  {{ csrf_field() }}
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                            <tr>
                              <th class="text-center">S. No.</th>
                              <th class="text-center">Roll no.</th>
                            	<th class="text-center">Student Name</th>
                            	<th  class="text-center">Student Reg. No</th>
                            	<th  class="text-center">View Profile</th>
                            	<th  class="text-center ">Mark</th>
                             
                            </tr>
                            </thead>                            				             
                          <tbody class="text-center " id="backchange">
                            <?php $i = 0 ?>
                           @foreach($students as $student)
                            <?php $i++ ?>
				                    <tr> 
  				                    <td>{{ $i }}</td>
                              <td>{{ $student->studentacadmic->sections['name'] }}{{ $student->studentacadmic['roll_no'] }}</td>            
  				                    <td>{{ $student['name'] }}</td>
  				                     <td>{{ $student['reg_no'] }} </td>
  				                     <td>
  				                      <a href="/st/student/{{$student['reg_no'] }}" class="btn btn-primary btn-sm">
  				                      	<i class="fa fa-eye faa-pulse animated" aria-hidden="true"></i>
  				                      </a>				                    
  				                     </td>
  				                     <td class="">
  				                     	<div class="form-group">
  				                     		<select class="form-control absent " name="marked[]" id="">
  				                     			<option value="1">Present</option>
  				                     			<option value="0">Absent</option>
  				                     		</select>
  				                     	</div>
  				                     </td>				                     
				                    </tr> 
                           @endforeach  
				                  </tbody>                                                                                    
				                              
                        </table>
                      </div>

                      <div class="col-sm-6 col-sm-offset-3">
                        <div class="form-group">
                          <label for="date">Date(Date which have to take attendance)</label>
                          <input type="text" name="date" class="form-control" id="date_pic" value="{{ old('date',Carbon\Carbon::today()->format('d/m/Y')) }}" required="">
                        </div>
                        <button class="btn-block btn-primary btn">Submit</button>
                      </div>
                      
                  </div>
                </form>
        </div> 

        @else
        <h3>No student found.</h3>
        @endif
  	</div>

</div>

@stop

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
 @include('partial.datepicker')

{{-- 
      <script type="text/javascript">
      $(document).ready(function (){
      $(document).on('change','.absent',function(){
      if( $(this).val()==="0"){
       $(this).closest('#backchange').css('background-color', 'blue');
       }
      else{
     $(this).closest('#backchange').css('background-color', '');
       }
      });
    });
  </script> --}}
 @endsection
