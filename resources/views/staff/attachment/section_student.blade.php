@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

<div class="row">

  @include('staff.attachment.partial.student_detail')

   <div class="col-md-12">
   	    @if(count($students))       
   	    @include('partial.errors')
        @foreach($students->slice(0, 1) as $student)
   	    <form method="post" action="/staff/section_student/{{$student->course_id}}/{{strtotime($student->courses['created_at'])}}/attach" data-parsley-validate ="">
        @endforeach
        {{ csrf_field() }}
          	<div class="panel panel-default">
              <div class="panel-heading">
               <a class="btn btn-primary btn-block" href="">Student Academic Details</a>
              </div>
                <div class="panel-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered  table-hover">
                           <thead>
                             <tr>
                             	<th class="text-center">Serial No.</th>
                             	<th class="text-center">Student Reg. No.</th>
                             	<th class="text-center">Student Name</th>
                             	<th class="text-center">View Profile</th>
                             	<th class="text-center">Student Course</th>
                             	<th class="text-center">Choose Student Section</th>
                             </tr>
                           </thead>
                           <tbody class="text-center">
                           	<?php $i = 0 ?>
                           	@foreach($students as $student)
                             <?php $i++ ?>
                             <tr>
                             	<td>{{ $i }}</td>
                             	<td>
	                             	<a href="/st/student/{{$student->reg_no}}">{{ $student->reg_no }}
	                             	</a>
                             	</td>
                             	
                             	<td>{{ $student->name }}</td>                             	  	 	        
                             	<td>
                             	<a href="/st/student/{{$student->reg_no}}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                             	</td>
                             	<td>{{ $student->courses['name'] }}</td>
                             	<td>
                             	  <div class="form-group">
                             	  	 <select class="form-control" name="section[]" id="section[]" required="">
                             	  	 	@foreach($student->courses->sections as $section)
                             	  	 	  <option value="{{ $section->id }}">{{ $section->name }}</option>
                             	  	 	@endforeach
                             	  	 </select>
                             	  </div>
                             	</td>
                             </tr>
                            @endforeach 
                           </tbody>
                        </table>
                        <div class="col-md-4 col-md-offset-4">
                        	<button type="submit" class="btn-primary btn btn-block">Submit</button>
                        </div>
                    </div>
                </div>
            </div>  
           </form>
        @else

        <h1 class="text-center">Already Assigned all student for this class</h1> 
        @endif            

   </div>

</div>

@stop

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.7.0/parsley.min.js" type="text/javascript"></script>
@stop