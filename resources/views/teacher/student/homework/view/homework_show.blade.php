@extends('layouts.app')
@section('nav')
@include('teacher.teacher_nav')
@stop
@section('content')

<div class="row">
    <div class="col-md-12">       
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <button class="btn btn-primary btn-block">Homework</button>
	        </div>
	        <div class="panel-body">
	            <div class="table-responsive text-center col-sm-12">
                    <table class="table table-bordered  table-hover">
                        <thead>

					        <tr>
			                    <th class="text-center col-sm-3">Class</th>
			                    <td>{{$homework->courses->name}}</td>
			                </tr> 
			                <tr>
			                    <th class="text-center col-sm-3">Section</th>
			                    <td>{{$homework->sections->name}}</td>
			                </tr>    
			                <tr>
			                    <th class="text-center col-sm-3">Subject</th>
			                    <td>{{$homework->subjects->name}}</td>
			                </tr> 
			                <tr>
			                    <th class="text-center col-sm-3">Submission Date</th>
			                     <td>{{$homework->submit_at->format('d/m/Y h:i A')}}</td>
			                </tr> 
			                 
			                 <tr>
			                    <th class="text-center col-sm-3">Given At</th>
			                    <td>{{$homework->created_at->format('d/m/Y h:i A')}}</td>
			                </tr>

			                <tr>
			                    <th class="text-center col-sm-3">Homework</th>
			                     <td>{{$homework->homework}}</td>
			                </tr> 

			                @if($homework->remarks)			                 
			                <tr>
			                    <th class="text-center col-sm-3">Remarks</th>
			                    <td>{{$homework->remarks}}</td>
			                </tr>
			                @endif			                

			            </thead>
			        </table>

			        <div class="table-responsive text-center col-sm-12">
	                    <table class="table table-bordered  table-hover">
				        	<thead>
				        		<tr>
				                	<th class="text-center">Back</th>
				                	<td class="text-center">
					                	<a class="btn btn-primary btn-sm btn-block" href="/teacher/student/homework_index"><i class="fa fa-undo" aria-hidden="true"></i>
					                	</a>
				                	</td>
				                	<th class="text-center">Edit</th>
				                	<td class="text-center">
				                	   <a class="btn btn-warning btn-sm btn-block" data-toggle="modal" data-target="#c{{$homework->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
				                	   @include('teacher.student.homework.edit_homework_modal')
				                	</td>
				                	<th class="text-center">Delete</th>
				                	<td class="text-center">
				                	   <a class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#d{{$homework->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
				                	   @include('teacher.student.homework.delete_homework_modal')
				                	</td>
				                </tr>
				        	</thead>
				        </table>
				    </div>    
			    </div>            

	        </div>
	    </div>
	</div>
</div>

@stop