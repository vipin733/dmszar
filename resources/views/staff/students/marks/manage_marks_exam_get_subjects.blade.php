@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

 <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading"><button class="btn btn-primary btn-block">Select Course Section</button></div>
        <div class="panel-body">
			<div class="table-responsive">
	          <table class=" table table-bordered  table-hover">
	             <thead>
	              <tr>
	               <th class="text-center ">Course</th>
	               <th class="text-center">Section</th>
	               <th class="text-center">Session</th>
	              </tr>
	              <tr>
	               <td class="text-center">{{$course->name}}</td>
	               <td class="text-center">{{$section->name}}</td>
	               <td class="text-center">{{ $asession->name }}</td>
	              </tr>	    	             
	             </thead>

	             <thead>
	               <th class="text-center col-sm-2">Subject</th>              
	               <th class="text-center">Edit</th>
	               <th class="text-center">Upload</th>
	             </thead>
	             
	             <tbody class="text-center">
	               @if($course)
	               @foreach($course->subjects as $subject)
	                <tr>             
	                    <td>{{ $subject->name }}</td>
	                    <td>
	                    	@foreach($examnames as $examname)
                              <a class="btn btn-warning" href="/staff/students/{{$course->id}}/{{strtotime($course->created_at)}}/{{$section->id}}/{{strtotime($section->created_at)}}/{{$examname->id}}/{{strtotime($examname->created_at)}}/{{$subject->id}}/{{strtotime($subject->created_at)}}/exam_amrks_edit">{{ $examname->name }}</a>
	                    	@endforeach
	                    </td>
	                    <td>
	                    	@foreach($examnames as $examname)
                              <a class="btn btn-primary" href="/staff/students/{{$course->id}}/{{strtotime($course->created_at)}}/{{$section->id}}/{{strtotime($section->created_at)}}/{{$examname->id}}/{{strtotime($examname->created_at)}}/{{$subject->id}}/{{strtotime($subject->created_at)}}/exam_amrks_upload">{{ $examname->name }}</a>
	                    	@endforeach
	                    </td>
	                </tr> 
	               @endforeach
	               @endif 
	             </tbody>                                                             
	           
	          </table>
	        </div>
	    </div>
	  </div>           
	</div>	    	
 </div>

@stop