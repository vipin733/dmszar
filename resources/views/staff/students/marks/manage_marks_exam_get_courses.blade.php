@extends('layouts.app')
@section('nav')
@include('staff.staff_nav')
@stop
@section('content')

 <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading"><button class="btn btn-primary btn-block">Select Course Section</button></div>
        <div class="panel-body">
			<div class="table-responsive">
	          <table class=" table table-bordered  table-hover">
	             <thead>
	               <th class="text-center col-sm-2">Course</th>              
	               <th colspan="{{$sections}}" class="text-center">
	                     Section                   
	               </th>
	             </thead>
	             
	             <tbody class="text-center">
	               @if($courses)
	               @foreach($courses as $course)
	                <tr>             
	                    <td>{{ $course->name }}</td>
	                     @foreach($course->sections as $section)
	                      <td><a href="/staff/students/{{$course->id}}/{{strtotime($course->created_at)}}/{{$section->id}}/{{strtotime($section->created_at)}}/manage_marks_exam_get_subjects" class="btn btn-primary btn-sm">{{ $section['name'] }}</a>
	                      </td>
	                     @endforeach
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