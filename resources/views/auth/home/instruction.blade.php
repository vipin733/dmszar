@extends('layouts.app')
@section('nav')
@include('layouts.nav')
@stop
@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
	    <div class="panel panel-primary">
	        <div class="panel-heading text-center">Basic Instruction</div>
	        <div class="panel-body">

	            <h3 class="text-center">
	                Here some basic step to setup your account fullly working
	            </h3>
	          
	            <div class="col-sm-6 col-sm-offset-3">
		          	<ol>

			          	<li><a href="/auth/school_profile/edit">Update Your School profile</a></li>			        			           	
			          	<li><a href="/auth/app/profile/edit">Update Your School App profile</a></li>

			          	<li><a href="{{ url('/teacher/register') }}">Add Teacher/Staff</a></li>
			          			          	
			          	<li><a href="{{ route('asessions_auth.create') }}">Add Session</a></li>
			          
			          	<li><a href="{{ route('courses_auth.create') }}">Add Class</a></li>
			           			          				          
			          	<li><a href="{{ url('/student/register') }}">Add Student</a></li>
			         	
		            </ol>
	            </div>

	        </div>
	    </div>
	</div>
</div>

@stop	



